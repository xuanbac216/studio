<?php

/*
 * AIT Shortcodes WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


return array(

	'title' => __('Modal Window Link', 'ait-shortcodes'),

	'configuration' => array(
		'type' => 'closed',
		'assets' => array(
			'css' => array(
				'jquery-colorbox' => array(
					'file'    => '/colorbox/colorbox.min.css',
					'ver'     => '1.4.27',
				),
			),
			'js' => array(
				'jquery-colorbox' => array(
					'file'      => '/colorbox/jquery.colorbox.min.js',
					'deps'      => array('jquery'),
					'ver'       => '1.4.27',
				),
			),
		),
	),

	'attrs' => array(
		'type'         => 'link',
		'name' 		   => 'modal-content-1',
		'width'        => '500',
		'height'       => '500',
		'content'      => '[button]',
	),

	'options' => array(
		'type' => array(
			'label'	=> __('Type', 'ait-shortcodes'),
			'type'     => 'select',
			'default'  => array(
				'link' 		=> __('Simple text link', 'ait-shortcodes'),
				'button' 	=> __('Button', 'ait-shortcodes'),
			),
			'help'    => __('Select type of the link to modal window', 'ait-shortcodes'),
		),

		'content' => array(
			'label'   => __('Link text', 'ait-shortcodes'),
			'type'    => 'text',
			'default' => 'Open Modal Window',
			'help'    => __('Text displayed as link or title of button', 'ait-shortcodes'),
		),

		'name' => array(
			'label'   => __('Modal Window Link name', 'ait-shortcodes'),
			'type'    => 'code',
			'default' => 'modal-content-1',
			'help'    => __('Write the same name as Modal Window Content name', 'ait-shortcodes'),
		),
		'width' => array(
			'label'   => __('Width', 'ait-shortcodes'),
			'type'    => 'number',
			'unit'    => 'px',
			'default' => 500,
			'help' => __('Width of modal window in px', 'ait-shortcodes'),
		),
		'height' => array(
			'label' => __('Height', 'ait-shortcodes'),
			'type'  => 'number',
			'unit'  => 'px',
			'default' => 500,
			'help' => __('Height of modal window in px', 'ait-shortcodes'),
		),
	),
);
