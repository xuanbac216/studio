<?php

/*
 * AIT Shortcodes WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


return array(

	'title' => __('Notification', 'ait-shortcodes'),

	'configuration' => array(
		'type' 	=> 'closed',
	),

	'attrs' => array(
		'type'       => 'error',
		'content' => "Lorem ipsum dolor sit amet, consectetur adipisicing elit",
	),

	'options' => array(
		'type' => array(
			'label'    => __('Type', 'ait-shortcodes'),
			'type'     => 'select',
			'default'  => array(
				'error' 	=> _x('Warning', 'notification type', 'ait-shortcodes'),
				'success' 	=> _x('Success', 'notification type', 'ait-shortcodes'),
				'info' 		=> _x('Information', 'notification type', 'ait-shortcodes'),
				'attention' => _x('Attention', 'notification type', 'ait-shortcodes'),
			),
			'help' => __('Select type of notification', 'ait-shortcodes'),
		),
	),
);
