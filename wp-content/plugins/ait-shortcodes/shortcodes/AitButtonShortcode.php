<?php

/*
 * AIT Shortcodes WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

/**
 * Button shortcode
 */
class AitButtonShortcode extends AitShortcode
{

	protected function renderTemplate($attrs, $content, $tag)
	{
		// prepare data

		$style = array(
			$attrs->width ? "width:{$attrs->width};" : '',
			$attrs->bgcolor ? "background-color:{$attrs->bgcolor}; border-color:{$attrs->bgcolor};" : '',
			$attrs->titlecolor ? "color:{$attrs->titlecolor};" : '',
			$attrs->textcolor ? "color:{$attrs->textcolor};" : '',
			$attrs->textalign ? "text-align:{$attrs->textalign};" : '',
			$attrs->margintop ? "margin-top:{$attrs->margintop};" : '',
			$attrs->marginleft ? "margin-left:{$attrs->marginleft};" : '',
			$attrs->marginright ? "margin-right:{$attrs->marginright};" : '',
			$attrs->marginbottom ? "margin-bottom:{$attrs->marginbottom};" : '',
		);

		// ... and include template
		include $this->getTemplate();
	}


}