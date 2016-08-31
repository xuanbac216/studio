<?php
/*********************************************************************************************************** 
*
* TGMPA
* 
***********************************************************************************************************/
require_once get_template_directory() . '/framework/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'soundtheme_register_required_plugins' );
function soundtheme_register_required_plugins() {

 	$plugins = array(
 		
 		array(
 			'name'               => 'Advanced Custom Fields Pro', // The plugin name.
 			'slug'               => 'advanced-custom-fields-pro.zip', // The plugin slug (typically the folder name).
 			'source'             => get_stylesheet_directory() . '/framework/plugins/advanced-custom-fields-pro.zip', // The plugin source.
 			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
 			'version'            => '5.3.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
 			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
 			'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
 			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
 			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
 		),

 		array(
 			'name'               => 'Advanced Ajax Page Loader', // The plugin name.
 			'slug'               => 'advanced-ajax-page-loader', // The plugin slug (typically the folder name).
 			'source'             => get_stylesheet_directory() . '/framework/plugins/advanced-ajax-page-loader.zip', // The plugin source.
 			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
 			'version'            => '2.7.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
 			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
 			'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
 			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
 			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
 		),

		array(
 			'name'               => 'Contact Form 7', // The plugin name.
 			'slug'               => 'contact-form-7', // The plugin slug (typically the folder name).
 			'source'             => get_stylesheet_directory() . '/framework/plugins/contact-form-7.zip', // The plugin source.
 			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
 			'version'            => '4.3', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
 			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
 			'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
 			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
 			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
 		),

		array(
 			'name'               => 'Easy Bootstrap Shortcode', // The plugin name.
 			'slug'               => 'easy-bootstrap-shortcodes', // The plugin slug (typically the folder name).
 			'source'             => get_stylesheet_directory() . '/framework/plugins/easy-bootstrap-shortcodes.zip', // The plugin source.
 			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
 			'version'            => '4.5.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
 			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
 			'force_deactivation' => true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
 			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
 			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
 		),
 	);
 
 	$config = array(
 		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
 		'parent_slug'  => 'themes.php',            // Parent menu slug.
 		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
 		'has_notices'  => true,                    // Show admin notices or not.
 		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
 		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
 		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
 		'message'      => '',                      // Message to output right before the plugins table.
 		'strings'      => array(
 			'page_title'                      => __( 'Install Required Plugins', 'theme-slug' ),
 			'menu_title'                      => __( 'Install Plugins', 'theme-slug' ),
 			// <snip>...</snip>
 			'nag_type'                        => 'updated', // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
 		)
 	);
 	tgmpa( $plugins, $config );
 }

/*********************************************************************************************************** 
*
* STYLE & JS OPTIONS
* 
***********************************************************************************************************/
function soundtheme_head() { 
    /* MAIN JS */
    wp_enqueue_script ( 'soundtheme-settings', get_template_directory_uri() . '/js/soundtheme-js.js', '', null,false  );
    wp_enqueue_script ( 'soundtheme-ui', get_template_directory_uri() . '/js/soundtheme-ui.js', '', null,true  );
    wp_enqueue_script ( 'soundtheme-bootstrap', get_template_directory_uri() . '/js/bootstrap.js', '', null,true  );

    /* SLIDER & MODAL POPUP */
    wp_enqueue_script ( 'soundtheme-slider', get_template_directory_uri() . '/js/utilcarousel-files/utilcarousel/jquery.utilcarousel.min.js', '', null,true  );
    wp_enqueue_script ( 'soundtheme-modalpopup', get_template_directory_uri() . '/js/utilcarousel-files/magnific-popup/jquery.magnific-popup.js', '', null,true  );

    /* MAP */
    wp_enqueue_script ( 'soundtheme-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', '', null,true  );

    /* FIXED JS */
    wp_enqueue_script ( 'soundtheme-fixedup', get_template_directory_uri() . '/js/soundtheme-fixed.js', '', null,true  );
    wp_enqueue_script ( 'soundtheme-fixeddown', get_template_directory_uri() . '/js/soundtheme-fixed-down.js', '',  null,true  );

    /* FILTER JS */
    wp_enqueue_script ( 'soundtheme-filter', get_template_directory_uri() . '/js/jquery.mixitup.js', '', null,true  );
    
	/* RELOAD JS */
    wp_enqueue_script ( 'soundtheme-up', get_template_directory_uri() . '/js/soundtheme-load-up.js', '', null,true  );
    wp_enqueue_script ( 'soundtheme-down', get_template_directory_uri() . '/js/soundtheme-load-down.js', '', null,true  );

    /* STYLE CSS */
    wp_enqueue_style ( 'soundtheme-bootstrap-css', get_template_directory_uri() . '/css/bootstrap.css' );
    wp_enqueue_style ( 'soundtheme-theme-css', get_template_directory_uri() . '/css/soundtheme-main.css' );
    wp_enqueue_style ( 'soundtheme-color-css', get_template_directory_uri() . '/css/soundtheme-style.css' );
    wp_enqueue_style ( 'soundtheme-carousel-css', get_template_directory_uri() . '/js/utilcarousel-files/utilcarousel/util.carousel.css' );
    wp_enqueue_style ( 'soundtheme-skins-css', get_template_directory_uri() . '/js/utilcarousel-files/utilcarousel/util.carousel.skins.css' );
    wp_enqueue_style ( 'soundtheme-popup-css', get_template_directory_uri() . '/js/utilcarousel-files/magnific-popup/magnific-popup.css' );
}
add_action( 'wp_enqueue_scripts', 'soundtheme_head' );

