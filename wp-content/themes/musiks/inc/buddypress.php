<?php
/**
 * Playlist
 *
 *
 */

if( function_exists('buddypress') ){

	function my_bp_nav_adder() {
		global $bp;
		if( get_theme_mod( 'show-playlist' ) ){
			bp_core_new_nav_item(
			array(
					'name'                => __('Playlists', 'musik' ),
					'slug'                => 'playlists',
					'position'            => 1,
					'screen_function'     => 'Playlistsdisplay',
					'default_subnav_slug' => 'playlists',
					'parent_url'          => $bp->loggedin_user->domain . $bp->slug . '/',
					'parent_slug'         => $bp->slug
			) );
		}

		if( get_theme_mod( 'show-likes' ) ){
			bp_core_new_nav_item(
			array(
					'name'                => __('Likes', 'musik' ),
					'slug'                => 'likes',
					'position'            => 1,
					'screen_function'     => 'Likesdisplay',
					'default_subnav_slug' => 'likes',
					'parent_url'          => $bp->loggedin_user->domain . $bp->slug . '/',
					'parent_slug'         => $bp->slug
			) );
		}
	}

	function Playlistsdisplay() {
		add_action( 'bp_template_content', 'my_groups_page_function_to_show_screen_content' );
		bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
	}

	function my_groups_page_function_to_show_screen_content() {
		global $bp;
		echo get_playlist_display($bp->displayed_user->id);
	}

	function Likesdisplay() {
		add_action( 'bp_template_content', 'likes_show_screen_content' );
		bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
	}

	function likes_show_screen_content() {
		global $bp;
		echo get_like_display($bp->displayed_user->id);
	}

	add_action( 'bp_setup_nav', 'my_bp_nav_adder', 50 );


	add_action( 'bp_before_member_header', 'musik_before_member_header', 50);
	add_action( 'bp_before_group_header', 'musik_before_group_header', 50);

	function musik_before_member_header(){
		$cover = bp_attachments_get_attachment( 'url', array( 'item_id' => bp_displayed_user_id() ) );
		echo sprintf('<style>#buddypress #header-cover-image { background-image: url(%s);}</style>', $cover);
	}

	function musik_before_group_header(){
		$cover = bp_attachments_get_attachment( 'url', array( 'object_dir'=>'groups', 'item_id' => bp_get_group_id() ) );
		echo sprintf('<style>#buddypress #header-cover-image { background-image: url(%s);}</style>', $cover);
	}

	function musik_record_my_custom_post_type_posts( $types ) {
      $types[] = 'download';
      $types[] = 'playlist';
      return $types;
    }
    add_filter( 'bp_blogs_record_post_post_types', 'musik_record_my_custom_post_type_posts' );

    function musik_record_my_custom_post_type_comments( $types ) {
      $types[] = 'download';
      $types[] = 'playlist';
      return $types;
    }
    add_filter( 'bp_blogs_record_comment_post_types', 'musik_record_my_custom_post_type_comments' );
	
}
