<?php

/*
 * AIT WordPress Theme
 *
 * Copyright (c) 2014, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

class AitEventWithMapCpt extends AitPublicCpt {



	public function  __construct($id, $config, $paths)
	{
		parent::__construct($id, $config, $paths);

		add_filter("manage_{$this->internalId}_posts_columns" , array($this, 'manageEventsColumns'));
		add_action("manage_{$this->internalId}_posts_custom_column" , array($this, 'customEventsColumnValue'), 10, 2 );
	}


	public function manageEventsColumns($columns) {

		$newColumns = array(
			'item' => __('Item'),
		);
		return array_merge($columns, $newColumns);
	}


	public function customEventsColumnValue($column, $postId)
	{
		if ($column == 'item') {
			$meta = $this->getPostMeta('event-with-map-relations-data');
			if (isset($meta['item'])) {
				echo get_the_title($meta['item']);
			} else {
				echo '';
			}
		}
	}


} 