/*********************************************************************************************************** 
*
* GENERAL SETTINGS
* 
***********************************************************************************************************/

// WP
if ( ! isset( $content_width ) ) $content_width = 900;
if ( is_singular() ) wp_enqueue_script( 'comment-reply' );


// THEME INSTALL
if ( ! function_exists( 'soundtheme_setup' ) ) :
function soundtheme_setup() {
	
	// LANG
	load_theme_textdomain( 'sound-theme', get_template_directory() . '/languages' );

	// STYLE
	add_editor_style();

	// RSS COMMENTS
	add_theme_support( 'automatic-feed-links' );

	// THUMBNAIL
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'soundtheme-thumb-small', 250, 250, array( 'center', 'center', true ) );
	add_image_size( 'soundtheme-thumb-medium', 450, 450, array( 'center', 'center', true ) );
	add_image_size( 'soundtheme-thumb-formal', 700, 450, array( 'center', 'center', true ) );
	add_image_size( 'soundtheme-thumb-normal', 700, 700, array( 'center', 'center', true ) );
	add_image_size( 'soundtheme-thumb-big', 1500, 9999, array( 'center', 'center' ) );

	// TOP MENU OPTIONS
	register_nav_menus( array(
		'primary'   => __( 'Top Primary Menu', 'sound-theme' ),
	) );

	// HTML 5
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// POST FORMATS
	add_theme_support( 'post-formats', array(
		'aside', 'video', 'audio', 'gallery', 'chat'
	) );

	// FEATURED CONTENT
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'soundtheme_get_featured_posts',
		'max_posts' => 6,
	) );

	// GALLERY STYLE
	add_filter( 'use_default_gallery_style', '__return_false' );

	// TITLE TAGS
	add_theme_support( 'title-tag' );
}
endif; // soundtheme_setup
add_action( 'after_setup_theme', 'soundtheme_setup' );

// POST FORMAT OPTIONS
function soundtheme_rename_post_formats( $safe_text ) {
    if ( $safe_text == 'Aside' )
        return 'Biography';
    if ( $safe_text == 'Video' )
        return 'Video';
    if ( $safe_text == 'Audio' )
        return 'Music';
    if ( $safe_text == 'Gallery' )
        return 'Gallery';
    if ( $safe_text == 'Chat' )
        return 'Event';
    return $safe_text;
}
add_filter( 'esc_html', 'soundtheme_rename_post_formats' );

// TAG CLOUD OPTIONS
function soundtheme_set_cloud_tag_size($args) {
	$args = array('smallest'    => 10, 'largest'    => 10);
	return $args;
}
add_filter('widget_tag_cloud_args','soundtheme_set_cloud_tag_size');

