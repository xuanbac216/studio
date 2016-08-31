<?php

/*
 * AIT Toolkit WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */



/**
 * Prepared Custom Post Type class for internal usage
 */
class AitInternalCpt extends AitCpt
{
	protected $isPublic = false;

	protected $defaultPostArgs = array(
		'public'              => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'show_in_nav_menus'   => false,
		'show_in_menu'        => true, // 'true' - display as a top level menu
		'show_in_admin_bar'   => true,
		'supports'            => array('title', 'editor', 'thumbnail', 'page-attributes'),
		'has_archive'         => false,
	);

	protected $defaultTaxonomyArgs = array(
		'hierarchical' => true,
		'public' => false,
		'show_in_nav_menus' => false,
		'show_ui' => true,
		'show_admin_column' => true,
	);
}