<?php

/*
 * AIT Shortcodes WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


return array(

	'title' => __('Horizontal rule', 'ait-shortcodes'),

	'configuration' => array(
		'type' => 'single',
		'assets' => array(
			'js' => array(
				'ait-sc-rule-btn' => array(
					'file' => '/js/rule-btn.js',
				),
			),
		),
	),

	'attrs' => array(
		'type'       => '',
	),

	'options' => array(
		'type' => array(
			'label'    => __('Type', 'ait-shortcodes'),
			'type'     => 'select',
			'default'  => array(
				'basic' 	=> _x('Basic', 'horizontal rule', 'ait-shortcodes'),
				'top'		=> _x('Top', 'horizontal rule', 'ait-shortcodes'),
				'empty'  	=> _x('Empty Line', 'horizontal rule', 'ait-shortcodes'),
				'clear'		=> _x('CSS clear', 'horizontal rule', 'ait-shortcodes'),
			),
			'help' => __('Select type of rule', 'ait-shortcodes'),
		),
	),
);
