<?php
	if( in_array(get_post_format(), array('aside', 'link', 'quote')) ){
		get_template_part('single/content', get_post_format());
	}else{
		
		global $gdlr_post_settings;
		if( !empty($gdlr_post_settings['blog-medium']) ){
			get_template_part('single/content-medium');
		}else if( !empty($gdlr_post_settings['blog-info-widget']) ){
			get_template_part('single/content-widget');
		}else{
			get_template_part('single/content-full');
		}
		
	} 
?>