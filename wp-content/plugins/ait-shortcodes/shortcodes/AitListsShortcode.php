<?php

/*
 * AIT Shortcodes WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

/**
 * Lists shortcode
 */
class AitListsShortcode extends AitShortcode
{

	public function render($attrs, $content, $tag)
	{
		$line = $attrs->line ? 'line' : '';
		$layout = 'layout-'.$attrs->layout;

		$replace = sprintf('<ul class="%s %s %s %s"', $this->htmlClass, $line, $attrs->style, $layout);

		$content = str_replace('<p>', '', $this->content($content));
		$content = str_replace('</p>', '', $content);

		return str_replace('<ul', $replace, $content);
	}
}