<?php
	/*	
	*	Goodlayers Layerslider Support File
	*/
	
	if(!function_exists('gdlr_get_revolution_slider_list')){
		function gdlr_get_revolution_slider_list(){
			if( !function_exists('lsSliders') ) return;
		
			$ret = array();
			$sliders = lsSliders();
			foreach($sliders as $slider){
				$ret[$slider['id']] = $slider['name'];
			}
			return $ret;
		}
	}
	
	add_action('gdlr_print_item_selector', 'gdlr_check_revolution_slider_item', 10, 2);
	if( !function_exists('gdlr_check_revolution_slider_item') ){
		function gdlr_check_revolution_slider_item( $type, $settings = array() ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';	
		
			if($type == 'revolution-slider'){
				echo '<div class="gdlr-revolution-slider-item gdlr-slider-item gdlr-item" ' . $item_id . $margin_style . ' >';
				if( function_exists('putRevSlider') ){
					echo putRevSlider($settings['id']);
				}else{
					echo 'Please install and activate the \'Revolution Slider\' plugin.';
				}
				echo '</div>';
			}
		}
	}	
	
?>