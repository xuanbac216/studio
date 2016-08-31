<?php
	/*	
	*	Goodlayers Woocommerce Support File
	*/
	
	add_theme_support( 'woocommerce' );
	
	// Change number or products per row to 3
	add_filter('loop_shop_columns', 'gdlr_woo_loop_columns');
	if (!function_exists('gdlr_woo_loop_columns')) {
		function gdlr_woo_loop_columns() {
			global $theme_option;
			return empty($theme_option['all-products-per-row'])? 3: $theme_option['all-products-per-row'];
		}
	}
	add_filter('post_class', 'gdlr_woo_column_class');
	if (!function_exists('gdlr_woo_column_class')) {
		function gdlr_woo_column_class($classes) {
			global $theme_option;
			$item_per_row = empty($theme_option['all-products-per-row'])? 3: $theme_option['all-products-per-row'];
			
			if( is_archive() && get_post_type() == 'product'){
				switch($item_per_row){
					case 1: $classes[] = 'gdlr-1-product-per-row'; break;
					case 2: $classes[] = 'gdlr-2-product-per-row'; break;
					case 3: $classes[] = 'gdlr-3-product-per-row'; break;
					case 4: $classes[] = 'gdlr-4-product-per-row'; break;
					case 5: $classes[] = 'gdlr-5-product-per-row'; break;
				}
			}
			return $classes;
		}
	}	
	
	// add action to enqueue woocommerce style
	add_filter('gdlr_enqueue_scripts', 'gdlr_regiser_woo_style');
	if( !function_exists('gdlr_regiser_woo_style') ){
		function gdlr_regiser_woo_style($array){	
			global $woocommerce;
			if( !empty($woocommerce) ){
				$array['style']['gdlr-woo-style'] = GDLR_PATH . '/stylesheet/gdlr-woocommerce.css';
			}
			return $array;
		}
	}
	
?>