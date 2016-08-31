<?php

/*
 * AIT Toolkit WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


abstract class AitCpt
{
	/**
	 * Public ID (name) of Custom Post Type as specified in config file or in class
	 * @var string
	 */
	protected $id;

	/**
	 * Internal ID (name) of Custom Post Type
	 * @var string
	 */
	protected $internalId;

	/**
	 * Flag whegter CPT is public
	 * @var boolean
	 */
	protected $isPublic = false;

	/**
	 * Flag whegter CPT is public
	 * @var boolean
	 */
	protected $isTranslatable = true;

	/**
	 * Standard labels for CPT. With one custom 'enterTitleHere'
	 * @see http://codex.wordpress.org/Function_Reference/register_post_type#Arguments
	 * @var stdClass
	 */
	protected $labels;

	/**
	 * Args for CPT
	 * @see http://codex.wordpress.org/Function_Reference/register_post_type#Arguments
	 * @var array
	 */
	protected $args;

	/**
	 * Default args for Custom Post Type
	 * @var array
	 */
	protected $defaultPostArgs = array();

	/**
	 * Default args for taxonomies
	 * @var array
	 */
	protected $defaultTaxonomyArgs = array();

	/**
	 * Paths for CPT
	 * @var stdClass
	 * @var stdClass
	 */
	protected $paths;

	/**
	 * Custom list table columns
	 * @var array
	 */
	protected $listTableColumns = array();

	/**
	 * List of sortable columns
	 * @var array
	 */
	protected $listTableSortableColumns = array();

	/**
	 * List of taxonomies for this CPT
	 * @var array
	 */
	protected $taxonomies = array();

	/**
	 * List of metaboxes
	 * @var array|AitMetaBox[]
	 */
	protected $metaboxes = array();

	protected $featuredImageMetaboxConfig;

	protected $raw;



	public function __construct($id, $config, $paths)
	{
		$cpt = isset($config['cpt']) ? (object) $config['cpt'] : (object) array();
		unset($config['cpt']);
		$c = (object) $config; // just shortcut


		$this->id = $id;
		$this->internalId = "ait-{$id}";

		$this->paths = $paths;

		// Is public?
		if(isset($c->public)) $this->isPublic = $c->public;

		if(isset($c->translatable)) $this->isTranslatable = $c->translatable;

		// Title
		if(isset($cpt->labels)) $this->setLabels($cpt->labels);

		// Args
		if(isset($cpt->args)) $this->setArgs($cpt->args);

		// Menu icon
		$this->setIcon(isset($cpt->icon) ? $cpt->icon : '');

		// Taxonomies
		if(isset($c->taxonomies)){
			foreach($c->taxonomies as $id => $params){
				$this->addTaxonomy($id, $params);
			}
		}

		// Metaboxes
		if(isset($c->metaboxes)){
			foreach($c->metaboxes as $id => $params){
				$this->addMetabox($id, $params);
			}
		}

		// Featured image
		if(isset($c->featuredImageMetabox)){
			$this->setFeaturedImageMetaboxConfig($c->featuredImageMetabox);
		}

		if(isset($cpt->listTableColumns)){
			$this->setListTableColumns($cpt->listTableColumns);
		}
	}



	public function getId()
	{
		return $this->id;
	}



	public function getInternalId()
	{
		return $this->internalId;
	}



	public function getLabels()
	{
		return $this->labels;
	}



	public function getFeaturedImageMetaboxConfig($key = null)
	{
		if(!$key)
			return $this->featuredImageMetaboxConfig;
		else
			return isset($this->featuredImageMetaboxConfig[$key]) ? $this->featuredImageMetaboxConfig[$key] : false;
	}



	public function getMetaboxes()
	{
		return $this->metaboxes;
	}



	public function getMetabox($id)
	{
		if(isset($this->metaboxes[$id])){
			return $this->metaboxes[$id];
		}else{
			trigger_error("There is no registered metabox with key '$id'.", E_USER_ERROR);
		}
	}



	/**
	 * Gets meta data from metabox
	 * @param  string $id  ID of metabox
	 * @return array       Fields from metabox
	 */
	public function getPostMeta($id)
	{
		if (isset($this->metaboxes[$id])) {
			return $this->metaboxes[$id]->getPostMeta();
		} else {
			trigger_error("There is no registered metabox with key '$id'.", E_USER_ERROR);
		}
	}



	public function getRaw()
	{
		$this->raw;
	}



	public function getTaxonomies()
	{
		return $this->taxonomies;
	}



	public function getTranslatableTaxonomyList()
	{
		$taxs = array();
		foreach($this->taxonomies as $tax){
			if(isset($tax['args']['ait-translatable-tax']) and $tax['args']['ait-translatable-tax']){
				$taxs[] = $tax['internalId'];
			}
		}

		return $taxs;
	}



	public function getRawTaxonomies()
	{
		return get_object_taxonomies($this->internalId, 'objects');
	}



	public function getRawPublicTaxonomies()
	{
		$taxonomies = $this->getRawTaxonomies();
		$publicTaxonomies = array();
		foreach($taxonomies as $name => $taxonomy) {
			if ($taxonomy->public and $name !== 'language') {
				$publicTaxonomies[] = $taxonomy;
			}
		}

		return $publicTaxonomies;
	}



	public function isPublic()
	{
		return $this->isPublic;
	}



	public function isTranslatable()
	{
		return $this->isTranslatable;
	}



	public function setIcon($icon)
	{
		$f = $icon ? "{$icon}" : "{$this->id}.png";

		$path = $this->paths->dir->cpts . "/{$this->id}/$f";
		$url  = $this->paths->url->cpts . "/{$this->id}/$f";

		if(file_exists($path)){
			$ico = $url;
		}else{
			$ico = "icon://data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAABGdBTUEAALGOfPtRkwAAACBjSFJNAAB6JQAAgIMAAPn/AACA6AAAdTAAAOpgAAA6lwAAF2+XqZnUAAAB00lEQVR4nGI8d+5cPQMDQwMDeaABIIAYgAb8//37939SAUjP9u3b/wMEEAvIGBYWFgblbkYGdnYGBk4OIOaEYC4uBgZuNihmZWDgAGGgDjZmBoYq3f8MP3/+ZAAIIBaYW3i4UTVysSM0crFBNLIDMStQMzMTwg8AAQQ3gI8PohHkAritUI1gW4GYBaiRiZGB4f9/hAEAAQQ3gJ8fYisPUBMXKwSDnMwO1QiyFaiX4S9Q85+/CAMAAghugCDUv1xofmVGsvX3PwaGX0DNP5EMAAgguAECnBDNnaYQ93VdZWQo08Zkl59mZPj2G2EAQAAhwgDod3ZmhARyQP34g2B//MHA8PUXgg8QQHADQKHNAjSg9zojA8iuv0Dntl5mZPgJ1PwDaGPOUYjNX4Cav/1EGAAQQHADQP5lBPr1HyiQQH79A7EZhEE2wvB3oAu+fUMYABBAYAO+f//OUKKFFDdEgLdv34ITEkAAsbx7965hzZo1DX/+QDwqISHBoKyszKCmpoai4cSJEwz37t0DawIBkHomJqYGgABi/P8f0+bly5f///HjB4oYiJ+ZmcmIrhYggOAGMDIyAuOBgROK8YHvIAzUB7YBIIBAJgoiYVLAexAGCDAA8GvFJdApkYsAAAAASUVORK5CYII=";
		}

		$this->setArg('menu_icon', $ico);
	}



	public function setLabels($labels)
	{
		$this->labels = new stdClass;
		foreach($labels as $key => $value){
			$this->labels->{$key} = $this->t($value);
		}

		if(!isset($this->labels->enterTitleHere)){
			$this->labels->enterTitleHere = '';
		}
	}



	public function setArgs($args)
	{
		$this->args = (object) array_merge($this->defaultPostArgs, $args);
	}



	public function setArg($arg, $value)
	{
		if(!is_object($this->args)){
			$this->args = new stdClass;
		}
		$this->args->{$arg} = $value;
	}



	public function setFeaturedImageMetaboxConfig($config)
	{
		$d = array(
			'labels' => array(
				'title'             => __('Featured Image'), // it will use default from WordPress
				'link-set-title'    => '',
				'link-remove-title' => '',
			),
			'context'           => 'advanced', // (normal, advanced, or side)
			'priority'          => 'default' // (high, core, default, or low)
		);

		if(isset($config['labels'])){
			foreach($config['labels'] as $key => $value){
				$config['labels'][$key] = $this->t($value);
			}
		}

		$this->featuredImageMetaboxConfig = array_merge($d, $config);
	}



	public function setListTableColumns($columns)
	{
		foreach($columns as $name => $values){
			if($values !== false){
				$this->listTableColumns[$name] = $this->t($values['label']);
				$this->listTableSortableColumns[$name] = $name;
			}else{
				$this->listTableColumns[$name] = false;
			}
		}
	}



	/**
	 * Registers custom post type
	 */
	public function register()
	{
		$args = array(
			'labels' => (array) $this->getLabels(),
		);

		$args = array_replace_recursive($args, (array) $this->args);

		if($this->isPublic and !isset($args['rewrite']) and !isset($args['rewrite']['slug'])){
			$args['rewrite']['slug'] = $this->id;
		}

		$args['ait-cpt'] = true; // mark our CPTs

		if($this->isTranslatable){
			$args['ait-translatable-cpt'] = true; // mark this CPT as translatable
		}

		$this->raw = register_post_type($this->internalId, $args);

		$this->registerTaxonomies();
	}



	/**
	 * Registers taxonomies for our own custom post type
	 */
	protected function registerTaxonomies()
	{
		if(!empty($this->taxonomies)){
			foreach($this->taxonomies as $id => $params){

				$taxInternalId = $params['internalId'];

				if(!taxonomy_exists($taxInternalId)){
					$args = isset($params['args']) ? $params['args'] : array();

					foreach($params['labels'] as $key => $value){
						$args['labels'][$key] = $this->t($value);
					}

					if(!isset($args['rewrite']) and !isset($args['rewrite']['slug'])){
						$args['rewrite']['slug'] = $id;
					}

					$args['ait-tax'] = true;


					register_taxonomy($taxInternalId, $this->internalId, $args);
				}
			}
		}
	}



	/**
	 * Adds taxonomy for current Custom Post Type
	 * @param string $id    ID of taxonomy. Will be prefixed with "ait-" prefix.
	 * @param array $params Params
	 */
	public function addTaxonomy($id, $params)
	{
		if(isset($params['args'])){
			$params['args'] = array_merge($this->defaultTaxonomyArgs, $params['args']);
		}else{
			$params['args'] = $this->defaultTaxonomyArgs;
		}

		$params['internalId'] = "ait-{$id}";

		// mark this taxonomy as translatable
		$params['args']['ait-translatable-tax'] = true; // default

		if(isset($params['translatable'])){
			$params['args']['ait-translatable-tax'] = $params['translatable'];
		}

		$this->taxonomies[$id] = $params;
	}



	/**
	 * Adds metabox for current Custom Post Type. It uses WpAlchemy for creating metabox.
	 * @param string $id     ID of metabox
	 * @param array $params Params for WpAlchemy constructor
	 */
	public function addMetabox($id, $params)
	{
		$this->metaboxes[$id] = $this->createMetabox($id, $params, $this->internalId);
	}



	public function supports($value)
	{
		return post_type_supports($this->internalId, $value);
	}



	public function createMetabox($id, $params, $cptInternalId)
	{
		if(isset($params['id'])) unset($params['id']);
		if(isset($params['originalId'])) unset($params['originalId']);
		if(isset($params['types'])) unset($params['types']);

		if(isset($params['title'])){
			$params['title'] = $this->t($params['title']);
		}

		if(isset($params['template'])){
			$params['template'] = $this->paths->dir->cpts . "/{$this->id}/{$params['template']}.metabox.php";
		}

		if(isset($params['config'])){
			if(!file_exists($params['config'])){
				$filename = "{$params['config']}.metabox.neon";
				$path = $this->paths->dir->cpts . "/{$this->id}/$filename";
				$params['config'] = apply_filters('ait-cpt-metabox-config-path', $path, $filename);
			}
		}

		$defaults = array(
			'metaKey'     => "_{$cptInternalId}_$id",
			'types'       => array($cptInternalId),
			'textDomain'  => 'ait-toolkit',
		);

		$internalId = "{$cptInternalId}-$id";

		if(current_theme_supports('ait-toolkit-plugin')){
			return new AitMetaBox($id, $internalId, array_merge($defaults, $params));
		}else{
			return new AitSimpleMetaBox($id, $internalId, array_merge($defaults, $params));
		}
	}



	public function createListTableColumn($columnName, $columnConfig, $metaboxes = null)
	{
		if(is_bool($columnConfig)) // default listTableColumns from wordpress list table
			return $columnConfig;

		$c = (object) $columnConfig;

		$className = isset($c->type) ? AitToolkitUtils::id2class($c->type, 'ListTableColumn') : 'AitListTableColumn';

		$metabox = null;
		if(isset($c->type) and $c->type == 'metabox' and isset($c->params['metabox'])){
			if($metaboxes and isset($metaboxes[$c->params['metabox']])){
				$metabox = $metaboxes[$c->params['metabox']];
			}
		}

		return new $className(
			$columnName,
			isset($c->label) ? $c->label : $columnName,
			isset($c->sortable) ? $c->sortable : false,
			isset($c->params) ? $c->params : array(),
			$metabox
		);
	}



	protected function t($value)
	{
		if(is_string($value)){
			return __($value, 'ait-toolkit');
		}elseif($value instanceof NNeonEntity){
			if($value->value == '_x' and !empty($value->attributes)){
				$text = $value->attributes[0];
				$context = $value->attributes[1];
				return _x($text, $context, 'ait-toolkit');
			}else{
				return '';
			}
		}
	}

}
