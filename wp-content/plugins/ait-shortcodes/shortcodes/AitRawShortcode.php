<?php

/*
 * AIT Shortcodes WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

/**
 * Raw shortcode
 */
class AitRawShortcode extends AitShortcode
{

	public function render($attrs, $content, $tag)
	{
		$out = str_replace('<br />', '', do_shortcode( force_balance_tags( $this->content($content) ) ) );
		$out = str_replace('<p></p>', '', $out );
		$out = str_replace('</div></p>', '</div>', $out );
		$out = str_replace("</div>\n</p>", '</div>', $out );
		return $out;
	}
}