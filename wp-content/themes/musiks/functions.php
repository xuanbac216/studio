<?php
/**
 * musik functions and definitions
 *
 * @package musik
 */

if ( ! function_exists( 'musik_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function musik_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on musik, use a find and replace
	 * to change 'musik' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'musik', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary'   => esc_html__( 'Primary Menu', 'musik' ),
		'secondary' => esc_html__( 'Secondary Menu', 'musik' ),
		'user'      => esc_html__( 'User Menu', 'musik' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'musik_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_image_size( 'md', 350, 350, true );
	add_image_size( 'lg', 480, 270, true );
}
endif; // musik_setup
add_action( 'after_setup_theme', 'musik_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function musik_content_width() {
	//$GLOBALS['content_width'] = apply_filters( 'musik_content_width', 640 );
	if ( ! isset( $content_width ) ) $content_width = 640;
}
add_action( 'after_setup_theme', 'musik_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function musik_scripts() {
	wp_enqueue_style( 'musik-style', get_stylesheet_uri() );

	wp_enqueue_script( 'musik-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '', true );

	wp_enqueue_script( 'musik-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_style('animate', get_template_directory_uri().'/assets/css/animate.css');
	wp_enqueue_style('font-awesome', get_template_directory_uri().'/assets/css/font-awesome.min.css');
	wp_enqueue_style('simple-line-icons', get_template_directory_uri().'/assets/css/simple-line-icons.css');
	wp_enqueue_style('bootstrap', get_template_directory_uri().'/assets/css/bootstrap.css');
	wp_enqueue_style('app', get_template_directory_uri().'/assets/css/app.css');
	wp_enqueue_style('font', get_template_directory_uri().'/assets/css/font.css');

	
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery'), '', true );
	wp_enqueue_script('app', get_template_directory_uri() . '/assets/js/app.js', array('jquery'), '', true );
	wp_enqueue_style('jplayer', get_template_directory_uri().'/assets/js/jPlayer/jplayer.flat.css');
	wp_enqueue_script('jplayer', get_template_directory_uri() . '/assets/js/jPlayer/jquery.jplayer.min.js', array('jquery'), '', true );
	wp_enqueue_script('playlist', get_template_directory_uri() . '/assets/js/jPlayer/add-on/jplayer.playlist.min.js', array('jquery'), '', true );
	wp_enqueue_script('storage', get_template_directory_uri() . '/assets/js/jquery.storageapi.min.js', array('jquery'), '', true );
	wp_enqueue_script('player',   get_template_directory_uri() . '/assets/js/player.js', array('jquery'), '', true );
	wp_enqueue_script('playlists',   get_template_directory_uri() . '/assets/js/playlist.js', array('jquery'), '', true );
	wp_localize_script('player', 'ajax_object', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )), '', true);

	wp_enqueue_style( 'wp-mediaelement' );
    wp_enqueue_script( 'wp-mediaelement', false, array('jquery'), false, true );
    
	wp_enqueue_script('tile',   get_template_directory_uri() . '/assets/js/masonry/tiles.min.js', array('jquery'), '', true );
	wp_enqueue_script('tile-init',   get_template_directory_uri() . '/assets/js/tile.js', array('jquery'), '', true );

	if( get_theme_mod( 'hide-loading' ) == 0 ){
		wp_enqueue_script('nprogress',   get_template_directory_uri() . '/assets/js/nprogress/nprogress.js', array('jquery'), '', true );
		wp_enqueue_style('nprogress', get_template_directory_uri().'/assets/js/nprogress/nprogress.css');
		wp_enqueue_script('pjax',   get_template_directory_uri() . '/assets/js/jquery.pjax.js', array('jquery'), '', true );
		wp_enqueue_script('pjaxinit',   get_template_directory_uri() . '/assets/js/ajax.js', array('jquery'), '', true );
	}
}
add_action( 'wp_enqueue_scripts', 'musik_scripts' );

/**
 * Implement the Custom feature.
 */
require get_template_directory() . '/inc/customizer-theme.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Get requried plugins notifications.
 */
require get_template_directory() . '/inc/plugin.php';

/**
 * Custom menu.
 */
require get_template_directory() . '/inc/nav.php';

/**
 * Easy Digital Download
 */
require get_template_directory() . '/inc/edd.php';

/**
 * Playlist
 */
require get_template_directory() . '/inc/playlist.php';

/**
 * Buddypress
 */
require get_template_directory() . '/inc/buddypress.php';


/**
 * Sidebars
 */
require get_template_directory() . '/inc/sidebars.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets/widget-music-post.php';
require get_template_directory() . '/inc/widgets/widget-music-term.php';
/**
 * Share
 */
require get_template_directory() . '/inc/helper.php';

require get_template_directory() . '/inc/search.php';
