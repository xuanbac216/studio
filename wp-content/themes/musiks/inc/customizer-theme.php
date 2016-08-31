<?php

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */

function theme_customize_register( $wp_customize ){

  $wp_customize->get_section('title_tagline')->title = esc_html__( 'Site Title, Tagline & Logo', 'musik' );

  // Logo
  $wp_customize->add_setting(
      'logo',
      array(
          'default' => '0',
          'sanitize_callback' => 'esc_attr'
      )
  );
  $wp_customize->add_control(
    'logo',
    array(
      'type' => 'select',
      'label' => esc_html__( 'Logo Option', 'musik' ),
      'choices' => array(
        '0' => 'Icon + Title',
        '1' => 'Image + Title',
        '2' => 'Image'
      ),
      'section' => 'title_tagline',
    )
  );

  $wp_customize->add_setting(
    'logo-icon',
    array(
        'default' => 'icon-earphones',
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'logo-icon',
    array(
      'type' => 'text',
      'label' => esc_html__( 'Logo Icon', 'musik' ),
      'section' => 'title_tagline'
    )
  );

  $wp_customize->add_setting(
    'logo-img',
    array(
        'sanitize_callback' => 'esc_url_raw'
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'logo-img',
      array(
          'label' => esc_html__( 'Logo image', 'musik' ),
          'section' => 'title_tagline'
      )
    )
  );

  $wp_customize->add_setting(
    'logo-img-sm',
    array(
        'sanitize_callback' => 'esc_url_raw'
    )
  );
  $wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'logo-img-sm',
        array(
            'label' => esc_html__( 'Small logo image', 'musik' ),
            'section' => 'title_tagline'
        )
    )
  );


  // Colors
  // add color settings to colors section
  $colors = array(
    'bg-primary' => 'Primary',
    'bg-info'    => 'Info',
    'bg-success' => 'Success',
    'bg-warning' => 'Warning',
    'bg-danger'  => 'Danger',
    'bg-white'   => 'White',
    'bg-dark'    => 'Dark',
    'bg-black'   => 'Black',
  );
  $wp_customize->add_setting(
      'logo-bg-color',
      array(
          'default' => 'bg-info',
          'sanitize_callback' => 'esc_attr'
      )
  );
  $wp_customize->add_control(
    'logo-bg-color',
    array(
      'type' => 'select',
      'label' => esc_html__( 'Logo Background Color', 'musik' ),
      'section' => 'colors',
      'choices' => $colors,
    )
  );

  $wp_customize->add_setting(
      'header-bg-color',
      array(
          'default' => 'bg-white',
          'sanitize_callback' => 'esc_attr'
      )
  );
  $wp_customize->add_control(
    'header-bg-color',
    array(
      'type' => 'select',
      'label' => esc_html__( 'Header Background Color', 'musik' ),
      'section' => 'colors',
      'choices' => $colors,
    )
  );

  $wp_customize->add_setting(
      'aside-bg-color',
      array(
          'default' => 'bg-dark',
          'sanitize_callback' => 'esc_attr'
      )
  );
  $wp_customize->add_control(
    'aside-bg-color',
    array(
      'type' => 'select',
      'label' => esc_html__( 'Aside Background Color', 'musik' ),
      'section' => 'colors',
      'choices' => $colors,
    )
  );

  $wp_customize->add_setting(
      'player-bg-color',
      array(
          'default' => 'bg-info',
          'sanitize_callback' => 'esc_attr'
      )
  );
  $wp_customize->add_control(
    'player-bg-color',
    array(
      'type' => 'select',
      'label' => esc_html__( 'Player Background Color', 'musik' ),
      'section' => 'colors',
      'choices' => $colors,
    )
  );

  $wp_customize->add_setting(
      'btn-bg-color',
      array(
          'default' => 'bg-info',
          'sanitize_callback' => 'esc_attr'
      )
  );
  $wp_customize->add_control(
    'btn-bg-color',
    array(
      'type' => 'select',
      'label' => esc_html__( 'Button Color', 'musik' ),
      'section' => 'colors',
      'choices' => array(
        'btn-primary' => 'Primary',
        'btn-info'    => 'Info',
        'btn-success' => 'Success',
        'btn-warning' => 'Warning',
        'btn-danger'  => 'Danger',
        'btn-default' => 'White',
        'btn-dark'    => 'Dark'
      )
    )
  );

  // add misc section
  $wp_customize->add_section(
    'misc_section',
    array(
      'title' => esc_html__( 'Misc', 'musik' ),
      'capability' => 'edit_theme_options'
    )
  );

  $wp_customize->add_setting(
    'aside-folded',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'aside-folded',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Aside Folded', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'hide-folded-btn',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'hide-folded-btn',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Hide folded btn', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'hide-admin-bar',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'hide-admin-bar',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Hide admin bar', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'hide-register-btn',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'hide-register-btn',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Hide register btn', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'hide-search',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'hide-search',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Hide search on top bar', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'hide-cart-btn',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'hide-cart-btn',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Hide shopping cart', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'hide-purchase-btn',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'hide-purchase-btn',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Hide purchase btn', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'prices-popup',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'prices-popup',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Prices popup', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'hide-play-btn',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'hide-play-btn',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Hide play btn', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'hide-loading',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'hide-loading',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Disable ajax loading', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'hide-player',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'hide-player',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Disable player', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'hide-share',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'hide-share',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Disable share', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'ajax-comment',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'ajax-comment',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Ajaxify comment', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'show-author',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'show-author',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Show author info on list', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'show-author-detail',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'show-author-detail',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Show author info on detail page', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'show-plays',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'show-plays',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Show play count', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'show-playlist',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'show-playlist',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Show playlist', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'show-likes',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'show-likes',
    array(
      'type' => 'checkbox',
      'label' => esc_html__( 'Show likes', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'title-music',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'title-music',
    array(
      'type' => 'text',
      'label' => esc_html__( 'Music title', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'title-related',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'title-related',
    array(
      'type' => 'text',
      'label' => esc_html__( 'Related music title', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'artist-pagesize',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'artist-pagesize',
    array(
      'type' => 'text',
      'label' => esc_html__( 'Artist page size', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'album-pagesize',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'album-pagesize',
    array(
      'type' => 'text',
      'label' => esc_html__( 'Album page size', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'track-pagesize',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'track-pagesize',
    array(
      'type' => 'text',
      'label' => esc_html__( 'Track page size', 'musik' ),
      'section' => 'misc_section'
    )
  );

  $wp_customize->add_setting(
    'login-page',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'login-page',
    array(
      'type' => 'select',
      'label' => esc_html__( 'Login Page', 'musik' ),
      'section' => 'misc_section',
      'choices' => musik_get_pages()
    )
  );

  $wp_customize->add_setting(
    'register-page',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'register-page',
    array(
      'type' => 'select',
      'label' => esc_html__( 'Register Page', 'musik' ),
      'section' => 'misc_section',
      'choices' => musik_get_pages()
    )
  );

  $wp_customize->add_setting(
    'soundcloud-clientid',
    array(
        'sanitize_callback' => 'esc_attr'
    )
  );
  $wp_customize->add_control(
    'soundcloud-clientid',
    array(
      'type' => 'text',
      'label' => esc_html__( 'Soundcloud Clientid', 'musik' ),
      'section' => 'misc_section'
    )
  );

}

function musik_get_pages( ) {
  $pages_options = array( '' => '' ); // Blank option
  $pages = get_pages();
  if ( $pages ) {
    foreach ( $pages as $page ) {
      $pages_options[ $page->ID ] = $page->post_title;
    }
  }
  return $pages_options;
}


add_action( 'customize_register', 'theme_customize_register' );

if( get_theme_mod( 'hide-admin-bar' ) == 1 ){
  add_filter( 'show_admin_bar', '__return_false', 9999 );
}
