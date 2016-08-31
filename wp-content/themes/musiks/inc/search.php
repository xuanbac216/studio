<?php

add_action( 'wp_ajax_load_search_results', 'load_search_results' );
add_action( 'wp_ajax_nopriv_load_search_results', 'load_search_results' );
add_action( 'wp_enqueue_scripts', 'search_scripts' );

function search_scripts(){
	wp_enqueue_script('search', get_template_directory_uri() . '/assets/js/search.js', array('jquery'), '', true );
}

function load_search_results() {
    $query = $_POST['query'];
    
    $args = array(
        'post_type' => 'download',
        'post_status' => 'publish',
        's' => $query
    );
    $post = new WP_Query( $args );

    $args = array(
    	'name__like' => $query,
    	'hide_empty' => false
    );
    $terms = get_terms('download_artist', $args);
    
    ob_start();
    
    if ( $post->have_posts() ) {
		while ( $post->have_posts() ) : $post->the_post();
			get_template_part( 'template-parts/content', 'search-post' );
		endwhile;
	}

	foreach ($terms as $term) {
		include(locate_template('template-parts/content-search-term.php'));
    }
	
	$content = ob_get_clean();

	if(empty($content)){
		get_template_part( 'template-parts/content', 'search-none' );
	}
	
	echo $content;
	die();	
}
