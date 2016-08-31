<?php

require_once 'classes/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'register_required_plugins' );

function register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'Easy Digital Downloads',
			'slug'      => 'easy-digital-downloads',
			'required'  => true
		),
		array(
			'name'      => 'Piklist',
			'slug'      => 'piklist',
			'required'  => true
		),
		array(
			'name'      => 'Basic User Avatars',
			'slug'      => 'basic-user-avatars',
			'required'  => true
		),
		array(
			'name'      => 'BuddyPress',
			'slug'      => 'buddypress',
			'required'  => true
		),
		array(
			'name'      => 'Favorites',
			'slug'      => 'favorites',
			'required'  => true
		)
	);
	tgmpa( $plugins );
}
