<?php

/*
 * AIT Shortcodes WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


return array(

	'title' => __('Button', 'ait-shortcodes'),

	'configuration' => array(
		'class' => 'AitButtonShortcode',
		'type' => 'single',
	),

	'attrs' => array(
		'title'        => 'Button',
		'titlecolor'   => '',
		'description'  => '',
		'textcolor'    => '',
		'textalign'    => 'center',
		'width'        => '180px',
		'url'          => '#',
		'urlnewwindow' => false,
		'bgcolor'      => '',
		'align'        => 'none',
		'iconurl'      => '',
		'fonticon'    => '',
		'iconalign'    => 'left',
		'margintop'    => '',
		'marginleft'   => '',
		'marginright'  => '',
		'marginbottom' => '',
		'escapetext'   => true,
	),

	'options' => array(
		'title' => array(
			'label'   => __('Title', 'ait-shortcodes'),
			'type'    => 'text',
			'default' => 'Button',
			'help'   => __('Text displayed as button title', 'ait-shortcodes'),
		),
		'titlecolor' => array(
			'label'   => __('Title Color', 'ait-shortcodes'),
			'type'    => 'color',
			'default' => '',
			'help'   => __('Color of button title', 'ait-shortcodes'),
		),
		'description' => array(
			'label' => __('Description', 'ait-shortcodes'),
			'type'  => 'text',
			'help'   => __('Text displayed below button title', 'ait-shortcodes'),
		),
		'textcolor' => array(
			'label'   => __('Description Color', 'ait-shortcodes'),
			'type'    => 'color',
			'default' => '',
			'help'   => __('Color of button description text', 'ait-shortcodes'),
		),
		'textalign' => array(
			'label'    => __('Text Alignment', 'ait-shortcodes'),
			'type'     => 'select',
			'selected' => 'center',
			'default'  => array(
				'center' => _x('Center', 'alignment', 'ait-shortcodes'),
				'left'   => _x('Left', 'alignment', 'ait-shortcodes'),
				'right'  => _x('Right', 'alignment', 'ait-shortcodes'),
			),
			'help'   => __('Select alignment of button text', 'ait-shortcodes'),
		),
		'width' => array(
			'label'   => __('Width', 'ait-shortcodes'),
			'type'    => 'number',
			'default' => '180px',
			'unit'    => 'px / %',
			'help'   => __('Width of button in px or %', 'ait-shortcodes'),
		),
		'url' => array(
			'label'   => __('URL', 'ait-shortcodes'),
			'type'    => 'url',
			'default' => '#',
			'help'   => __('URL for button link, use valid URL format with http://', 'ait-shortcodes'),
		),
		'urlnewwindow' => array(
			'label'   => __('Open In New Window', 'ait-shortcodes'),
			'type'    => 'on-off',
			'default' => false,
			'help' => __('Open links in new window or tab', 'ait-shortcodes'),
		),
		'bgcolor' => array(
			'label'   => __('Button Color', 'ait-shortcodes'),
			'type'    => 'color',
			'default' => '',
			'help'   => __('Color of button', 'ait-shortcodes'),
		),
		'align' => array(
			'label'    => __('Button Alignment', 'ait-shortcodes'),
			'type'     => 'select',
			'selected' => 'none',
			'default'  => array(
				'none'   => _x('None', 'alignment', 'ait-shortcodes'),
				'left'   => _x('Left', 'alignment', 'ait-shortcodes'),
				'right'  => _x('Right', 'alignment', 'ait-shortcodes'),
				'center' => _x('Center', 'alignment', 'ait-shortcodes'),
			),
			'help'   => __('Select alignment of button', 'ait-shortcodes'),
		),
		'iconurl' => array(
			'label' => __('Icon', 'ait-shortcodes'),
			'type'  => 'image',
			'help'   => __('URL of image displayed as icon on button, use valid URL format with http://', 'ait-shortcodes'),
		),
		'fonticon' => array(
			'label' => __('Font Awesome Icon', 'ait-shortcodes'),
			'type'  => 'font-awesome-select',
			'help'   => __('Choose an icon', 'ait-shortcodes'),
		),
		'iconalign' => array(
			'label' => __('Icon position', 'ait-shortcodes'),
			'type'     => 'select',
			'selected' => 'left',
			'default'  => array(
				'left'   => _x('Left', 'position', 'ait-shortcodes'),
				'right'  => _x('Right', 'position', 'ait-shortcodes'),
				'top'    => _x('Top', 'position', 'ait-shortcodes'),
				'bottom' => _x('Bottom', 'position', 'ait-shortcodes'),
			),
			'help'   => __('Position of icon on button', 'ait-shortcodes'),
		),
		'margintop' => array(
			'label'   => __('Top Margin', 'ait-shortcodes'),
			'type'    => 'number',
			'default' => '',
			'unit'    => 'px / %',
			'help'   => __('Space above button in px or %', 'ait-shortcodes'),
		),
		'marginleft' => array(
			'label'   => __('Left Margin', 'ait-shortcodes'),
			'type'    => 'number',
			'default' => '',
			'unit'    => 'px / %',
			'help'   => __('Space on the left of button in px or %', 'ait-shortcodes'),
		),
		'marginright' => array(
			'label'   => __('Right Margin', 'ait-shortcodes'),
			'type'    => 'number',
			'default' => '',
			'unit'    => 'px / %',
			'help'   => __('Space on the right of button in px or %', 'ait-shortcodes'),
		),
		'marginbottom' => array(
			'label'   => __('Bottom Margin', 'ait-shortcodes'),
			'type'    => 'number',
			'default' => '',
			'unit'    => 'px / %',
			'help'   => __('Space below button in px or %', 'ait-shortcodes'),
		),
		'escapetext' => array(
			'label'   => __('Escape Texts', 'ait-shortcodes'),
			'type'    => 'on-off',
			'default' => true,
			'help' => __('Escape texts in button title and description', 'ait-shortcodes'),
		),
	),
);
