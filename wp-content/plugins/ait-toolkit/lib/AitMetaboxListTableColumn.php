<?php

/*
 * AIT WordPress Theme Framework
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

/**
 * Metabox Column displays value from metabox defined in params.
 * Key of metabox value equals to name of the column by default
 *
 * type: metabox
 * params:
 *     metabox          metabox identifier
 *     key (optional)   custom key of metabox value, column name by default
 */
class AitMetaboxListTableColumn extends AitListTableColumn
{

	public function getValue($postId = 0)
	{
		$key = $this->name;
		extract($this->params);

		$value = '';

		$meta = $this->metabox->getPostMeta($postId);

		if(isset($meta[$key])){
			$value = $meta[$key];
		}

		return $value;
	}
}

