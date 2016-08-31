<?php

/*
 * AIT WordPress Theme
 *
 * Copyright (c) 2014, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

class AitRatingCpt extends AitPublicCpt {

	protected $ratingCategoryId;

	public function __construct($id, $config, $paths)
	{
		parent::__construct($id, $config, $paths);

		$this->ratingCategoryId = 'ait-' . key($config['taxonomies']);
		$this->modifyRatingCategories();
	}



	private function modifyRatingCategories()
	{
		add_action("{$this->ratingCategoryId}_add_form_fields", array($this, 'addRatingCategoryFormFields'), 10, 2);
		add_action("{$this->ratingCategoryId}_edit_form_fields", array($this, 'editRatingCategoryFormFields'), 10, 2);
		add_action("edited_{$this->ratingCategoryId}", array($this, 'saveExtraRatingCategoryFormFields'), 10, 2);
		add_action("created_{$this->ratingCategoryId}", array($this, 'saveExtraRatingCategoryFormFields'), 10, 2);
	}

	public function editRatingCategoryFormFields($tag, $taxonomy)
	{
		$termId = $tag->term_id;
		$extraFieldsValues = get_option( "{$this->ratingCategoryId}_category_{$termId}");

		for ($i = 1; $i <= 5; $i++): ?>
			<tr class="form-field form-required">
				<th scope="row">
					<label for="<?php echo $this->ratingCategoryId ?>[rating_<?php echo $i ?>]"><?php _e('Rating ', 'ait-toolkit'); echo $i ?></label>
				</th>
				<td>
					<input type="text" name="<?php echo $this->ratingCategoryId ?>[rating_<?php echo $i ?>]" id="<?php echo $this->ratingCategoryId ?>[rating_<?php echo $i ?>]" size="25" style="width:60%;" value="<?php echo isset($extraFieldsValues["rating_$i"]) ? $extraFieldsValues["rating_$i"] : ''; ?>"><br />
				</td>
			</tr>
		<?php endfor;
	}


	public function addRatingCategoryFormFields($taxonomy)
	{
		for ($i = 1; $i <= 5; $i++): ?>
			<div class="form-field form-required">
				<label for="<?php echo $this->ratingCategoryId ?>[rating_<?php echo $i ?>]"><?php _e('Rating ', 'ait-toolkit'); echo $i ?></label>
				<input type="text" name="<?php echo $this->ratingCategoryId ?>[rating_<?php echo $i ?>]" id="<?php echo $this->ratingCategoryId ?>[rating_<?php echo $i ?>]" size="25" style="width:60%;" value="<?php echo isset($extraFieldsValues["rating_$i"]) ? $extraFieldsValues["rating_$i"] : ''; ?>"><br />
			</div>
		<?php endfor;
	}


	public function saveExtraRatingCategoryFormFields($term_id)
	{
		if ( isset( $_POST[$this->ratingCategoryId] ) ) {
			$extraFields = get_option( "{$this->ratingCategoryId}_category_{$term_id}");
			$keys = array_keys($_POST[$this->ratingCategoryId]);
			foreach ($keys as $key){
				$extraFields[$key] = $_POST[$this->ratingCategoryId][$key];
			}
			update_option("{$this->ratingCategoryId}_category_{$term_id}", $extraFields);
		}
	}


}