<?php

/*
 * AIT Toolkit WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


class AitCptsManager
{
	protected $cpts = array();

	protected $cptsByInternalId = array();

	protected $translatableCpts = array();

	protected $quickEditCustomBoxPrinted = false;

	protected $currentCpt;

	protected $paths;



	public function __construct($paths)
	{
		$this->paths = $paths;
	}



	/**
	 * Registers all CPTs to WordPress, its called from 'init' action
	 */
	public function registerCpts()
	{
		$this->createCpts();

		foreach($this->cpts as $cptId => $cpt){
			if(!post_type_exists($cpt->getInternalId())){ // this checks for conflicting CPTs registered by any plugin
				$cpt->register();
			}
		}

		if(is_admin()){
			add_action('admin_init', array($this, 'onAdminInit')); // we need access to $typenow var, it is available after admin_init
		}
	}



	public function createCpts()
	{
		$f = $this->paths->dir->root . '/@cpts.list.php';

		$cpts = require $f;

		$cpts = apply_filters('ait-toolkit-cpts-list', $cpts);

		foreach($cpts as $cptId => $params){
			if(isset($params['package'][AIT_TOOLKIT_PACKAGE]) and $params['package'][AIT_TOOLKIT_PACKAGE] and current_theme_supports("ait-cpt-{$cptId}")){
				$cpt = $this->createCpt($cptId, $params);

				$this->cpts[$cptId] = $cpt;
				$this->cptsByInternalId[$cpt->getInternalId()] = $cptId;
				if($cpt->isTranslatable()){
					$this->translatableCpts[$cpt->getInternalId()] = $cpt;
				}
			}
		}
	}



	protected function createCpt($cptId, $params)
	{
		$cptConfigFile = "@{$cptId}.cpt.neon";

		if(isset($params['paths'])){
			$configFile = $params['paths']->dir->cpts . "/{$cptId}/{$cptConfigFile}";
			$paths = $params['paths'];
		}else{
			$configFile = $this->paths->dir->cpts . "/{$cptId}/{$cptConfigFile}";
			$paths = $this->paths;
		}


		$config = AitToolkitUtils::loadRawConfig($configFile);

		$isPublic = (isset($config['public']) and $config['public']);

		if (isset($config['class'])) {
			$className = $config['class'];
		} else {
			$className = $isPublic ? 'AitPublicCpt' : 'AitInternalCpt';
		}

		$cpt = new $className($cptId, $config, $paths);

		return $cpt;
	}




	/**
	 * Gets all registered Custom Post Types
	 * @return array|AitCustomPostType[]
	 */
	public function getAll()
	{
		return $this->cpts;
	}



	/**
	 * Gets all internal IDs of registered Custom Post Types
	 * @return array
	 */
	public function getListOfAllInternalIds()
	{
		return array_keys($this->cptsByInternalId);
	}



	/**
	 * Gets all internal IDs of registered Custom Post Types
	 * @return array
	 */
	public function getListOfAllIds()
	{
		return array_keys($this->cpts);
	}



	/**
	 * Gets Custom Post Type by its ID
	 * @param  string $typeId ID of CPT
	 * @return AitCustomPostType
	 */
	public function get($typeId)
	{
		if(isset($this->cpts[$typeId])){
			return $this->cpts[$typeId];
		}
		return false;
	}



	/**
	 * Gets Custom Post Type by its ID
	 * @param  string $typeId ID of CPT
	 * @return AitCustomPostType
	 */
	public function has($typeId)
	{
		return isset($this->cpts[$typeId]);
	}



	/**
	 * Gets Custom Post Type by its ID
	 * @param  string $typeId ID of CPT
	 * @return AitCustomPostType
	 */
	public function getByInternalId($internalId)
	{
		if(isset($this->cptsByInternalId[$internalId])){
			return $this->cpts[$this->cptsByInternalId[$internalId]];
		}

		return false;
	}



	public function getTranslatable($type = 'object')
	{
		if($type === 'object'){
			return $this->translatableCpts;
		}elseif($type === 'list'){
			return array_keys($this->translatableCpts);
		}

		return array();
	}



	public function onAdminInit()
	{
		global $typenow, $pagenow;

		$this->currentCpt = $typenow;

		add_action("add_meta_boxes",  array($this, 'setFeaturedImageMetaboxTitle'), 10, 2);

		if($pagenow == 'post-new.php'){
			add_filter('enter_title_here', array($this, 'enterTitleHere'), 10, 2);
		}

		// add_filter("manage_posts_columns",  array($this, "changeListTableColumns"), 10, 2);

		// we want to be generic so we can then delegate action to right callback and right cpt
		// add_filter("manage_pages_custom_column",  array($this, "displayListTableColumnValue"), 10, 2);
		// add_filter("manage_posts_custom_column",  array($this, "displayListTableColumnValue"), 10, 2);

		// add_filter("manage_edit-{$typenow}_sortable_columns",  array($this, "makeSortableColumns"));

		add_action('restrict_manage_posts',  array($this, 'postsFilters'));
	}



	public function enterTitleHere($title, $post)
	{
		$cpt = $this->getByInternalId($post->post_type);

		if($cpt and $cpt->getLabels()->enterTitleHere){
			return $cpt->getLabels()->enterTitleHere;
		}

		return $title;
	}



	public function setFeaturedImageMetaboxTitle($postType, $post)
	{
		$cpt = $this->getByInternalId($postType);

		if($cpt and $cpt->supports('thumbnail') and $cpt->getFeaturedImageMetaboxConfig()){
			add_filter('admin_post_thumbnail_html', array($this, 'setFeaturedImageMetaboxLink'), 10, 2);

			$context = $cpt->getFeaturedImageMetaboxConfig('context') ? $cpt->getFeaturedImageMetaboxConfig('context') : 'side';

			$labels = $cpt->getFeaturedImageMetaboxConfig('labels');
			$priority = $cpt->getFeaturedImageMetaboxConfig('priority') ? $cpt->getFeaturedImageMetaboxConfig('priority') : 'default';

			remove_meta_box('postimagediv', $cpt->getInternalId(), 'side');
			add_meta_box('postimagediv', $labels['title'], 'post_thumbnail_meta_box', $cpt->getInternalId(), $context, $priority);
		}
	}



	/**
	 * Changes text of link Featured Image Metabox
	 * @param string $html
	 */
	public function setFeaturedImageMetaboxLink($html, $postId)
	{
		$cpt = $this->getByInternalId(get_post_type($postId));

		$labels = (object) $cpt->getFeaturedImageMetaboxConfig('labels');

		if($cpt and isset($labels->linkSetTitle) and $labels->linkSetTitle and isset($labels->linkRemoveTitle) and $labels->linkRemoveTitle){
			$html = preg_replace('/title="([^"]*)"/', "title='$labels->linkSetTitle'", $html);

			preg_match('/>([^<>]*)<\/a>/', $html, $matches);
			$html = str_replace($matches[1], $labels->linkSetTitle, $html);

			preg_match('/;return false;">([^<>]*)<\/a>/', $html, $matches);
			if(isset($matches[1]))
				$html = str_replace($matches[1], $labels->linkRemoveTitle, $html);
		}

		return $html;
	}



	/**
	 * Changes columns in the list table
	 * @param  array $columns
	 * @param  string $postType
	 * @return array
	 */
	public function changeListTableColumns($columns, $postType)
	{
		$cpt = $this->getByInternalId($postType);
		$cols = $columns;

		if($cpt){
			foreach($cpt->getColumns() as $name => $label){
				if($label !== false){
					$cols[$name] = $label;
				}else{
					if(isset($cols[$name]))
						unset($cols[$name]);
				}
			}
		}

		return $cols;
	}



	/**
	 * Changes what will be displayed in columns. Needs to be defined or overrided in child class.
	 * @param  string $column Current column
	 * @param  int $postId Post Id
	 */
	public function displayListTableColumnValue($columnName, $postId)
	{
		$cpt = $this->getByInternalId($this->currentCpt);
		if($cpt){
			echo $cpt->getColumnValue($columnName, $postId);
		}
	}



	public function makeSortableColumns($sortableColumns)
	{
		$cpt = $this->getByInternalId($this->currentCpt);

		if($cpt){
			foreach($cpt->columns as $name => $column){
				if($column and $column->sortable)
					$sortableColumns[$name] = $name;
			}
		}
		return $sortableColumns;
	}



	public function postsFilters()
	{
		$cpt = $this->getByInternalId($this->currentCpt);

		if($cpt){
			$taxonomies = $cpt->getRawPublicTaxonomies();
			foreach($taxonomies as $tax){
				$options = array(
					'show_option_all' => $tax->labels->all_items,
					'taxonomy'        => $tax->name,
					'name'            => $tax->query_var,
					'hide_empty'      => 0,
					'hierarchical'    => $tax->hierarchical,
					'show_count'      => 1,
					'orderby'         => 'name',
					'selected'        => get_query_var($tax->query_var),
					'use_slug'        => true,
					'walker'          => current_theme_supports('ait-toolkit-plugin') ? new AitCategoryDropdownWalker : new AitToolkitCategoryDropdownWalker,
				);

				wp_dropdown_categories($options);
			}
		}
	}



	// public function onSavePost($postId, $post)
	// {
	// 	$cpt = $this->getByInternalId($post->post_type);

	// 	if($cpt and AitUtils::isAjax()){
	// 		if(current_user_can('edit_post', $postId)){
	// 			foreach($cpt->metaboxes as $metaboxId => $metabox){
	// 				$metabox->save($postId, $post);
	// 			}
	// 		}
	// 	}
	// 	return $postId;
	// }



	// public function addQuickEditCustomBox($columnName, $postType)
	// {
	// 	$cpt = $this->getByInternalId($postType);

	// 	if($cpt and !$this->quickEditCustomBoxPrinted){
	// 		$this->printQuickEditCustomBox($cpt);
	// 		$this->quickEditCustomBoxPrinted = true;
	// 	}
	// }



	// private function printQuickEditCustomBox(AitCustomPostType $cpt)
	// {
	// 	echo '<br class="clear" />';

	// 	foreach($cpt->metaboxes as $metabox){
	// 		$controlsRenderer = new AitQuickEditOptionsControlsRenderer('metabox', $metabox->getInternalId());
	// 		$controlsRenderer->render($metabox->getFullConfig(), $metabox->getConfigDefaults(), $metabox->getOptions());
	// 		$metabox->nonceField();
	// 	}
	// }




	public function appendAdminQuickEditJs()
	{

	}



	public function updateTermIdsOnSplitSharedTerm($oldTermId, $newTermId, $termTaxonomyId, $taxonomy)
	{
		$allAitCpts = $this->getAll();

		foreach($allAitCpts as $cptName => $cpt){
			if(in_array($cptName, array('item', 'rating'))){
				$taxs = $cpt->getTaxonomies();
				foreach($taxs as $taxId => $params){
					$backup = get_option("{$params['internalId']}_category_{$oldTermId}", null);
					if($backup !== null){
						update_option("{$params['internalId']}_category_{$newTermId}", $backup);
						delete_option("{$params['internalId']}_category_{$oldTermId}");
					}
				}
			}
		}
	}
}
