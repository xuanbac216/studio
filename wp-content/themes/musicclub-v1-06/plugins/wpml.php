<?php

	// Translate the wpml shortcode
	// [wpml_translate lang=en]LANG EN[/wpml_translate]
	// [wpml_translate lang=de]LANG DE[/wpml_translate]
	add_shortcode('wpml_translate', 'wpml_translate_shortcode');	
	if( !function_exists('wpml_translate_shortcode') ){
		function wpml_translate_shortcode( $atts, $content = null ) {
			extract(shortcode_atts(array( 'lang' => '' ), $atts));
			
			$lang_active = ICL_LANGUAGE_CODE;
			if($lang == $lang_active){
				return $content;
			}
		}	
	}

?>