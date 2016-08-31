<?php
/**
 * Custom edd
 *
 * Learn more: http://docs.easydigitaldownloads.com/
 *
 */

if ( class_exists( 'Easy_Digital_Downloads' ) ) :

	if ( ! function_exists( 'edd_slug' ) ) {
		function edd_slug() {
			define('EDD_SLUG', 'music'); 
		}
	}
	edd_slug();

	// Change edd labels
	if ( ! function_exists( 'edd_labels' ) ) {
		function edd_labels( $labels ) {
			$labels = array(
			   'singular' => esc_html__('Music', 'musik'),
			   'plural'   => esc_html__('Music', 'musik')
			);
			return $labels;
		}
	}
	add_filter('edd_default_downloads_name', 'edd_labels');

	// Change icon
	remove_action( 'admin_head', 'edd_admin_downloads_icon' );
	if ( ! function_exists( 'edd_menu_icon' ) ) {
		function edd_menu_icon( $args ){
			$args['menu_icon'] = 'dashicons-format-audio';
			return $args;
		}
	}
	add_filter( 'edd_download_post_type_args', 'edd_menu_icon');

	// Change category labels
	if ( ! function_exists( 'edd_cat_labels' ) ) {
		function edd_cat_labels( $labels ) {
			$singular  = 'Genre';
			$plural    = 'Genres';
			$labels = get_labels($singular, $plural);
			return $labels;
		}
	}
	add_filter( 'edd_download_category_labels', 'edd_cat_labels' );

	// change the category slug
	if ( ! function_exists( 'edd_cat_args' ) ) {
		function edd_cat_args( $args ){
			$args['rewrite'] = array( 'slug' => 'genre', 'with_front' => false, 'hierarchical' => true);
			return $args;
		}
	}
	add_filter( 'edd_download_category_args', 'edd_cat_args');

	// add artist taxomomy
	if ( ! function_exists( 'artist_taxonomies' ) ) {
		function artist_taxonomies($taxonomies){
			$singular  = 'Artist';
			$plural    = 'Artists';
			$taxonomies[] = array(
			  'post_type' => 'download'
			  ,'name' => 'download_artist'
			  ,'show_admin_column' => true
			  ,'configuration' => array(
			    'hierarchical' => false
			    ,'labels' => get_labels($singular, $plural)
			    ,'hide_meta_box' => false
			    ,'show_ui' => true
			    ,'query_var' => true
			    ,'rewrite' => array( 
			      'slug' => 'artists' 
			    )
			    ,'capabilities' => array( 'manage_terms' => 'manage_product_terms','edit_terms' => 'edit_product_terms','assign_terms' => 'assign_product_terms','delete_terms' => 'delete_product_terms' )
			  )
			);
			return $taxonomies;
		}
	}
	add_filter('piklist_taxonomies', 'artist_taxonomies');

	// Get labels
	function get_labels( $singular, $plural ){
		$labels =  array(
			'name'               => _x( '%2$s', 'taxonomy general name', 'musik' ),
			'singular_name'      => _x( '%1$s', 'taxonomy singular name', 'musik' ),
			'add_new'            => __( 'Add New', 'musik' ),
			'add_new_item'       => __( 'Add New %1$s', 'musik' ),
			'new_item_name' 	 => __( 'New %1$s Name', 'musik' ),
			'edit_item'          => __( 'Edit %1$s', 'musik' ),
			'new_item'           => __( 'New %1$s', 'musik' ),
			'all_items'          => __( 'All %2$s', 'musik' ),
			'view_item'          => __( 'View %1$s', 'musik' ),
			'update_item' 		 => __( 'Update %1$s', 'musik' ),
			'search_items'       => __( 'Search %2$s', 'musik' ),
			'popular_items'		 => __( 'Popular %2$s', 'musik' ),
			'not_found'          => __( 'No %2$s found', 'musik' ),
			'not_found_in_trash' => __( 'No %2$s found in Trash', 'musik' ),
			'parent_item' 		 => __( 'Parent %1$s', 'musik' ),
			'parent_item_colon'  => __( 'Parent %1$s :', 'musik' ),
			'separate_items_with_commas'	=> __( 'Separate %2$s with commas', 'musik' ),
			'add_or_remove_items' 			=> __( 'Add or remove %2$s', 'musik' ),
			'choose_from_most_used' 		=> __( 'Choose from most used %2$s', 'musik' ),
			'menu_name'          => _x( '%2$s', 'taxonomy menu name', 'musik' )
		);
		foreach ( $labels as $key => $value ) {
		   $labels[ $key ] = sprintf( $value, $singular, $plural );
		}
		return $labels;
	}

	// disable the microdata for layout
	add_filter( 'edd_add_schema_microdata', '__return_false' );

	// allow comments
	if ( ! function_exists( 'edd_supports' ) ) {
		function edd_supports($supports){
			$supports[] = 'comments';
			return $supports;
		}
	}
	add_filter( 'edd_download_supports', 'edd_supports' );

	// change avatar on profile page
	if ( ! function_exists( 'edd_profile_avatar' ) ) {
		function edd_profile_avatar(){
			echo do_shortcode('[basic-user-avatars]');
		}
	}
	add_filter( 'edd_profile_editor_before', 'edd_profile_avatar' );

	// remove the auto purchase btton after the content.
	remove_action( 'edd_after_download_content', 'edd_append_purchase_link' );

	// add register link after the login form
	if ( ! function_exists( '_edd_login_after' ) ) {
		function _edd_login_after(){
			echo '<a href="'.esc_url( get_permalink( get_theme_mod( 'register-page') ) ).'" class="text-info">'. __( 'Register New Account', 'musik' ) .'</a>';
		}
	}
	add_action('edd_login_fields_after', '_edd_login_after');

	add_filter( 'login_url', 'musik_login_url', 10, 2 );
	function musik_login_url( $login_url, $redirect ){
	    return get_permalink( get_theme_mod( 'login-page') );
	}

	// ajax to get the media
	function edd_media(){
		if( !isset($_REQUEST['id']) ){
			die(0);
		}
		$post_id = intval($_REQUEST['id']);

		$plays = get_post_meta( $post_id, 'plays', true );
		update_post_meta( $post_id, 'plays', $plays + 1 );

		$list = edd_get_bundled_products( $post_id );
		if(empty($list)){
			$list = array($post_id);

			$post = get_post($post_id);
			if($post->post_type == 'playlist'){
				$tracks = get_post_meta($post->ID, 'tracks', true);
				$list = explode(',', trim($tracks));
			}
		};

		$args = array(
			'posts_per_page'   => -1,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => 'download',
            'post_mime_type'   => '',
            'post_parent'      => '',
            'author'           => '',
            'post_status'      => 'publish',
            'suppress_filters' => true,
		    'post__in' 		   => $list
        );
        $objs = array();
		$posts = get_posts($args);
		foreach ( $posts as $post ){
			$obj = array();
			$obj['id'] = $post->ID;
			$obj['ids'] = $post_id;
			$obj['title'] = '</a><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a>';
			$obj = array_merge($obj, get_preview($post->ID) );
			$terms = get_the_terms( $post->ID, 'download_artist', '', ', ', '' );
			if ( $terms && ! is_wp_error( $terms ) ) {
				$artist = array();
				foreach ( $terms as $term ) {
					$artist[] = $term->name;
				}
				$obj['artist'] = join( ", ", $artist );
			}
			$obj['poster'] = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
			$objs[] = $obj;
		}
		
		echo json_encode($objs);
      	die();
	}

	add_action( 'wp_ajax_nopriv_get_media', 'edd_media' );
	add_action( 'wp_ajax_get_media', 'edd_media' );

	function get_preview($pid){
		$obj = array();
		// soundcloud
		$trackid = get_post_meta($pid, 'soundcloud_trackid', true);
		if($trackid){
			$obj['mp3'] = sprintf('http://api.soundcloud.com/tracks/%s/stream?client_id=%s', $trackid, get_theme_mod( 'soundcloud-clientid') );
			return $obj;
		}
		$preview_type = get_post_meta($pid, 'preview_type', true);
		if($preview_type == 'remote'){
			$group = get_post_meta($pid, 'preview_url', true);
			foreach($group['preview_media_type'] as $key=>$value){
				$obj[$value] = $group['preview_media_url'][$key];
			}
		}else{
			// FES field value
			$ids = get_post_meta($pid, 'preview_vendor', true);
			if(!$ids){
				// local files
				$ids  = get_post_meta($pid, 'preview');
			}
			foreach($ids as $id){
				$preview = wp_get_attachment_url( $id );
				$metadata = wp_get_attachment_metadata($id);
				if(!empty($metadata) && isset($metadata['fileformat'])){
					switch($metadata['fileformat']){
						case 'mp3':
							$obj['mp3'] = $preview;
							break;
						case 'mp4':
							$obj['m4a'] = $preview;
							break;
						case 'ogg':
							$obj['oga'] = $preview;
							break;
						case 'webm':
							$obj['webma'] = $preview;
							break;
					}
				}
			}
		}

		return $obj;
	}

	function edd_download(){
		if( !isset($_REQUEST['file']) ){
			die(0);
		}

		$filename = $_REQUEST['file'];
		$fileinfo = pathinfo($filename);
		$not_allowed_ext = array('php');
		if (in_array($fileinfo['extension'], $not_allowed_ext)) {
		    die('This file type is forbidden.');
		}

		header('Content-Type: application/octet-stream');
		header("Content-Transfer-Encoding: Binary");
		header("Content-disposition: attachment; filename=\"" . basename($filename) . "\"");
		readfile($filename);
		exit();
	}

	add_action( 'wp_ajax_nopriv_download', 'edd_download' );
	add_action( 'wp_ajax_download', 'edd_download' );

endif;
