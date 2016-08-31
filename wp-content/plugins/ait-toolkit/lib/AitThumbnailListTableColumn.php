<?php

/*
 * AIT WordPress Theme Framework
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

/**
 * Thumbnail Column displays post's image thumbnail
 *
 * type: thumbnail
 * params: (optional) width, (optional) height
 */
class AitThumbnailListTableColumn extends AitListTableColumn
{
	const WIDTH = 100;
	const HEIGHT = 100;


	public function getValue($postId = 0)
	{
		$width = self::WIDTH;
		$height = self::HEIGHT;
		extract($this->params);
		return get_the_post_thumbnail($postId, array($width, $height));
	}
}
