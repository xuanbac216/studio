<?php

if ( ! function_exists( 'musik_share' ) ) {
    function musik_share($title, $permalink) {

        $out = '<div class="btn-group">';

        $out .= '<a href="#" class="btn btn-default" data-toggle="dropdown">'.__('Share', 'musik').' <span class="caret"></span></a><ul class="dropdown-menu">';

        $actions = array(
            'twitter' => array(
                'href' => sprintf( 'http://twitter.com/home?status=%s', urlencode( sprintf( __( 'Check this out: %s', 'musik' ), $permalink ) ) ),
                'title' => sprintf( __( 'Share %s on Twitter', 'musik' ), $title ),
                'text' => __( 'Share on Twitter', 'musik' ),
            ),
            'googleplus' => array(
                'href' => sprintf( 'https://plus.google.com/share?url=%s', urlencode( $permalink ) ),
                'title' => sprintf( __( 'Add %s to Google Plus', 'musik' ), $title ),
                'text' => __( 'Add to Google+', 'musik' ),
            ),
            'facebook' => array(
                'href' => sprintf( 'http://www.facebook.com/sharer.php?u=%s&t=%s', urlencode( $permalink ), urlencode( __( 'Check this out', 'musik' ) ) ),
                'title' => sprintf( __( 'Share %s on Facebook', 'musik' ), $title ),
                'text' => __( 'Share on Facebook', 'musik' ),
            )
        );

        foreach ( $actions as $action ) {
            $out .= '<li><a href="' . $action['href'] . '" title="' . esc_attr( $action['title'] ) . '">' . $action['text'] . '</a></li>';
        }

        $out .= '</ul>';
        $out .= '</div>';

        return $out;
    }
}


function content_limit($content, $limit) {
  $excerpt = explode(' ', $content, $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  } 
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

if ( ! function_exists( 'event_pagesize' ) ) {
    function event_pagesize( $query ) 
    {
        if ( is_category( 'event' ) )
        {
            // If you want "showposts"
            $query->query_vars['showposts'] = 12;
            return;
        }
    }
}
add_action( 'pre_get_posts', 'event_pagesize', 1 );


/*  Add responsive container to embeds
/* ------------------------------------ */ 
if ( ! function_exists( 'musik_embed_html' ) ) {
    function musik_embed_html( $html ) {
        return '<div class="video-container">' . $html . '</div>';
    }
}
add_filter( 'embed_oembed_html', 'musik_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'musik_embed_html' ); // Jetpack

// do shortcode on widget
add_filter('widget_text', 'do_shortcode');

// custom category template

if ( ! function_exists( 'get_custom_category_template' ) ) {
    function get_custom_category_template( $category_template ) {
        $term_id = get_queried_object()->term_id;
        $tempid  = get_term_meta($term_id, 'category_template', true);
        if ($tempid){
            $temp = locate_template($tempid);
            if (!empty($temp))
                return apply_filters("Custom_Category_Template_found", $temp);
        }
        return $category_template;
    }
}
add_filter( 'category_template', 'get_custom_category_template' );

if ( ! function_exists( 'show_play' ) ):
function show_play( $id ) {
    if( get_theme_mod( 'hide-play-btn' ) == 1 ){
        return false;
    }
    if( get_post_meta( $id, 'hide_play', true ) ){ 
        return false;
    }
    return true;
}
endif;

if ( ! function_exists( 'show_purchase' ) ):
function show_purchase( $id ) {
    if( get_theme_mod( 'hide-purchase-btn' ) == 1 ){
        return false;
    }
    if( get_post_meta( $id, '_edd_hide_purchase_link', true ) ){ 
        return false;
    }
    return true;
}
endif;

if ( ! function_exists( 'get_user_link' ) ):
function get_user_link( $id, $size = 20 ) {
    global $wp_query;
    if( !empty( $wp_query->query_vars['vendor'] ) ) {
        return;
    }
    $str = '<div class="item-author"><a href="%s" class="text-sm text-muted text-ellipsis m-t-xs m-b-xs">%s %s</a></div>';
    $link = get_author_posts_url($id);
    $name = get_the_author_meta( 'display_name', $id );
    if( function_exists('buddypress') ){
        $link = bp_core_get_user_domain($id);
    }
    if( function_exists('EDD_FES') ){
        $username = get_the_author_meta( 'user_login', $id );
        $link = site_url().'/vendor/'.$username;
    }
    return sprintf($str, $link, get_avatar( $id, $size ), $name);
}
endif;

add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

        $title = single_cat_title( '', false );

    } elseif ( is_tag() ) {

        $title = single_tag_title( '', false );

    } elseif ( is_archive() ) {

        $title = post_type_archive_title( '', false );

    }elseif ( is_author() ) {

        $title = '<span class="vcard">' . get_the_author() . '</span>' ;

    }

    return $title;

});
