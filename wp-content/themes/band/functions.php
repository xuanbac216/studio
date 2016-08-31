<?php

/*
 * AIT WordPress Theme
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */

// === Usefull debugging constants ===================================

// if(!defined('AIT_DISABLE_CACHE')) define('AIT_DISABLE_CACHE', true);
// if(!defined('AIT_ENABLE_NDEBUGGER')) define('AIT_ENABLE_NDEBUGGER', true);


// === Loads AIT WordPress Framework ================================
require_once get_template_directory() . '/ait-theme/@framework/load.php';


// === Mandatory WordPress Standard functionality ===================

$content_width = 1000;


// === Custom filters, actions for framework overrides ==============




// === Run the theme ===============================================

$themeConfiguration = include aitPath('config', '/@theme-configuration.php');

AitTheme::run($themeConfiguration);


// === Custom settings ==============================================

add_filter('loop_shop_columns', function() { return 3; });

// Disable woocommerce default styles
if ( aitIsPluginActive( "woocommerce" ) ) {
	if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
		add_filter( 'woocommerce_enqueue_styles', '__return_false' );
	} else {
		define( 'WOOCOMMERCE_USE_CSS', false );
	}
}
