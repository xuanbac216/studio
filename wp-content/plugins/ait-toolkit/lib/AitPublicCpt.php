<?php

/*
 * AIT Toolkit WordPress Plugin
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */



/**
 * Prepared Custom Post Type class for public usage
 */
class AitPublicCpt extends AitCpt
{
	protected $isPublic = true;

	protected $defaultPostArgs = array(
		'public'              => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_nav_menus'   => true,
		'show_in_menu'        => true, // 'true' - display as a top level menu
		'show_in_admin_bar'   => true,
		'supports'            => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'revisions', 'page-attributes'),
		'has_archive'         => true,
	);

	protected $defaultTaxonomyArgs = array(
		'hierarchical' => true,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_admin_column' => true,
	);
}
