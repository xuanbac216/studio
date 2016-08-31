<?php
/*
Plugin Name: Goodlayers Event Post Type
Plugin URI: 
Description: A Custom Post Type Plugin To Use With Goodlayers Theme ( This plugin functionality might not working properly on another theme )
Version: 1.0.0
Author: Goodlayers
Author URI: http://www.goodlayers.com
License: 
*/
include_once( 'gdlr-event-item.php');	
include_once( 'gdlr-event-option.php');		

// action to loaded the plugin translation file
add_action('plugins_loaded', 'gdlr_event_init');
if( !function_exists('gdlr_event_init') ){
	function gdlr_event_init() {
		load_plugin_textdomain( 'gdlr-event', false, dirname(plugin_basename( __FILE__ ))  . '/languages/' ); 
	}
}

// add action to create event post type
add_action( 'init', 'gdlr_create_event' );
if( !function_exists('gdlr_create_event') ){
	function gdlr_create_event() {
		global $theme_option;
		
		if( !empty($theme_option['event-slug']) ){
			$event_slug = $theme_option['event-slug'];
			$event_category_slug = $theme_option['event-category-slug'];
			$event_tag_slug = $theme_option['event-tag-slug'];
		}else{
			$event_slug = 'event';
			$event_category_slug = 'event_category';
			$event_tag_slug = 'event_tag';
		}
		
		register_post_type( 'event',
			array(
				'labels' => array(
					'name'               => __('Events', 'gdlr-event'),
					'singular_name'      => __('Event', 'gdlr-event'),
					'add_new'            => __('Add New', 'gdlr-event'),
					'add_new_item'       => __('Add New Event', 'gdlr-event'),
					'edit_item'          => __('Edit Event', 'gdlr-event'),
					'new_item'           => __('New Event', 'gdlr-event'),
					'all_items'          => __('All Events', 'gdlr-event'),
					'view_item'          => __('View Event', 'gdlr-event'),
					'search_items'       => __('Search Event', 'gdlr-event'),
					'not_found'          => __('No events found', 'gdlr-event'),
					'not_found_in_trash' => __('No events found in Trash', 'gdlr-event'),
					'parent_item_colon'  => '',
					'menu_name'          => __('Events', 'gdlr-event')
				),
				'public'             => true,
				'publicly_queryable' => true,
				'show_ui'            => true,
				'show_in_menu'       => true,
				'query_var'          => true,
				'rewrite'            => array( 'slug' => $event_slug  ),
				'capability_type'    => 'post',
				'has_archive'        => true,
				'hierarchical'       => false,
				'menu_position'      => 5,
				'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comment', 'custom-fields' )
			)
		);
		
		// create event categories
		register_taxonomy(
			'event_category', array("event"), array(
				'hierarchical' => true,
				'show_admin_column' => true,
				'label' => __('Event Categories', 'gdlr-event'), 
				'singular_label' => __('Event Category', 'gdlr-event'), 
				'rewrite' => array( 'slug' => $event_category_slug  )));
		register_taxonomy_for_object_type('event_category', 'event');
		
		// create event tag
		register_taxonomy(
			'event_tag', array('event'), array(
				'hierarchical' => false, 
				'show_admin_column' => true,
				'label' => __('Event Tags', 'gdlr-event'), 
				'singular_label' => __('Event Tag', 'gdlr-event'),  
				'rewrite' => array( 'slug' => $event_tag_slug  )));
		register_taxonomy_for_object_type('event_tag', 'event');	

		// add filter to style single template
		if( defined('WP_THEME_KEY') && WP_THEME_KEY == 'goodlayers' ){
			add_filter('single_template', 'gdlr_register_event_template');
		}
		
		// add hook to save page options
		add_action('pre_post_update', 'gdlr_save_event_meta_option');
	}
}

if( !function_exists('gdlr_save_event_meta_option') ){
	function gdlr_save_event_meta_option( $post_id ){
		if( get_post_type() == 'event' && isset($_POST['post-option']) ){
			$post_option = gdlr_preventslashes(gdlr_stripslashes($_POST['post-option']));
			$event_option = json_decode(gdlr_decode_preventslashes($post_option), true);
			
			if(!empty($event_option['date'])){
				update_post_meta($post_id, 'gdlr-event-date', $event_option['date'] . ' ' . substr($event_option['time'], 0, 5));
			}
		}
	}
}

if( !function_exists('gdlr_register_event_template') ){
	function gdlr_register_event_template($single_template) {
		global $post;

		if ($post->post_type == 'event') {
			$single_template = dirname( __FILE__ ) . '/single-event.php';
		}
		return $single_template;	
	}
}

// add filter for adjacent event 
add_filter('get_previous_post_where', 'gdlr_event_post_where', 10, 2);
add_filter('get_next_post_where', 'gdlr_event_post_where', 10, 2);
if(!function_exists('gdlr_event_post_where')){
	function gdlr_event_post_where( $where, $in_same_cat ){ 
		global $post; 
		if ( $post->post_type == 'event' ){
			$current_taxonomy = 'event_category'; 
			$cat_array = wp_get_object_terms($post->ID, $current_taxonomy, array('fields' => 'ids')); 
			if($cat_array){ 
				$where .= " AND tt.taxonomy = '$current_taxonomy' AND tt.term_id IN (" . implode(',', $cat_array) . ")"; 
			} 
			}
		return $where; 
	} 	
}
	
add_filter('get_previous_post_join', 'get_event_post_join', 10, 2);
add_filter('get_next_post_join', 'get_event_post_join', 10, 2);	
if(!function_exists('get_event_post_join')){
	function get_event_post_join($join, $in_same_cat){ 
		global $post, $wpdb; 
		if ( $post->post_type == 'event' ){
			$current_taxonomy = 'event_category'; 
			if(wp_get_object_terms($post->ID, $current_taxonomy)){ 
				$join .= " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id"; 
			} 
		}
		return $join; 
	}
}

?>