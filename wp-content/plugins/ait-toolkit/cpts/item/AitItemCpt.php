<?php

/*
 * AIT Toolkit WordPress Plugin
 *
 * Copyright (c) 2014, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


class AitItemCpt extends AitPublicCpt
{

	protected $itemCategoryId;
	protected $itemLocationId;


	/**
	 * @param $id
	 * @param $config
	 * @param $paths
	 */
	public function __construct($id, $config, $paths)
	{
		parent::__construct($id, $config, $paths);

		$this->itemCategoryId = 'ait-' . key($config['taxonomies']);
		$temp = $config['taxonomies'];
		array_shift($temp);
		$this->itemLocationId = 'ait-' . key($temp);


		add_action('init', array($this, 'aitItemsDefaultCustomFields'), 20, 0);
		add_action('init', array($this, 'aitLocationsDefaultCustomFields'), 20, 0);

		add_action('admin_enqueue_scripts', array($this, 'enqueueAdminPageWpMediaJs'));
		add_action('admin_print_footer_scripts', array($this, 'printAdminPageItemCategoriesJs'));

		add_action("{$this->itemCategoryId}_add_form_fields", array($this, 'addItemCategoryFormFields'), 10, 2);
		add_action("{$this->itemCategoryId}_edit_form_fields", array($this, 'editItemCategoryFormFields'), 10, 2);
		add_action("edited_{$this->itemCategoryId}", array($this, 'saveExtraItemCategoryFormFields'), 10, 2);
		add_action("created_{$this->itemCategoryId}", array($this, 'saveExtraItemCategoryFormFields'), 10, 2);

		add_action("{$this->itemLocationId}_add_form_fields", array($this, 'addItemLocationFormFields'), 10, 2);
		add_action("{$this->itemLocationId}_edit_form_fields", array($this, 'editItemLocationFormFields'), 10, 2);
		add_action("edited_{$this->itemLocationId}", array($this, 'saveExtraItemLocationFormFields'), 10, 2);
		add_action("created_{$this->itemLocationId}", array($this, 'saveExtraItemLocationFormFields'), 10, 2);

		add_filter('ait-special-custom-pages', array($this, 'addItemTaxonomiesSpecialPages'));

		add_filter('breadcrumbs_singular_taxonomy', array($this, 'setBreadcrumbsSingularTaxonomy'), 10, 2);

		add_filter('ait-backup-wpoptions', array($this, 'addTaxonomiesCustomFieldsToBackup'), 10, 2);

		add_filter("ait-allow-render-controls-elements-revolution-slider", array($this, 'dontRenderControls'), 10, 2);
		add_filter("ait-allow-render-controls-elements-seo", array($this, 'dontRenderControls'), 10, 2);
		add_filter('ait-dont-allow-render-controls-message', array($this, 'dontRenderControlsMessage'), 10, 4);

		add_filter('ait-allow-render-option-control', array($this, 'dontRenderSpecificOptionControls'), 10, 3);

		add_filter('manage_ait-item_posts_columns', array($this, 'itemChangeColumns'), 10, 2);
		add_action('manage_posts_custom_column', array($this, 'cptCustomColumns'), 10, 2);
	}

	public function aitItemsDefaultCustomFields(){
		// stores default custom fields used by ait-items taxonomy
		// key: ait-items_taxonomy_default-custom-fields
		$taxonomyCustomFields = array(
			'keywords' => array(
				'label' => __('Keywords', 'ait-toolkit'),
				'notice' => __('Keywords', 'ait-toolkit'),
			),
			'icon' => array(
				'label' => __('Icon', 'ait-toolkit'),
				'notice' => __('Icon', 'ait-toolkit'),
			),
			'map_icon' => array(
				'label' => __('Map Icon', 'ait-toolkit'),
				'notice' => __('Map Icon', 'ait-toolkit'),
			),
			'header_type' => array(
				'label' => __('Header Type', 'ait-toolkit'),
				'notice' => __('Header Type', 'ait-toolkit'),
			),
			'header_image' => array(
				'label' => __('Header Image', 'ait-toolkit'),
				'notice' => __('Header Image', 'ait-toolkit'),
			),
			'header_image_align' => array(
				'label' => __('Header Image Align', 'ait-toolkit'),
				'notice' => __('Header Image Align', 'ait-toolkit'),
			),
			'category_featured' => array(
				'label' => __('Category Featured', 'ait-toolkit'),
				'notice' => __('Category Featured', 'ait-toolkit'),
			),
		);
		$taxonomyCustomFields = apply_filters( 'modify-ait-items_taxonomy_default-custom-fields', $taxonomyCustomFields );
		update_option("ait-items_taxonomy_default-custom-fields", $taxonomyCustomFields);
	}

	public function aitLocationsDefaultCustomFields(){
		// stores default custom fields used by ait-locations taxonomy
		// key: ait-locations_taxonomy_default-custom-fields
		$taxonomyCustomFields = array(
			'keywords' => array(
				'label' => __('Keywords', 'ait-toolkit'),
				'notice' => __('Keywords', 'ait-toolkit'),
			),
			'icon' => array(
				'label' => __('Icon', 'ait-toolkit'),
				'notice' => __('Icon', 'ait-toolkit'),
			),
			'header_type' => array(
				'label' => __('Header Type', 'ait-toolkit'),
				'notice' => __('Header Type', 'ait-toolkit'),
			),
			'header_image' => array(
				'label' => __('Header Image', 'ait-toolkit'),
				'notice' => __('Header Image', 'ait-toolkit'),
			),
			'header_image_align' => array(
				'label' => __('Header Image Align', 'ait-toolkit'),
				'notice' => __('Header Image Align', 'ait-toolkit'),
			),
		);
		$taxonomyCustomFields = apply_filters( 'modify-ait-locations_taxonomy_default-custom-fields', $taxonomyCustomFields );
		update_option("ait-locations_taxonomy_default-custom-fields", $taxonomyCustomFields);
	}

	public function enqueueAdminPageWpMediaJs()
	{
		wp_enqueue_media ();
	}



	public function printAdminPageItemCategoriesJs()
	{
		?>
		<script type="text/javascript">
			if (jQuery('.choose-category-icon-button').length > 0) {
				if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
					jQuery('form').on('click', '.choose-category-icon-button', function(e) {
						e.preventDefault();
						var button = jQuery(this);
						var iconUrlInput = button.prev();
						wp.media.editor.send.attachment = function(props, attachment) {
							iconUrlInput.val(attachment.url);
						};
						wp.media.editor.open(button);
						return false;
					});
				}
			}
		</script>
		<?php
	}



	public function editItemCategoryFormFields($tag, $taxonomy)
	{
		$termId = $tag->term_id;
		$extraFieldsValues = get_option( "{$this->itemCategoryId}_category_{$termId}");

		?>

		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $this->itemCategoryId ?>[keywords]"><?php _e('Keywords', 'ait-toolkit') ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo $this->itemCategoryId ?>[keywords]" id="<?php echo $this->itemCategoryId ?>[keywords]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["keywords"]) ? $extraFieldsValues["keywords"] : ''; ?>">
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $this->itemCategoryId ?>[icon]"><?php _e('Icon', 'ait-toolkit') ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo $this->itemCategoryId ?>[icon]" id="<?php echo $this->itemCategoryId ?>[icon]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["icon"]) ? $extraFieldsValues["icon"] : ''; ?>">
				<input type="button" class="choose-category-icon-button button button-secondary" <?php echo aitDataAttr('select-image', array('title' => 'Select Image', 'buttonTitle' => __('Insert Image', 'ait-toolkit'))); ?> style="width:25%;" value="<?php _e('Select Icon', 'ait-toolkit') ?>" id="<?php echo $this->itemCategoryId ?>[icon]-media-button">
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $this->itemCategoryId ?>[map_icon]"><?php _e('Icon in Map', 'ait-toolkit') ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo $this->itemCategoryId ?>[map_icon]" id="<?php echo $this->itemCategoryId ?>[map_icon]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["map_icon"]) ? $extraFieldsValues["map_icon"] : ''; ?>">
				<input type="button" class="choose-category-icon-button button button-secondary" <?php echo aitDataAttr('select-image', array('title' => 'Select Image', 'buttonTitle' => __('Insert Image', 'ait-toolkit'))); ?> style="width:25%;" value="<?php _e('Select Icon', 'ait-toolkit') ?>" id="<?php echo $this->itemCategoryId ?>[map_icon]-media-button">
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $this->itemCategoryId ?>[header_type]"><?php _e('Header Type', 'ait-toolkit') ?></label>
			</th>
			<td>
				<select name="<?php echo $this->itemCategoryId ?>[header_type]" id="<?php echo $this->itemCategoryId ?>[header_type]" style="width:70%;">
					<option value="map" <?php echo isset($extraFieldsValues["header_type"]) && $extraFieldsValues["header_type"] == 'map' ? 'selected' : ''; ?>><?php _e('Map', 'ait-toolkit') ?></option>
					<option value="image" <?php echo isset($extraFieldsValues["header_type"]) && $extraFieldsValues["header_type"] == 'image' ? 'selected' : ''; ?>><?php _e('Image', 'ait-toolkit') ?></option>
					<option value="video" <?php echo isset($extraFieldsValues["header_type"]) && $extraFieldsValues["header_type"] == 'video' ? 'selected' : ''; ?>><?php _e('Video', 'ait-toolkit') ?></option>
					<option value="none" <?php echo isset($extraFieldsValues["header_type"]) && $extraFieldsValues["header_type"] == 'none' ? 'selected' : ''; ?>><?php _e('None', 'ait-toolkit') ?></option>
				</select>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $this->itemCategoryId ?>[header_image]"><?php _e('Header Image', 'ait-toolkit') ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo $this->itemCategoryId ?>[header_image]" id="<?php echo $this->itemCategoryId ?>[header_image]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["header_image"]) ? $extraFieldsValues["header_image"] : ''; ?>">
				<input type="button" class="choose-category-icon-button button button-secondary" <?php echo aitDataAttr('select-image', array('title' => 'Select Image', 'buttonTitle' => __('Insert Image', 'ait-toolkit'))); ?> style="width:25%;" value="<?php _e('Select Image', 'ait-toolkit') ?>" id="<?php echo $this->itemCategoryId ?>[header_image]-media-button">
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $this->itemCategoryId ?>[header_image_align]"><?php _e('Header Image Align', 'ait-toolkit') ?></label>
			</th>
			<td>
				<select name="<?php echo $this->itemCategoryId ?>[header_image_align]" id="<?php echo $this->itemCategoryId ?>[header_image_align]" style="width:70%;">
					<option value="image-left" <?php echo isset($extraFieldsValues["header_image_align"]) && $extraFieldsValues["header_image_align"] == 'image-left' ? 'selected' : ''; ?>><?php _e('Left', 'ait-toolkit') ?></option>
					<option value="image-center" <?php echo isset($extraFieldsValues["header_image_align"]) && $extraFieldsValues["header_image_align"] == 'image-center' ? 'selected' : ''; ?>><?php _e('Center', 'ait-toolkit') ?></option>
					<option value="image-right" <?php echo isset($extraFieldsValues["header_image_align"]) && $extraFieldsValues["header_image_align"] == 'image-right' ? 'selected' : ''; ?>><?php _e('Right', 'ait-toolkit') ?></option>
				</select>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $this->itemCategoryId ?>[category_featured]"><?php _e('Featured Category', 'ait-toolkit') ?></label>
			</th>
			<td>
				<?php $checked = isset($extraFieldsValues["category_featured"]) ? "checked" : "" ?>
				<input type="checkbox" name="<?php echo $this->itemCategoryId ?>[category_featured]" id="<?php echo $this->itemCategoryId ?>[category_featured]" value="true" <?php echo $checked ?> >
			</td>
		</tr>

		<?php
	}

	public function addItemCategoryFormFields($taxonomy)
	{
		?>

		<div class="form-field">
			<label for="<?php echo $this->itemCategoryId ?>[keywords]"><?php _e('Keywords', 'ait-toolkit') ?></label>
			<input type="text" name="<?php echo $this->itemCategoryId ?>[keywords]" id="<?php echo $this->itemCategoryId ?>[keywords]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["keywords"]) ? $extraFieldsValues["keywords"] : ''; ?>">
		</div>

		<div class="form-field">
			<label for="<?php echo $this->itemCategoryId ?>[icon]"><?php _e('Icon', 'ait-toolkit') ?></label>
			<input type="text" name="<?php echo $this->itemCategoryId ?>[icon]" id="<?php echo $this->itemCategoryId ?>[icon]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["icon"]) ? $extraFieldsValues["icon"] : ''; ?>">
			<input type="button" class="choose-category-icon-button button button-secondary" <?php echo aitDataAttr('select-image', array('title' => 'Select Image', 'buttonTitle' => __('Insert Image', 'ait-toolkit'))); ?> style="width:25%;" value="<?php _e('Select Icon', 'ait-toolkit') ?>" id="<?php echo $this->itemCategoryId ?>[icon]-media-button">
		</div>

		<div class="form-field">
			<label for="<?php echo $this->itemCategoryId ?>[map_icon]"><?php _e('Icon in Map', 'ait-toolkit') ?></label>
			<input type="text" name="<?php echo $this->itemCategoryId ?>[map_icon]" id="<?php echo $this->itemCategoryId ?>[map_icon]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["map_icon"]) ? $extraFieldsValues["map_icon"] : ''; ?>">
			<input type="button" class="choose-category-icon-button button button-secondary" <?php echo aitDataAttr('select-image', array('title' => 'Select Image', 'buttonTitle' => __('Insert Image', 'ait-toolkit'))); ?> style="width:25%;" value="<?php _e('Select Icon', 'ait-toolkit') ?>" id="<?php echo $this->itemCategoryId ?>[map_icon]-media-button">
		</div>

		<div class="form-field">
			<label for="<?php echo $this->itemCategoryId ?>[header_type]"><?php _e('Header Type', 'ait-toolkit') ?></label>
			<select name="<?php echo $this->itemCategoryId ?>[header_type]" id="<?php echo $this->itemCategoryId ?>[header_type]" style="width:70%;">
				<option value="map" selected><?php _e('Map', 'ait-toolkit') ?></option>
				<option value="image"><?php _e('Image', 'ait-toolkit') ?></option>
				<option value="video"><?php _e('Video', 'ait-toolkit') ?></option>
				<option value="none"><?php _e('None', 'ait-toolkit') ?></option>
			</select>
		</div>

		<div class="form-field">
			<label for="<?php echo $this->itemCategoryId ?>[header_image]"><?php _e('Header Image', 'ait-toolkit') ?></label>
			<input type="text" name="<?php echo $this->itemCategoryId ?>[header_image]" id="<?php echo $this->itemCategoryId ?>[header_image]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["header_image"]) ? $extraFieldsValues["header_image"] : ''; ?>">
			<input type="button" class="choose-category-icon-button button button-secondary" <?php echo aitDataAttr('select-image', array('title' => 'Select Image', 'buttonTitle' => __('Insert Image', 'ait-toolkit'))); ?> style="width:25%;" value="<?php _e('Select Image', 'ait-toolkit') ?>" id="<?php echo $this->itemCategoryId ?>[header_image]-media-button">
		</div>

		<div class="form-field">
			<label for="<?php echo $this->itemCategoryId ?>[header_image_align]"><?php _e('Header Image Align', 'ait-toolkit') ?></label>
			<select name="<?php echo $this->itemCategoryId ?>[header_image_align]" id="<?php echo $this->itemCategoryId ?>[header_image_align]" style="width:70%;">
					<option value="image-left"selected><?php _e('Left', 'ait-toolkit') ?></option>
					<option value="image-center"><?php _e('Center', 'ait-toolkit') ?></option>
					<option value="image-right"><?php _e('Right', 'ait-toolkit') ?></option>
				</select>
		</div>

		<div class="form-field">
			<label for="<?php echo $this->itemCategoryId ?>[category_featured]"><?php _e('Featured Category', 'ait-toolkit') ?></label>
			<input type="checkbox" name="<?php echo $this->itemCategoryId ?>[category_featured]" id="<?php echo $this->itemCategoryId ?>[category_featured]" value="true" >
		</div>

		<?php
	}



	public function saveExtraItemCategoryFormFields($term_id)
	{
		if(isset( $_POST[$this->itemCategoryId])){
			$extraFields = get_option( "{$this->itemCategoryId}_category_{$term_id}");
			$keys = array_keys($_POST[$this->itemCategoryId]);
			foreach ($keys as $key){
				$extraFields[$key] = $_POST[$this->itemCategoryId][$key];
			}
			update_option("{$this->itemCategoryId}_category_{$term_id}", $extraFields);
		}
	}



	public function editItemLocationFormFields($tag, $taxonomy)
	{
		$termId = $tag->term_id;
		$extraFieldsValues = get_option("{$this->itemLocationId}_category_{$termId}");
		?>

		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $this->itemLocationId ?>[keywords]"><?php _e('Keywords', 'ait-toolkit') ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo $this->itemLocationId ?>[keywords]" id="<?php echo $this->itemLocationId ?>[keywords]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["keywords"]) ? $extraFieldsValues["keywords"] : ''; ?>">
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $this->itemLocationId ?>[icon]"><?php _e('Icon', 'ait-toolkit') ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo $this->itemLocationId ?>[icon]" id="<?php echo $this->itemLocationId ?>[icon]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["icon"]) ? $extraFieldsValues["icon"] : ''; ?>">
				<input type="button" class="choose-category-icon-button button button-secondary" <?php echo aitDataAttr('select-image', array('title' => 'Select Image', 'buttonTitle' => __('Insert Image', 'ait-toolkit'))); ?> style="width:25%;" value="<?php _e('Select Icon', 'ait-toolkit') ?>" id="<?php echo $this->itemLocationId ?>[icon]-media-button">
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $this->itemLocationId ?>[header_type]"><?php _e('Header Type', 'ait-toolkit') ?></label>
			</th>
			<td>
				<select name="<?php echo $this->itemLocationId ?>[header_type]" id="<?php echo $this->itemLocationId ?>[header_type]" style="width:70%;">
					<option value="map" <?php echo isset($extraFieldsValues["header_type"]) && $extraFieldsValues["header_type"] == 'map' ? 'selected' : ''; ?>><?php _e('Map', 'ait-toolkit') ?></option>
					<option value="image" <?php echo isset($extraFieldsValues["header_type"]) && $extraFieldsValues["header_type"] == 'image' ? 'selected' : ''; ?>><?php _e('Image', 'ait-toolkit') ?></option>
					<option value="video" <?php echo isset($extraFieldsValues["header_type"]) && $extraFieldsValues["header_type"] == 'video' ? 'selected' : ''; ?>><?php _e('Video', 'ait-toolkit') ?></option>
					<option value="none" <?php echo isset($extraFieldsValues["header_type"]) && $extraFieldsValues["header_type"] == 'none' ? 'selected' : ''; ?>><?php _e('None', 'ait-toolkit') ?></option>
				</select>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $this->itemLocationId ?>[header_image]"><?php _e('Header Image', 'ait-toolkit') ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo $this->itemLocationId ?>[header_image]" id="<?php echo $this->itemLocationId ?>[header_image]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["header_image"]) ? $extraFieldsValues["header_image"] : ''; ?>">
				<input type="button" class="choose-category-icon-button button button-secondary" <?php echo aitDataAttr('select-image', array('title' => 'Select Image', 'buttonTitle' => __('Insert Image', 'ait-toolkit'))); ?> style="width:25%;" value="<?php _e('Select Image', 'ait-toolkit') ?>" id="<?php echo $this->itemLocationId ?>[header_image]-media-button">
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row">
				<label for="<?php echo $this->itemLocationId ?>[header_image_align]"><?php _e('Header Image Align', 'ait-toolkit') ?></label>
			</th>
			<td>
				<select name="<?php echo $this->itemLocationId ?>[header_image_align]" id="<?php echo $this->itemLocationId ?>[header_image_align]" style="width:70%;">
					<option value="image-left" <?php echo isset($extraFieldsValues["header_image_align"]) && $extraFieldsValues["header_image_align"] == 'image-left' ? 'selected' : ''; ?>><?php _e('Left', 'ait-toolkit') ?></option>
					<option value="image-center" <?php echo isset($extraFieldsValues["header_image_align"]) && $extraFieldsValues["header_image_align"] == 'image-center' ? 'selected' : ''; ?>><?php _e('Center', 'ait-toolkit') ?></option>
					<option value="image-right" <?php echo isset($extraFieldsValues["header_image_align"]) && $extraFieldsValues["header_image_align"] == 'image-right' ? 'selected' : ''; ?>><?php _e('Right', 'ait-toolkit') ?></option>
				</select>
			</td>
		</tr>

		<?php
	}



	public function addItemLocationFormFields($taxonomy)
	{
		?>
		<div class="form-field">
			<label for="<?php echo $this->itemLocationId ?>[keywords]"><?php _e('Keywords', 'ait-toolkit') ?></label>
			<input type="text" name="<?php echo $this->itemLocationId ?>[keywords]" id="<?php echo $this->itemLocationId ?>[keywords]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["keywords"]) ? $extraFieldsValues["keywords"] : ''; ?>">
		</div>

		<div class="form-field">
			<label for="<?php echo $this->itemLocationId ?>[icon]"><?php _e('Icon', 'ait-toolkit') ?></label>
			<input type="text" name="<?php echo $this->itemLocationId ?>[icon]" id="<?php echo $this->itemLocationId ?>[icon]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["icon"]) ? $extraFieldsValues["icon"] : ''; ?>">
			<input type="button" class="choose-category-icon-button button button-secondary" <?php echo aitDataAttr('select-image', array('title' => 'Select Image', 'buttonTitle' => __('Insert Image', 'ait-toolkit'))); ?> style="width:25%;" value="<?php _e('Select Icon', 'ait-toolkit') ?>" id="<?php echo $this->itemLocationId ?>[icon]-media-button">
		</div>

		<div class="form-field">
			<label for="<?php echo $this->itemLocationId ?>[header_type]"><?php _e('Header Type', 'ait-toolkit') ?></label>
			<select name="<?php echo $this->itemLocationId ?>[header_type]" id="<?php echo $this->itemLocationId ?>[header_type]" style="width:70%;">
				<option value="map" selected><?php _e('Map', 'ait-toolkit') ?></option>
				<option value="image"><?php _e('Image', 'ait-toolkit') ?></option>
				<option value="video"><?php _e('Video', 'ait-toolkit') ?></option>
				<option value="none"><?php _e('None', 'ait-toolkit') ?></option>
			</select>
		</div>

		<div class="form-field">
			<label for="<?php echo $this->itemLocationId ?>[header_image]"><?php _e('Header Image', 'ait-toolkit') ?></label>
			<input type="text" name="<?php echo $this->itemLocationId ?>[header_image]" id="<?php echo $this->itemLocationId ?>[header_image]" size="25" style="width:70%;" value="<?php echo isset($extraFieldsValues["header_image"]) ? $extraFieldsValues["header_image"] : ''; ?>">
			<input type="button" class="choose-category-icon-button button button-secondary" <?php echo aitDataAttr('select-image', array('title' => 'Select Image', 'buttonTitle' => __('Insert Image', 'ait-toolkit'))); ?> style="width:25%;" value="<?php _e('Select Image', 'ait-toolkit') ?>" id="<?php echo $this->itemLocationId ?>[header_image]-media-button">
		</div>

		<div class="form-field">
			<label for="<?php echo $this->itemLocationId ?>[header_image_align]"><?php _e('Header Image Align', 'ait-toolkit') ?></label>
			<select name="<?php echo $this->itemLocationId ?>[header_image_align]" id="<?php echo $this->itemLocationId ?>[header_image_align]" style="width:70%;">
				<option value="image-left"selected><?php _e('Left', 'ait-toolkit') ?></option>
				<option value="image-center"><?php _e('Center', 'ait-toolkit') ?></option>
				<option value="image-right"><?php _e('Right', 'ait-toolkit') ?></option>
			</select>
		</div>
		<?php
	}



	public function saveExtraItemLocationFormFields($term_id)
	{
		if ( isset( $_POST[$this->itemLocationId] ) ) {
			$extraFields = get_option( "{$this->itemLocationId}_category_{$term_id}");
			$keys = array_keys($_POST[$this->itemLocationId]);
			foreach ($keys as $key){
				$extraFields[$key] = $_POST[$this->itemLocationId][$key];
			}
			update_option("{$this->itemLocationId}_category_{$term_id}", $extraFields);
		}
	}



	public function addItemTaxonomiesSpecialPages($specialPages)
	{
		$pages = array();

		foreach ($this->getRawPublicTaxonomies() as $taxonomy) {
			$pages["_taxonomy_{$taxonomy->name}"] = array(
				'label'   => __($taxonomy->label, 'ait-toolkit'),
				'with-id' => false,
				'if' => "is_archive() && get_query_var('taxonomy') == '{$taxonomy->name}'",
			);
		}

		return array_merge($pages, $specialPages);
	}



	public function setBreadcrumbsSingularTaxonomy($taxonomy, $post)
	{
		if ($post->post_type == $this->internalId) {
			return $this->itemCategoryId;
		} else {
			return $taxonomy;
		}
	}



	public function addTaxonomiesCustomFieldsToBackup($options, $isDemoContent)
	{
		$options[] = "{$this->itemCategoryId}\_category\_%";
		$options[] = "{$this->itemLocationId}\_category\_%";
		return $options;
	}



	public static function moveLocationByMeters($lat, $lng, $top, $left)
	{
		// Earth’s radius, sphere
		$R = 6378137;

		// Coordinate offsets in radians
		$dLat = floatval($top) / $R;
		$dLng = floatval($left) / ( $R * cos(pi() * floatval($lat) / 180) );

		// OffsetPosition, decimal degrees
		$nlat = floatval($lat) + ( $dLat * 180 / pi() );
		$nlng = floatval($lng) + ( $dLng * 180 / pi() );

		return array( 'lat' => $nlat, 'lng' => $nlng);
	}



	public static function saveItemMeta($postId, $post, $metabox, $data)
	{
		if($post->post_type == 'ait-item'){
			// do a query for every item
			// check the current value with the already existing values
			// if there is a match, move the current point by approx. 1 ~ 3 meters
			$position_current = array(
				'lat'	=> $data['map']['latitude'],
				'lng'	=> $data['map']['longitude'],
			);

			if(($data['map']['latitude'] === "1" && $data['map']['longitude'] === "1") != true){
				// move the pointers only if the coords are not 1:1

				$query = new WP_Query(array(
					'post_type' => 'ait-item',
					'posts_per_page' => -1,
				));

				if(empty($data)){
					$d = get_post_meta($postId, '_ait-item_item-data');
					$data = reset($d);
				}

				if($query->found_posts > 0){
					foreach($query->posts as $index => $post){
						if($post->ID != $postId){
							$meta = get_post_meta( $post->ID, '_ait-item_item-data');
							$meta_data = reset($meta);
							if($meta != false){
								if(!empty($meta_data['map']['latitude']) && !empty($meta_data['map']['longitude'])){
									$position_old = array(
										'lat'	=> $meta_data['map']['latitude'],
										'lng'	=> $meta_data['map']['longitude'],
									);
									// comparsion between values stored and value about to be stored
									if($position_current['lat'] == $position_old['lat'] && $position_current['lng'] == $position_old['lng']){
										$position_new = self::moveLocationByMeters($position_current['lat'], $position_current['lng'], mt_rand(1,30), mt_rand(1,30));
										$data['map']['latitude'] = $position_new['lat'];
										$data['map']['longitude'] = $position_new['lng'];
									}
								}
								if (!empty($data['map'])) {
									$data['map']['address'] = str_replace(array('\"','"'), "", $data['map']['address']);
								}
							}
						}
					}
				}
			}

			// save custom field for separate use
			$cfIgnored = array('post_id', 'rating_count', 'rating_max', 'rating_mean', 'rating_mean_rounded');
			if(isset($data['customFields'])){
				if(is_array($data['customFields']) && count($data['customFields']) > 0){
					foreach($data['customFields'] as $index => $field){
						if(!in_array($field['name'], $cfIgnored)){
							update_post_meta($postId, $field['name'], $field['value']);
						} else {
							unset($data['customFields'][$index]);
						}
					}
				}
			}

			// save single featured item separetely
			if(isset($data['featuredItem'])){
				// if there is a featuredItem option
				if(intval($data['featuredItem']) == 1){
					// the featured item is on
					update_post_meta($postId, '_ait-item_item-featured', "true");
				} else {
					//update_post_meta($postId, '_ait-item_item-featured', "false");
					delete_post_meta($postId, '_ait-item_item-featured');
				}
			} else {
				// all items in not a featured package
				//update_post_meta($postId, '_ait-item_item-featured', "false");
				delete_post_meta($postId, '_ait-item_item-featured');
			}

			update_post_meta($postId, '_ait-item_item-data', $data);
		}
	}



	public function dontRenderControls($true, $oid)
	{
		if($oid === '_taxonomy_ait-items' or $oid === '_taxonomy_ait-locations'){
			return false;
		}

		return $true;
	}



	public function dontRenderControlsMessage($msg, $configType, $groupId, $oid)
	{
		if($oid === '_taxonomy_ait-items' or $oid === '_taxonomy_ait-locations'){
			$taxName = get_taxonomy('ait-items')->labels->menu_name;
			if($configType === 'elements' and $groupId === 'revolution-slider'){
				if(!aitIsPluginActive('revslider')){
					return $msg;
				}else{
					return sprintf(__("There are no Revolution Slider element options for this '%s' page", 'ait-toolkit'), $taxName);
				}
			}elseif($configType === 'elements' and $groupId === 'seo'){
				return sprintf(__("There are no SEO element options for this '%s' page", 'ait-toolkit'), $taxName);
			}
		}
		return $msg;
	}



	public function dontRenderSpecificOptionControls($true, $optionControl, $oid)
	{
		if($oid === '_taxonomy_ait-items' or $oid === '_taxonomy_ait-locations'){
			if($optionControl->getKey() == 'headerType' and $optionControl->getParentSection()->getParentGroup()->getConfigName() == 'layout'){
				return false;
			}
		}
		return $true;
	}

	public function itemChangeColumns($cols){
		$cols['ait-item-author'] = __('Item Author', 'ait-toolkit');
		$cols['ait-item-featured'] = __('Featured', 'ait-toolkit');
		return $cols;
	}

	public function cptCustomColumns($column, $id){
		$post = get_post($id);
		$meta = get_post_meta($id);
		$featured = get_post_meta($id, '_ait-item_item-featured', true);
		switch($column){
			case 'ait-item-author':
				$author = get_user_by('id', $post->post_author);
				$link = get_edit_user_link( $post->post_author );
				if ($author) {
					echo '<a href="'.$link.'">'.$author->display_name.'</a>';
				} else {
					echo '-';
				}
			break;
			case 'ait-item-featured':
				$feat = !empty($featured) ? __('yes', 'ait-toolkit') : __('no', 'ait-toolkit');
				echo $feat;
			break;
		}
	}

	public static function fillAuthorMetabox(){
		$wp_users = get_users(array('orderby' => 'ID'));
		$result = array();		

		// push current option (in this case the post author) to the first position
		global $post;
		$unset = null;
		if(isset($post)){
			$user = new WP_User($post->post_author);			
			$result[$user->ID] = $user->data->user_nicename;
			$unset = $user->ID;
		}

		//id => label
		foreach($wp_users as $index => $user){
			if($user->ID != $unset){
				$result[$user->ID] = $user->data->user_nicename;
			}
		}
		return $result;		
	}

	public static function saveAuthorMetabox($postId, $post, $metabox, $data){
		if($post->post_type == 'ait-item'){
			if(empty($data)){
				$data = get_post_meta($postId, '_ait-item_item-author', true);
			}

			if(is_array($data) && !empty($data)){
				$update_post = array(
					'ID' => $post->ID,
					'post_author' => intval($data['author']),
				);
				
				if(!isset($GLOBALS['ait_saveAuthorMetabox_runned_once'])){
					$GLOBALS['ait_saveAuthorMetabox_runned_once'] = true;
					wp_update_post($update_post);					
					
					update_post_meta($postId, '_ait-item_item-author', $data);
				}
			}
		}
	}


}
