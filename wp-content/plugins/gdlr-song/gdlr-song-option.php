<?php
	/*	
	*	Goodlayers Song Option file
	*	---------------------------------------------------------------------
	*	This file creates all song options and attached to the theme
	*	---------------------------------------------------------------------
	*/
	
	// add a song option to song page
	if( is_admin() ){ add_action('after_setup_theme', 'gdlr_create_song_options'); }
	if( !function_exists('gdlr_create_song_options') ){
	
		function gdlr_create_song_options(){
			global $gdlr_sidebar_controller;
			
			if( !class_exists('gdlr_page_options') ) return;
			new gdlr_page_options( 
				
				// page option attribute
				array(
					'post_type' => array('song'),
					'meta_title' => __('Goodlayers Song Option', 'gdlr-song'),
					'meta_slug' => 'goodlayers-page-option',
					'option_name' => 'post-option',
					'position' => 'normal',
					'priority' => 'high',
				),
					  
				// page option settings
				array(		
					'page-option' => array(
						'title' => __('Page Option', 'gdlr-song'),
						'options' => array(
							'mp3' => array(
								'title' => __('MP3 File' , 'gdlr-song'),
								'button' => __('Upload', 'gdlr-song'),
								'type' => 'upload',
								'data-type' => 'audio',
								'description' => __('You can see list of the file compatibility for each browser here','gdlr-song') .
									' http://mediaelementjs.com/#devices'
							),
							'ogg' => array(
								'title' => __('OGG File' , 'gdlr-song'),
								'button' => __('Upload', 'gdlr-song'),
								'type' => 'upload',
								'data-type' => 'audio'
							),
							'wav' => array(
								'title' => __('WAV File' , 'gdlr-song'),
								'button' => __('Upload', 'gdlr-song'),
								'type' => 'upload',
								'data-type' => 'audio'
							),
							'download-link' => array(
								'title' => __('Download Link' , 'gdlr-song'),
								'type' => 'text',
							),
							'apple-store' => array(
								'title' => __('Apple Store Link' , 'gdlr-song'),
								'type' => 'text',
							),
							'amazon-link' => array(
								'title' => __('Amazon Link' , 'gdlr-song'),
								'type' => 'text',
							),		
							'artist' => array(
								'title' => __('Song Artist' , 'gdlr-song'),
								'type' => 'text',
							),	
							'album' => array(
								'title' => __('Song Album' , 'gdlr-song'),
								'type' => 'text',
								'description' => __('Filling this option will overwrite the album name of this song', 'gdlr-song')
							),								
						)
					),

				)
			);
			
		}
	}	
	
	// add song in page builder area
	add_filter('gdlr_page_builder_option', 'gdlr_register_song_item');
	if( !function_exists('gdlr_register_song_item') ){
		function gdlr_register_song_item( $page_builder = array() ){
			global $gdlr_spaces;
				
			$page_builder['media-item']['options']['album'] = array(	
				'title'=> __('Album List', 'gdlr-song'), 
				'type'=>'item',
				'options'=>array(
					'title-type'=> array(	
						'title'=> __('Title Type' ,'gdlr-song'),
						'type'=> 'combobox',
						'options'=> array(
							'none'=> __('None' ,'gdlr-song'),
							'left'=> __('Left Align With Caption' ,'gdlr-song'),
							'center'=> __('Center Align With Caption' ,'gdlr-song')
						)
					),										
					'title'=> array(	
						'title'=> __('Title' ,'gdlr-song'),
						'type'=> 'text',
						'wrapper-class'=>'title-type-wrapper left-wrapper center-wrapper no-caption-wrapper'
					),			
					'caption'=> array(	
						'title'=> __('Caption' ,'gdlr-song'),
						'type'=> 'textarea',
						'wrapper-class'=>'title-type-wrapper left-wrapper center-wrapper'
					),
					'album-style'=> array(
						'title'=> __('Album Style' ,'gdlr-song'),
						'type'=> 'combobox',
						'options'=> array(
							'grid'=>__('Grid Style','gdlr-song'),
							'grid-no-space'=>__('Grid Style Without Space','gdlr-song'),
							'carousel'=>__('Carousel Style','gdlr-song'),
							'carousel-no-space'=>__('Carousel Style Without Space','gdlr-song'),
						),
						'description'=> __('Only without space style will be functioned correctly in \'Full Size\' wrapper item.','gdlr-song')
					),
					'album-size'=> array(
						'title'=> __('Album Size' ,'gdlr-song'),
						'type'=> 'combobox',
						'options'=> array(
							'1/4'=> '1/4',
							'1/3'=> '1/3',
							'1/2'=> '1/2',
							'1/1'=> '1/1'
						),
						'default'=> '1/3'
					),
					'album'=> array(
						'title'=> __('Album' ,'gdlr-song'),
						'type'=> 'combobox',
						'options'=> array_merge(array('all'=>__('All', 'gdlr-song')), gdlr_get_term_list('album')),
						'description'=> __('Please noted that it will shows only the child album of selected album', 'gdlr-song')
					),
					'num-fetch'=> array(	
						'title'=> __('Num Fetch' ,'gdlr-song'),
						'type'=> 'text',
						'default'=> 5
					),				
					'thumbnail-size'=> array(
						'title'=> __('Thumbnail Size' ,'gdlr-song'),
						'type'=> 'combobox',
						'options'=> gdlr_get_thumbnail_list(),
						'description'=> __('Only effects to <strong>standard and gallery post format</strong>','gdlr-song')
					),					
					'pagination' => array(
						'title' => __('Pagination', 'gdlr-song'),
						'type' => 'checkbox',
						'default' => 'disable'
					),						
					'orderby' => array(
						'title' => __('Orderby', 'gdlr-song'),
						'type' => 'combobox',
						'options' => array(
							'name' => __('Name', 'gdlr-song'),
							'id' => __('ID', 'gdlr-song'),
							'slug' => __('Slug', 'gdlr-song'),
							'count' => __('Count', 'gdlr-song'),
						)
					),						
					'order' => array(
						'title' => __('Order', 'gdlr-song'),
						'type' => 'combobox',
						'options' => array(
							'asc' => __('Ascending', 'gdlr-song'),
							'desc' => __('Descending', 'gdlr-song'),
						)
					),					
					'margin-bottom' => array(
						'title' => __('Margin Bottom', 'gdlr-song'),
						'type' => 'text',
						'default' => $gdlr_spaces['bottom-port-item'],
						'description' => __('Spaces after ending of this item', 'gdlr-song')
					),	
				)
			);
				
			$page_builder['media-item']['options']['player'] = array(
				'title'=> __('Music Player', 'gdlr-song'), 
				'type'=>'item',
				'options'=>array(		
					'title-type'=> array(	
						'title'=> __('Title Type' ,'gdlr-song'),
						'type'=> 'combobox',
						'options'=> array(
							'none'=> __('None' ,'gdlr-song'),
							'left'=> __('Left Align With Caption' ,'gdlr-song'),
							'center'=> __('Center Align With Caption' ,'gdlr-song')
						)
					),										
					'title'=> array(	
						'title'=> __('Title' ,'gdlr-song'),
						'type'=> 'text',
						'wrapper-class'=>'title-type-wrapper left-wrapper center-wrapper no-caption-wrapper'
					),			
					'caption'=> array(	
						'title'=> __('Caption' ,'gdlr-song'),
						'type'=> 'textarea',
						'wrapper-class'=>'title-type-wrapper left-wrapper center-wrapper'
					),					
					'album'=> array(
						'title'=> __('Album' ,'gdlr-song'),
						'type'=> 'combobox',
						'options'=> gdlr_get_term_list('album')
					),					
					'num-fetch'=> array(
						'title'=> __('Num Fetch' ,'gdlr-song'),
						'type'=> 'text',	
						'default'=> '5',
						'description'=> __('Specify the number of song you want to pull out.', 'gdlr-song')
					),																				
					'orderby'=> array(
						'title'=> __('Order By' ,'gdlr-song'),
						'type'=> 'combobox',
						'options'=> array(
							'date' => __('Publish Date', 'gdlr-song'), 
							'title' => __('Title', 'gdlr-song'), 
							'rand' => __('Random', 'gdlr-song'), 
						)
					),
					'order'=> array(
						'title'=> __('Order' ,'gdlr-song'),
						'type'=> 'combobox',
						'options'=> array(
							'desc'=>__('Descending Order', 'gdlr-song'), 
							'asc'=> __('Ascending Order', 'gdlr-song'), 
						)
					),				
					'margin-bottom' => array(
						'title' => __('Margin Bottom', 'gdlr-song'),
						'type' => 'text',
						'default' => $gdlr_spaces['bottom-item'],
						'description' => __('Spaces after ending of this item', 'gdlr-song')
					),				
				)
			);
			return $page_builder;
		}
	}
	
?>