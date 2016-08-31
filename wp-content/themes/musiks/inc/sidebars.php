<?php

if ( ! function_exists( 'theme_sidebars' ) ) {
    function theme_sidebars() {

        register_sidebar( array(
            'name' => esc_html__( 'Home Header', 'musik' ),
            'id' => 'home-header',
            'description' => esc_html__( 'The home header widgets area', 'musik' ),
            'before_widget' => '<div class="%2$s widget">',
            'after_widget' => "</div>",
            'before_title' => '<h2 class="font-thin m-b m-t-none">',
            'after_title' => '</h2>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Home Col 1/3', 'musik' ),
            'id' => 'home-col-1',
            'description' => esc_html__( 'The home widgets area', 'musik' ),
            'before_widget' => '<div class="%2$s widget">',
            'after_widget' => "</div>",
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Home Col 2/3', 'musik' ),
            'id' => 'home-col-2',
            'description' => esc_html__( 'The home widgets area', 'musik' ),
            'before_widget' => '<div class="%2$s widget">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Home Col 3/3', 'musik' ),
            'id' => 'home-col-3',
            'description' => esc_html__( 'The home widgets area', 'musik' ),
            'before_widget' => '<div class="%2$s widget">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Home Body', 'musik' ),
            'id' => 'home-body',
            'description' => esc_html__( 'The home body widgets area', 'musik' ),
            'before_widget' => '<div class="%2$s widget">',
            'after_widget' => "</div>",
            'before_title' => '<h4 class="font-thin m-b">',
            'after_title' => '</h4>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Home Col 1/2', 'musik' ),
            'id' => 'home-col-4',
            'description' => esc_html__( 'The home widgets area', 'musik' ),
            'before_widget' => '<div class="%2$s widget">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Home Col 2/2', 'musik' ),
            'id' => 'home-col-5',
            'description' => esc_html__( 'The home widgets area', 'musik' ),
            'before_widget' => '<div class="%2$s widget">',
            'after_widget' => "</div>",
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Home Footer', 'musik' ),
            'id' => 'home-footer',
            'description' => esc_html__( 'The home footer widgets area', 'musik' ),
            'before_widget' => '<div class="%2$s widget">',
            'after_widget' => "</div>",
            'before_title' => '<h4 class="font-thin m-b">',
            'after_title' => '</h4>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Home Sidebar', 'musik' ),
            'id' => 'home-sidebar',
            'description' => esc_html__( 'The home sidebar area', 'musik' ),
            'before_widget' => '<div class="%2$s widget">',
            'after_widget' => "</div>",
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Album Sidebar', 'musik' ),
            'id' => 'album-sidebar',
            'description' => esc_html__( 'The album sidebar area', 'musik' ),
            'before_widget' => '<div class="%2$s widget">',
            'after_widget' => "</div>",
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Artist Sidebar', 'musik' ),
            'id' => 'artist-sidebar',
            'description' => esc_html__( 'The artist sidebar area', 'musik' ),
            'before_widget' => '<div class="%2$s widget">',
            'after_widget' => "</div>",
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Music Sidebar', 'musik' ),
            'id' => 'music-sidebar',
            'description' => esc_html__( 'The music sidebar area', 'musik' ),
            'before_widget' => '<div class="%2$s widget">',
            'after_widget' => "</div>",
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Sidebar', 'musik' ),
            'id' => 'sidebar',
            'description' => esc_html__( 'The sidebar area', 'musik' ),
            'before_widget' => '<div class="%2$s widget">',
            'after_widget' => "</div>",
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ) );

        register_sidebar( array(
            'name' => esc_html__( 'Topbar', 'musik' ),
            'id' => 'topbar',
            'description' => esc_html__( 'The topbar area', 'musik' ),
            'before_widget' => '<div class="%2$s widget topbar m-n navbar-right">',
            'after_widget' => "</div>",
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ) );

    }
}
add_action( 'widgets_init', 'theme_sidebars' );
