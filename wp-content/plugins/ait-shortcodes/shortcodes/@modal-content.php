<?php

/*
 * AIT Shortcodes WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


return array(

	'title' => __('Modal Window Content', 'ait-shortcodes'),

	'configuration' => array(
		'type' => 'closed',
	),

	'attrs' => array(
		'name'         	=> 'modal-content-1',
		'content'		=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
	),

	'options' => array(
		'name' => array(
			'label'    => __('Modal Window Content name', 'ait-shortcodes'),
			'type'     => 'code',
			'default'  => 'modal-content-1',
			'required' => true,
			'help'    => __('Write the same name as Modal Window Link name', 'ait-shortcodes'),
		),
		'content' => array(
			'label'   => __('Content', 'ait-shortcodes'),
			'type'    => 'textarea',
			'default' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
			'help'    => __('Content of the modal window', 'ait-shortcodes'),
		),
	),
);
