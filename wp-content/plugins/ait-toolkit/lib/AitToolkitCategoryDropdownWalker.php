<?php

/*
 * AIT Toolkit WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


/**
 * Create HTML dropdown list of Categories.
 */
class AitToolkitCategoryDropdownWalker extends Walker_CategoryDropdown
{

	function start_el(&$output, $category, $depth = 0, $args = array(), $id = 0)
	{
		$pad = str_repeat('&nbsp;', $depth * 3);

		// $args['selected'] must be slug or array of slugs when 'use_slug' is true
		$useSlug = (isset($args['use_slug']) and $args['use_slug']) ? true : false;

		$value = $useSlug ? $category->slug : $category->term_id;

		$cat_name = apply_filters('list_cats', $category->name, $category);
		$output .= "\t<option class=\"level-$depth\" value=\"" . $value . "\"";

		if(is_string($args['selected']) and $args['selected'] == $value)
			$output .= ' selected="selected"';
		elseif(is_array($args['selected']) and in_array($value, $args['selected']))
			$output .= ' selected="selected"';

		$output .= '>';
		$output .= $pad.$cat_name;

		if($args['show_count'])
			$output .= '&nbsp;&nbsp;('. $category->count .')';

		$output .= "</option>\n";
	}
}