// THEME ADMIN PAGE SETTINGS
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page('Sound Theme');
	include_once('inc/soundtheme-admin.php' );
}

/*********************************************************************************************************** 
*
* SIDEBAR & WIDGET
* 
***********************************************************************************************************/
function soundtheme_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sound Blog Widget', 'sound-theme' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the blog', 'sound-theme' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="soundtheme-widgettitle"><h1 class="widget-title">',
		'after_title'   => '</h1></div>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sound Main Sidebar', 'sound-theme' ),
		'id'            => 'sidebar-10',
		'description'   => __( 'Main sidebar that appears on the popup fixed right area.', 'sound-theme' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="soundtheme-widgettitle"><h1 class="widget-title">',
		'after_title'   => '</h1></div>',
	) );
}
add_action( 'widgets_init', 'soundtheme_widgets_init' );

/*********************************************************************************************************** 
*
* COMMENTS
* 
***********************************************************************************************************/
function soundtheme_change_avatar_css($class) {
	$class = str_replace("class='avatar", "class='media-object comment-img img-circle ", $class) ;
	return $class;
}
add_filter('get_avatar','soundtheme_change_avatar_css');

function soundtheme_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);
	if ( 'div' == $args['style'] ) {
	    $tag = 'div';
	    $add_below = 'comment';
	} else {
	    $tag = 'li';
	    $add_below = 'div-comment';
	}
	?>
	<li>
	    <div class="media-avatar-body">
		    <a class="pull-left" href="#">
		        <?php echo get_avatar($comment,$size='60'); ?>
		    </a>
	    </div>
	    <div class="media-body">
	        <h6><?php echo (get_comment_author_link()) ?></h6>  
	        <small>
	            <a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>" class="comment-icon-link">
	                <i class="fa fa-clock-o comment-button"></i> 
	                <?php printf( ('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
	            </a>
	            <a class="comment-icon-link">
	                <i class="fa fa-reply comment-button-two" style="margin-left:5px;"></i>
	                <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	            </a>
	            <a  class="comment-icon-link">
	                <i class="fa fa-floppy-o comment-button-two"></i>
	                <?php edit_comment_link( ('Edit'),'  ','' ); ?>
	            </a>
	        </small>
	        <div class="clearfix"></div>
	        <?php if ($comment->comment_approved == '0') : ?>
	            <em class="comment-awaiting-moderation"><?php ('Your comment is awaiting moderation.') ?></em>
	            <br />
	        <?php endif; ?>
	        <p><?php comment_text() ?></p>
	    </div>
	    <div class="clearfix"></div>
	</li>
<?php
}

/**********************************************************************
*
* Set up soundtheme Theme Page Navi
*
* @soundtheme - Pagenavi
*
***********************************************************************/ 
class soundtheme_prime_strategy_page_navi {
public function soundtheme_page_navi( $args = '' ) {
	global $wp_query;

	if ( ! ( is_archive() || is_home() || is_search() ) ) { return; }
	$default = array(
		'items'				=> 11,
		'edge_type'			=> 'none',
		'show_adjacent'		=> true,
		'prev_label'		=> '&lt;',
		'next_label'		=> '&gt;',
		'show_boundary'		=> true,
		'first_label'		=> '&laquo;',
		'last_label'		=> '&raquo;',
		'show_num'			=> false,
		'num_position'		=> 'before',
		'num_format'		=> '<span>%d/%d</span>',
		'echo'				=> true,
		'navi_element'		=> '',
		'elm_class'			=> 'page_navi',
		'elm_id'			=> '',
		'li_class'			=> '',
		'current_class'		=> 'current',
		'current_format'	=> '<span>%d</span>',
		'class_prefix'		=> '',
		'indent'			=> 0
	);
	$default = apply_filters( 'page_navi_default', $default );

	$args = wp_parse_args( $args, $default );

	$max_page_num = $wp_query->max_num_pages;
	$current_page_num = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	$elm = in_array( $args['navi_element'], array( 'nav', 'div', '' ) ) ? $args['navi_element'] : 'div';
 
	$args['items'] = absint( $args['items'] ) ? absint( $args['items'] ) : $default['items'];
	$args['elm_id'] = is_array( $args['elm_id'] ) ? $default['elm_id'] : $args['elm_id'];
	$args['elm_id'] = preg_replace( '/[^\w_-]+/', '', $args['elm_id'] );
	$args['elm_id'] = preg_replace( '/^[\d_-]+/', '', $args['elm_id'] );
 
	$args['class_prefix'] = is_array( $args['class_prefix'] ) ? $default['class_prefix'] : $args['class_prefix'];
	$args['class_prefix'] = preg_replace( '/[^\w_-]+/', '', $args['class_prefix'] );
	$args['class_prefix'] = preg_replace( '/^[\d_-]+/', '', $args['class_prefix'] );
 
	$args['elm_class'] = $this->sanitize_attr_classes( $args['elm_class'], $args['class_prefix'] );
	$args['li_class'] = $this->sanitize_attr_classes( $args['li_class'], $args['class_prefix'] );
	$args['current_class'] = $this->sanitize_attr_classes( $args['current_class'], $args['class_prefix'] );
	$args['current_class'] = $args['current_class'] ? $args['current_class'] : $default['current_class'];
	$args['show_adjacent'] = $this->uniform_boolean( $args['show_adjacent'], $default['show_adjacent'] );
	$args['show_boundary'] = $this->uniform_boolean( $args['show_boundary'], $default['show_boundary'] );
	$args['show_num'] = $this->uniform_boolean( $args['show_num'], $default['show_num'] );
	$args['echo'] = $this->uniform_boolean( $args['echo'], $default['echo'] );

	$tabs = str_repeat( "\t", (int)$args['indent'] );
	$elm_tabs = '';

	$befores = $current_page_num - floor( ( $args['items'] - 1 ) / 2 );
	$afters = $current_page_num + ceil( ( $args['items'] - 1 ) / 2 );

	if ( $max_page_num <= $args['items'] ) {
		$start = 1;
		$end = $max_page_num;
	} elseif ( $befores <= 1 ) {
		$start = 1;
		$end = $args['items'];
	} elseif ( $afters >= $max_page_num ) {
		$start = $max_page_num - $args['items'] + 1;
		$end = $max_page_num;
	} else {
		$start = $befores;
		$end = $afters;
	}

	$elm_attrs = '';
	if ( $args['elm_id'] ) {
		$elm_attrs = ' id="' . $args['elm_id'] . '"';
	}
	if ( $args['elm_class'] ) {
		$elm_attrs .= ' class="' . $args['elm_class'] . '"';
	}

	$num_list_item = '';
	if ( $args['show_num'] ) {
		$num_list_item = '<li class="page_nums';
		if ( $args['li_class'] ) {
			$num_list_item .= ' ' . $args['li_class'];
		}
		$num_list_item .= '">' . sprintf( $args['num_format'], $current_page_num, $max_page_num ) . "</li>\n";
	}

	$page_navi = '';
	if ( $elm ) {
		$elm_tabs = "\t";
		$page_navi = $tabs . '<' . $elm;
		if ( $elm_attrs ) {
			$page_navi .= $elm_attrs . ">\n";
		}
	}

	$page_navi .= $elm_tabs . $tabs . '<ul';
	if ( ! $elm && $elm_attrs ) {
		$page_navi .= $elm_attrs;
	}
	$page_navi .= ">\n";

	if ($args['num_position'] != 'after' && $num_list_item ) {
		$page_navi .= "\t" . $elm_tabs . $tabs . $num_list_item;
	}
	if ( $args['show_boundary'] && ( $current_page_num != 1 || in_array( $args['edge_type'], array( 'span', 'link' ) ) ) ) {
		$page_navi .= "\t" . $elm_tabs . $tabs . '<li class="' . $args['class_prefix'] . 'first';
		if ( $args['li_class'] ) {
			$page_navi .= ' ' . $args['li_class'];
		}
		if ( $args['edge_type'] == 'span' && $current_page_num == 1 ) {
			$page_navi .= '"><span>' . esc_html( $args['first_label'] ) . '</span></li>' . "\n";
		} else {
			$page_navi .= '"><a href="' . get_pagenum_link() . '">' . esc_html( $args['first_label'] ) . '</a></li>' . "\n";
		}
	}

	if ( $args['show_adjacent'] && ( $current_page_num != 1 || in_array( $args['edge_type'], array( 'span', 'link' ) ) ) ) {
		$previous_num = max( 1, $current_page_num - 1 );
		$page_navi .= "\t" . $elm_tabs . $tabs . '<li class="' . $args['class_prefix'] . 'previous';
		if ( $args['li_class'] ) {
			$page_navi .= ' ' . $args['li_class'];
		}
		if ( $args['edge_type'] == 'span' && $current_page_num == 1 ) {
			$page_navi .= '"><span>' . esc_html( $args['prev_label'] ) . '</span></li>' . "\n";
		} else {
			$page_navi .= '"><a href="' . get_pagenum_link( $previous_num ) . '">' . esc_html( $args['prev_label'] ) . '</a></li>' . "\n";
		}
	}

	for ( $i = $start; $i <= $end; $i++ ) {
		$page_navi .= "\t" . $elm_tabs . $tabs . '<li class="';
		if ( $i == $current_page_num ) {
			$page_navi .= $args['current_class'];
			if ( $args['li_class'] ) {
				$page_navi .= ' ' . $args['li_class'];
			}
			$page_navi .= '">' . sprintf( $args['current_format'], $i ) . "</li>\n";
		} else {
			$delta = absint( $i - $current_page_num );
			$b_f = $i < $current_page_num ? 'before' : 'after';
			$page_navi .= $args['class_prefix'] . $b_f . ' ' . $args['class_prefix'] . 'delta-' . $delta;
			if ( $i == $start ) {
				$page_navi .= ' ' . $args['class_prefix'] . 'head';
			} elseif ( $i == $end ) {
				$page_navi .= ' ' . $args['class_prefix'] . 'tail';
			}
			if ( $args['li_class'] ) {
				$page_navi .= ' ' . $args['li_class'] . '"';
			}
			$page_navi .= '"><a href="' . get_pagenum_link( $i ) . '">' . $i . "</a></li>\n";
		}
	}

	if ( $args['show_adjacent'] && ( $current_page_num != $max_page_num || in_array( $args['edge_type'], array( 'span', 'link' ) ) ) ) {
		$next_num = min( $max_page_num, $current_page_num + 1 );
		$page_navi .= "\t" . $elm_tabs . $tabs . '<li class="' . $args['class_prefix'] . 'next';
		if ( $args['li_class'] ) {
			$page_navi .= ' ' . $args['li_class'];
		}
		if ( $args['edge_type'] == 'span' && $current_page_num == $max_page_num ) {
			$page_navi .= '"><span>' . esc_html( $args['next_label'] ) . '</span></li>' . "\n";
		} else {
			$page_navi .= '"><a href="' . get_pagenum_link( $next_num ) . '">' . esc_html( $args['next_label'] ) . '</a></li>' . "\n";

		}
	}

	if ( $args['show_boundary'] && ( $current_page_num != $max_page_num || in_array( $args['edge_type'], array( 'span', 'link' ) ) ) ) {
		$page_navi .= "\t" . $elm_tabs . $tabs . '<li class="' . $args['class_prefix'] . 'last';
		if ( $args['li_class'] ) {
			$page_navi .= ' ' . $args['li_class'];
		}
		if ( $args['edge_type'] == 'span' && $current_page_num == $max_page_num ) {
			$page_navi .= '"><span>' . esc_html( $args['last_label'] ) . '</span></li>' . "\n";
		} else {
			$page_navi .= '"><a href="' . get_pagenum_link( $max_page_num ) . '">' . esc_html( $args['last_label'] ) . '</a></li>' . "\n";
		}
	}

	if ($args['num_position'] == 'after' && $num_list_item ) {
		$page_navi .= "\t" . $elm_tabs . $tabs . $num_list_item;
	}

	$page_navi .= $elm_tabs . $tabs . "</ul>\n";

	if ( $elm ) {
		$page_navi .= $tabs . '</' . $elm . ">\n";
	}

	$page_navi = apply_filters( 'page_navi', $page_navi );

	if ( $args['echo'] ) {
		echo $page_navi;
	} else {
		return $page_navi;
	}
}
private function sanitize_attr_classes( $classes, $prefix = '' ) {
	if ( ! is_array( $classes ) ) {
		$classes = preg_replace( '/[^\s\w_-]+/', '', $classes );
		$classes = preg_split( '/[\s]+/', $classes );
	}

	foreach ( $classes as $key => $class ) {
		if ( is_array( $class ) ) {
			unset( $classes[$key] );
		} else {
			$class = preg_replace( '/[^\w_-]+/', '', $class );
			$class = preg_replace( '/^[\d_-]+/', '', $class );
			if ( $class ) {
				$classes[$key] = $prefix . $class;
			}
		}
	}
	$classes = implode( ' ', $classes );

	return $classes;
}
private function uniform_boolean( $arg, $default = true ) {
	if ( is_numeric( $arg ) ) {
		$arg = (int)$arg;
	}
	if ( is_string( $arg ) ) {
		$arg = strtolower( $arg );
		if ( $arg == 'false' ) {
			$arg = false;
		} elseif ( $arg == 'true' ) {
			$arg = true;
		} else {
			$arg = $default;
		}
	}
	return $arg;
}
}
$soundtheme_prime_strategy_page_navi = new soundtheme_prime_strategy_page_navi();

if ( ! function_exists( 'page_navi' ) ) {
	function page_navi( $args = '' ) {
		global $soundtheme_prime_strategy_page_navi;
		return $soundtheme_prime_strategy_page_navi->soundtheme_page_navi( $args );
	}
}

/*********************************************************************************************************** 
*
* READ MORE
* 
***********************************************************************************************************/
function soundtheme_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'soundtheme_remove_more_link_scroll' );

