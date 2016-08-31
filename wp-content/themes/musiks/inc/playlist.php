<?php
/**
 * Playlist
 *
 *
 */

function playlist_post_type($post_types){
	$post_types['playlist'] = array(
		'labels' => piklist('post_type_labels', 'Playlist')
		,'title' => __('Enter a new Playlist Title', 'musik')
		,'public' => true
		,'rewrite' => array(
		  'slug' => 'playlist'
		)
		,'supports' => array(
			'title'
			,'editor'
			,'author'
			,'thumbnail'
		  	,'comments'
		)
		,'capability_type' => 'post'
		,'hide_meta_box' => array(
		)
		,'has_archive' => true
		,'edit_columns' => array(
	        'title' => __('Title', 'musik')
	        ,'author' => __('Created', 'musik')
	    )
	    ,'menu_icon' => 'dashicons-menu'
	);
	return $post_types;
}
add_filter('piklist_post_types', 'playlist_post_type');

add_action( 'wp_ajax_nopriv_playlist', 'musik_playlist' );
add_action( 'wp_ajax_playlist', 'musik_playlist' );

function musik_playlist(){
	
	$obj = array();

	if( isset($_REQUEST['id']) ){
		$post_id = intval($_REQUEST['id']);
	}

	if(! is_user_logged_in() ){
		$obj['status'] = 1;
		$obj['redirect'] = esc_url( get_permalink( get_theme_mod( 'login-page') ) );
		echo json_encode($obj);
		die();
	}

	// add new
	if( isset($_REQUEST['type']) && $_REQUEST['type']==1 ){
		$post_title  = $_REQUEST['title'];
		$post_author = get_current_user_id();
		$post = array(
			'post_title'    => wp_strip_all_tags( $post_title ),
			'post_status'   => 'publish',
			'post_author'   => $post_author,
			'post_type'	  => 'playlist'
		);

		$playlist_id = wp_insert_post( $post );

		$thumbnail = get_post_thumbnail_id( $post_id );
		set_post_thumbnail($playlist_id, $thumbnail);
		update_post_meta($playlist_id, 'tracks', $post_id);

		$obj['status'] = 1;
		$obj['type'] = 1;
		$obj['playlist'] = array();

		$obj['playlist']['id'] = $playlist_id;
		$obj['playlist']['title'] = wp_strip_all_tags( $post_title );
		$obj['playlist']['url'] = get_permalink( $playlist_id );
		$obj['playlist']['thumb'] = wp_get_attachment_thumb_url( $thumbnail );
		$obj['playlist']['tracks'] = array( (string)$post_id );

		echo json_encode($obj);
		die();
	}

	// remove playlist
	if( isset($_REQUEST['type']) && $_REQUEST['type']==2 ){
		$playlist_id  = $_REQUEST['pid'];
		$author = get_post_field( 'post_author', $playlist_id );

		if(get_current_user_id() == $author){
			wp_delete_post($playlist_id, true);
		}
		$obj['status'] = 1;
		echo json_encode($obj);
		die();
	}

	// update playlist tracks
	if( isset($_REQUEST['type']) && $_REQUEST['type']==3 ){
		$playlist_id  = $_REQUEST['pid'];
		$tracks = isset($_REQUEST['tracks']) ? implode(',', $_REQUEST['tracks']) : '';
		$author = get_post_field( 'post_author', $playlist_id );

		if(get_current_user_id() == $author){
			update_post_meta($playlist_id, 'tracks', $tracks);
		}
		$obj['status'] = 1;
		echo json_encode($obj);
		die();
	}

	// get playlist
	$obj['status'] = 1;
	$obj['type'] = 0;
	$obj['playlist'] = get_playlist_list();
	echo json_encode($obj);
	die();
}

function get_playlist_list(){
	$args = array(
      'post_type' => 'playlist',
      'author'    => get_current_user_id()
    );
	$obj = array();
	$query = query_posts( $args );

	foreach ( $query as $post ) {
		$tracks = trim( get_post_meta($post->ID, 'tracks', true) );
		if($tracks){
			$tracks = explode(',', $tracks);
		}else{
			$tracks = array();
		}
		$obj[] = array(
	    	'id'     => $post->ID,
	    	'title'  => $post->post_title,
	    	'thumb'  => wp_get_attachment_thumb_url( get_post_thumbnail_id( $post->ID ) ),
	    	'tracks' => $tracks,
	    	'url'    => get_permalink($post->ID)
	    );
	}
	
	// Reset Query
	wp_reset_query();
	return $obj;
}

function get_playlist_display($user_id){
	global $bp;
	$arg = array(
      'post_type'       => 'playlist',
      'posts_per_page'  =>  -1,
      'author' 			=>  $user_id
    );

    $arg['paged'] = 1;
	if ( get_query_var( 'paged' ) )
		$arg['paged'] = get_query_var('paged');
	else if ( get_query_var( 'page' ) )
		$arg['paged'] = get_query_var( 'page' );
	else if ( isset( $_GET['link'] ) )
		$arg['paged'] = $_GET['link'];
	else if ( preg_match('/\/page\/[0-9]*\//', $_SERVER['REQUEST_URI'], $matches) ){
		$arg['paged'] = str_replace(array('page','/'), '', $matches[0]);
	}

	$my_query = new WP_Query( $arg );
	if($my_query->have_posts()){
		?>
		<div class="list-group list-group-lg">
		<?php
		while($my_query->have_posts()){
	        $my_query->the_post();
	        ?>
	        <div class="list-group-item">
	        <?php get_template_part( 'template-parts/content-playlist' ); ?>
	        </div>
	        <?php
	    }
	    ?>
		</div>
	    <?php
		wp_reset_postdata();

        if( get_option('permalink_structure') ) {
          $format = '?paged=%#%';
        } else {
          $format = 'page/%#%/';
        } 
        $big = 999999999; // need an unlikely integer
        $base = $format =='?paged=%#%' ? $base = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ) : $base = @add_query_arg('paged','%#%');
        echo '<div class="nav-links m-t-md m-b-md clearfix">'.paginate_links( array(
          'base' => $base,
          'format' => $format,
          'current' => max( 1, $arg['paged'] ),
          'total' => $my_query->max_num_pages,
          'prev_text' => '<i class="fa fa-chevron-left"></i>',
          'next_text' => '<i class="fa fa-chevron-right"></i>'
        ) ).'</div>';
	}
}

function get_like_display($user_id){
	$favorite_post_ids = get_user_favorites($user_id);
	if( isset($favorite_post_ids[0]['posts']) ){ return;}
	$post_ids = implode(',', $favorite_post_ids);
	the_widget( 
    	'music_post_widget',
    	array(
    		'count'   => -1,
    		'include' => $post_ids,
    		'display' => 'list'
    	),
    	array(
    	)
    );
} ?>
