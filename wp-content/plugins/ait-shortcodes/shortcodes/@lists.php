<?php

/*
 * AIT Shortcodes WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


return array(

	'title' => __('Lists', 'ait-shortcodes'),

	'configuration' => array(
		'class' => 'AitListsShortcode',
		'type' => 'closed',
	),

	'attrs' => array(
		'layout'  => 'full',
		'style'   => 'style1',
		'line'    => true,
		'content' => '<ul><li>Lorem...</li><li>Ipsum...</li></ul>',
	),


	'options' => array(
		'layout' => array(
			'label' => __('Layout', 'ait-shortcodes'),
			'type' => 'select',
			'default' => array(
				'full' => _x('Full Width', 'layout width', 'ait-shortcodes'),
				'half' => _x('Half Width', 'layout width', 'ait-shortcodes'),
			),
			'help' => __('Select layout of displayed list', 'ait-shortcodes'),
		),
		'style' => array(
			'label'    => __('Style', 'ait-shortcodes'),
			'type'     => 'select',
			'default'  => array(
				'style1' => __('Style 1', 'ait-shortcodes'),
				'style2' => __('Style 2', 'ait-shortcodes'),
				'style3' => __('Style 3', 'ait-shortcodes'),
				'style4' => __('Style 4', 'ait-shortcodes'),
				'style5' => __('Style 5', 'ait-shortcodes'),
				'style6' => __('Style 6', 'ait-shortcodes'),
			),
			'help' => __('Select style of displayed list', 'ait-shortcodes'),
		),
		'line' => array(
			'label'   => __('Lines', 'ait-shortcodes'),
			'type'    => 'on-off',
			'default' => true,
			'help' => __('Display lines between list items', 'ait-shortcodes'),
		),
	),
);