/*********************************************************************************************************** 
*
* CONTENT LIMIT
* 
***********************************************************************************************************/
function content($num) {
$theContent = get_the_content();
$output = preg_replace('/<img[^>]+./','', $theContent);
$output = preg_replace( '/<blockquote>.*<\/blockquote>/', '', $output );
$output = preg_replace( '|\[(.+?)\](.+?\[/\\1\])?|s', '', $output );
$limit = $num+1;
$content = explode(' ', $output, $limit);
array_pop($content);
$content = implode(" ",$content)."...";
echo $content;
}

/*********************************************************************************************************** 
*
* MUSIC PLAYER
* 
***********************************************************************************************************/
if ( ! class_exists( 'Acf' ) ) : 
else:
	function soundtheme_players() {
		$soundtheme_color_a = esc_attr( get_field('soundtheme_color_a' , 'option'));
		$soundtheme_color_dark = esc_attr( get_field('soundtheme_color_dark' , 'option'));
		$soundtheme_color_darktwo = esc_attr( get_field('soundtheme_color_darktwo' , 'option'));
		$soundtheme_pl_auto = esc_attr( get_field('soundtheme_pl_auto' , 'option'));
		$soundtheme_pl_twitter = esc_attr( get_field('soundtheme_pl_twitter' , 'option'));
		$soundtheme_pl_facebook = esc_attr( get_field('soundtheme_pl_facebook' , 'option'));
		$soundtheme_pl_open = esc_attr( get_field('soundtheme_pl_open' , 'option'));
		$soundtheme_pl_playshow = esc_attr( get_field('soundtheme_pl_playshow' , 'option'));
	?>

	<!-- MUSIC PLAYER OPTIONS -->
	<script src="<?php echo esc_url( get_template_directory_uri() . '/js/soundmanager2-nodebug-jsmin.js' ); ?>"></script>
	<script src="<?php echo esc_url( get_template_directory_uri() . '/js/jquery.fullwidthAudioPlayer.js' ); ?>"></script>
	<script type="text/javascript">
		soundManager.url = '<?php echo esc_url( get_template_directory_uri() . "/swf/" ); ?>';
		soundManager.flashVersion = 9;
		soundManager.useHTML5Audio = true;
		soundManager.debugMode = true;
		$(document).ready(function(){
			$('#fap').fullwidthAudioPlayer({
				<?php if ($soundtheme_pl_auto == 'true') : ?>
					autoPlay: true,
				<?php elseif ($soundtheme_pl_auto == 'false') : ?>
					autoPlay: false,
				<?php endif; ?>
				autoLoad: false, 
				sortable: true,
				popup: false,
				wrapperPosition: 'bottom',
				wrapperColor: '<?php if ($soundtheme_color_dark) : ?><?php echo esc_attr($soundtheme_color_dark, "sound-theme"); ?><?php else: ?>#2A2B30<?php endif; ?>',
				mainColor: '<?php if ($soundtheme_color_a) : ?><?php echo esc_attr($soundtheme_color_a, "sound-theme"); ?><?php else: ?>#45B39D<?php endif; ?>',
				metaColor: '#F0F3F4',
				strokeColor: '<?php if ($soundtheme_color_dark) : ?><?php echo esc_attr($soundtheme_color_dark, "sound-theme"); ?><?php else: ?>#2A2B30<?php endif; ?>',
				activeTrackColor: '<?php if ($soundtheme_color_darktwo) : ?><?php echo esc_attr($soundtheme_color_darktwo, "sound-theme"); ?><?php else: ?>#24252A<?php endif; ?>',
				<?php if ($soundtheme_pl_twitter) : ?>
					twitterText: '<?php echo esc_attr($soundtheme_pl_twitter, "sound-theme"); ?>',
				<?php else: ?>
					twitterText: 'Twitter',
				<?php endif; ?>

				<?php if ($soundtheme_pl_facebook) : ?>
					facebookText: '<?php echo esc_attr($soundtheme_pl_facebook, "sound-theme"); ?>',
				<?php else: ?>
					facebookText: 'Facebook',
				<?php endif; ?>
				height: 75,
				loopPlaylist: true,
				playlistHeight: 250,
				offset: 30,
				<?php if ($soundtheme_pl_open == 'true') : ?>
					opened: true,
				<?php elseif ($soundtheme_pl_open == 'false') : ?>
					opened: false,
				<?php endif; ?>
				<?php if ($soundtheme_pl_playshow == 'true') : ?>
					playlist: true,
				<?php elseif ($soundtheme_pl_playshow == 'false') : ?>
					playlist: false,
				<?php endif; ?>
				keyboard: false,
				socials: true,
				shuffle: false,
				openPlayerOnTrackPlay: true,
				layout: 'fullwidth',
				openLabel: '<i class="fa fa-volume-up"></i>',
				closeLabel: '<i class="fa fa-power-off"></i>'
			});
		});
	</script>
	<?php
	}
	add_action('wp_footer', 'soundtheme_players');
