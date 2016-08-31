<?php

/*
 * AIT WordPress Theme Framework
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

/**
 * Content Column displays value from 'post_content' field
 *
 * type: content
 * params:
 *     words (optional)     how many words to display
 */
class AitContentListTableColumn extends AitListTableColumn
{
	const WORDS = 20;

	public function getValue($postId)
	{
		extract($this->params);
		return wp_trim_words(get_post_field('post_content', $postId), self::WORDS);
	}
}