endif;

/*********************************************************************************************************** 
*
* AJAX
* 
***********************************************************************************************************/
if ( ! class_exists( 'AAPL' ) ) :
	function soundtheme_ajax() { ?>
		<script type="text/javascript">
			function AAPL_reload_code() {
			jQuery.getScript("<?php echo esc_url( get_template_directory_uri() . '/js/utilcarousel-files/utilcarousel/jquery.utilcarousel.min.js' ); ?>", function(data, textStatus, jqxhr){ });
			jQuery.getScript("<?php echo esc_url( get_template_directory_uri() . '/js/utilcarousel-files/magnific-popup/jquery.magnific-popup.js' ); ?>", function(data, textStatus, jqxhr){ }); 
			jQuery.getScript("<?php echo esc_url( get_template_directory_uri() . '/js/jquery.mixitup.js' ); ?>", function(data, textStatus, jqxhr){ }); 
			jQuery.getScript("<?php echo esc_url( get_template_directory_uri() . '/js/soundtheme-load-up.js' ); ?>", function(data, textStatus, jqxhr){ }); 
			jQuery.getScript("<?php echo esc_url( get_template_directory_uri() . '/js/soundtheme-load-down.js' ); ?>", function(data, textStatus, jqxhr){ });
			<?php if ( has_post_format( 'Chat' )) : ?> 
				jQuery.getScript("https://maps.googleapis.com/maps/api/js", function(data, textStatus, jqxhr){ });
			<?php endif; ?>
		}
		</script>
		<?php

	}
	add_action('wp_footer', 'soundtheme_ajax');
endif;


