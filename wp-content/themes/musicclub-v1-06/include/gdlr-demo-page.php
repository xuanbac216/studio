<?php
	/*	
	*	Goodlayers Framework File
	*	---------------------------------------------------------------------
	*	This file contains the homepage loading button in page option area
	*	---------------------------------------------------------------------
	*/
	
	add_action('add_meta_boxes', 'gdlr_init_demo_page_option');
	if( !function_exists('gdlr_init_demo_page_option') ){
		function gdlr_init_demo_page_option(){
			add_meta_box( 'demo-page-option', 
				__('Load Demo Page', 'gdlr_translate'), 
				'gdlr_create_demo_page_option',
				'page',
				'side',
				'default'
			);
		}
	}
	
	if( !function_exists('gdlr_create_demo_page_option') ){
		function gdlr_create_demo_page_option(){
			global $post;
		
			$buttons = array(
				'homepage-1' => __('Homepage Full', 'gdlr_translate'),
				'homepage-2' => __('Homepage Boxed', 'gdlr_translate'),
				'contact-1' => __('Contact 1', 'gdlr_translate'),
				'contact-2' => __('Contact 2', 'gdlr_translate'),
				'about-1' => __('Band Members', 'gdlr_translate'),
				'about-2' => __('Event List With Month', 'gdlr_translate'),
				'service' => __('Album Featured', 'gdlr_translate'),
			);
			
			echo '<div id="gdlr-load-demo-wrapper" data-ajax="' . AJAX_URL . '" data-id="' . $post->ID . '" data-action="load_demo_pagebuilder">';
			echo '<em>';
			echo __('*This option allow you to set page item to following pages with one click. Note that to use this option will replace all your current page item setting in this page and <strong>This Can\'t Be Undone</strong>. ( Images are not included. )', 'gdlr_translate');
			echo '</em><div class="clear"></div>';
			foreach( $buttons as $button_slug => $button_title ){
				echo '<input type="button" data-slug="' . $button_slug . '" value="' . $button_title . '" />';
			}
			echo '</div>';

		}
	}
	
				//	'above-sidebar'=>'[]',
				//	'below-sidebar'=>'[]',	
				//	'content-with-sidebar'=>'[]',
				//	'post-option'=>''
				//),
	
	add_action('wp_ajax_load_demo_pagebuilder', 'gdlr_load_demo_pagebuilder');
	if( !function_exists('gdlr_load_demo_pagebuilder') ){
		function gdlr_load_demo_pagebuilder(){
			$default_data = array(
				'homepage-1' => array(
					'above-sidebar'=>'[{"item-type":"wrapper","item-builder-title":"Full Size Wrapper","type":"full-size-wrapper","items":[{"item-type":"item","item-builder-title":"Revolution Slider","type":"revolution-slider","option":{"page-item-id":"","id":"1","margin-bottom":"0px"}}],"option":{"page-item-id":"","border":"none","border-top-color":"#e9e9e9","border-bottom-color":"#e9e9e9","padding-top":"0px","padding-bottom":"0px"}},{"item-type":"wrapper","item-builder-title":"Background/Parallax Wrapper","type":"parallax-bg-wrapper","items":[{"item-type":"item","item-builder-title":"Title","type":"title","option":{"page-item-id":"","title-type":"center","title":"Our Latest Album","caption":"Fresh from the house of Music Club Band","margin-bottom":"0px"}}],"option":{"page-item-id":"","type":"image","background":"2470","background-speed":"0","pattern":"1","video":"","video-overlay":"0.5","video-player":"enable","skin":"no-skin","border":"none","border-top-color":"#e9e9e9","border-bottom-color":"#e9e9e9","padding-top":"60px","padding-bottom":"15px"}},{"item-type":"wrapper","item-builder-title":"Full Size Wrapper","type":"full-size-wrapper","items":[{"item-type":"item","item-builder-title":"Album List","type":"album","option":{"page-item-id":"","title-type":"none","title":"Our Latest Albums","caption":"Fresh from the house","album-style":"grid-no-space","album-size":"1/3","album":"all","num-fetch":"3","thumbnail-size":"post-slider-bottom","margin-bottom":"0px"}}],"option":{"page-item-id":"","border":"none","border-top-color":"#e9e9e9","border-bottom-color":"#e9e9e9","padding-top":"0px","padding-bottom":"0px"}}]',
					'below-sidebar'=>'[{"item-type":"wrapper","item-builder-title":"Background/Parallax Wrapper","type":"parallax-bg-wrapper","items":[{"item-type":"item","item-builder-title":"Event Counter","type":"event-counter","option":{"page-item-id":"","post-name":"oakland-ca","margin-bottom":"20px"}}],"option":{"page-item-id":"","type":"image","background":"2472","background-speed":"0","pattern":"1","video":"","video-overlay":"0.5","video-player":"enable","skin":"gdlr-skin-white-text","border":"none","border-top-color":"#e9e9e9","border-bottom-color":"#e9e9e9","padding-top":"80px","padding-bottom":"40px"}},{"item-type":"wrapper","item-builder-title":"Background/Parallax Wrapper","type":"parallax-bg-wrapper","items":[{"item-type":"item","item-builder-title":"Event","type":"event","option":{"page-item-id":"","title-type":"left","title":"Upcoming Events","caption":"See you soon!","right-text":"View All Events","right-text-link":"http://themes.goodlayers2.com/musicclub/event-list-with-month/","category":"","tag":"","event-style":"list-style","num-fetch":"5","orderby":"date","order":"asc","pagination":"disable","margin-bottom":"0px"}}],"option":{"page-item-id":"","type":"image","background":"2375","background-speed":"-1","pattern":"1","video":"","video-overlay":"0.5","video-player":"enable","skin":"no-skin","border":"none","border-top-color":"#e9e9e9","border-bottom-color":"#e9e9e9","padding-top":"70px","padding-bottom":"40px"}},{"item-type":"wrapper","item-builder-title":"Color Wrapper","type":"color-wrapper","items":[{"item-type":"item","item-builder-title":"Portfolio","type":"portfolio","option":{"page-item-id":"","title-type":"center","title":"Events Gallery","caption":"Using Portfolio Feature","right-text":"View All Works","right-text-link":"","category":"event-gallery","tag":"","portfolio-style":"classic","portfolio-info":"date","num-fetch":"6","portfolio-size":"1/4","portfolio-layout":"carousel","portfolio-filter":"disable","thumbnail-size":"post-slider-bottom","orderby":"date","order":"desc","pagination":"disable","margin-bottom":"0px"}}],"option":{"page-item-id":"","background":"#242424","skin":"no-skin","border":"none","border-top-color":"#e9e9e9","border-bottom-color":"#e9e9e9","padding-top":"80px","padding-bottom":"15px"}},{"item-type":"wrapper","item-builder-title":"Background/Parallax Wrapper","type":"parallax-bg-wrapper","items":[{"item-type":"item","item-builder-title":"Title","type":"title","option":{"page-item-id":"","title-type":"center","title":"Latest Videos","caption":"Activities!","margin-bottom":"20px"}},{"item-type":"wrapper","item-builder-title":"Column Item","type":"column1-3","items":[{"item-type":"item","item-builder-title":"Video","type":"video","option":{"page-item-id":"","url":"http://vimeo.com/51511202","margin-bottom":"20px"}}],"option":{},"size":"1/2"},{"item-type":"wrapper","item-builder-title":"Column Item","type":"column1-3","items":[{"item-type":"item","item-builder-title":"Video","type":"video","option":{"page-item-id":"","url":"http://vimeo.com/13597593","margin-bottom":"20px"}}],"option":{},"size":"1/2"}],"option":{"page-item-id":"","type":"image","background":"2463","background-speed":"0.3","pattern":"1","video":"","video-overlay":"0.5","video-player":"enable","skin":"no-skin","border":"none","border-top-color":"#e9e9e9","border-bottom-color":"#e9e9e9","padding-top":"90px","padding-bottom":"60px"}}]',
					'content-with-sidebar'=>'[{"item-type":"item","item-builder-title":"Blog","type":"blog","option":{"page-item-id":"","title-type":"left","title":"Recent News","caption":"Get update from us!","right-text":"Read All News","right-text-link":"http://themes.goodlayers2.com/musicclub/blog-full-with-right-sidebar/","category":"fit-row","tag":"","num-excerpt":"25","num-fetch":"3","blog-style":"blog-medium","blog-layout":"fitRows","thumbnail-size":"portfolio-detail","orderby":"date","order":"desc","pagination":"disable","enable-sticky":"enable","margin-bottom":"80px"}}]',
					'post-option'=>'{"sidebar":"left-sidebar","left-sidebar":"home-full","right-sidebar":"Footer 1","page-style":"normal","no-height-nav":"enable","show-title":"disable","page-caption":"","header-icon":"","show-content":"enable","header-background":""}'
				),
				'homepage-2' => array(
					'above-sidebar'=>'[]',
					'below-sidebar'=>'[]',	
					'content-with-sidebar'=>'[]',
					'post-option'=>''
				),
				'contact-1' => array(
					'above-sidebar'=>'[{"item-type":"wrapper","item-builder-title":"Full Size Wrapper","type":"full-size-wrapper","items":[{"item-type":"item","item-builder-title":"Content","type":"content","option":{"page-item-id":"","title-type":"none","title":"","caption":"","content":"<iframe src=|gq2|http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=seattle&aq=&sll=22.447841,114.109497&sspn=0.448038,0.550003&vpsrc=0&ie=UTF8&hq=&hnear=%E0%B8%8B%E0%B8%B5%E0%B9%81%E0%B8%AD%E0%B8%95%E0%B9%80%E0%B8%97%E0%B8%B4%E0%B8%A5+King,+%E0%B8%A3%E0%B8%B1%E0%B8%90%E0%B8%A7%E0%B8%AD%E0%B8%8A%E0%B8%B4%E0%B8%87%E0%B8%95%E0%B8%B1%E0%B8%99+%E0%B8%AA%E0%B8%AB%E0%B8%A3%E0%B8%B1%E0%B8%90%E0%B8%AD%E0%B9%80%E0%B8%A1%E0%B8%A3%E0%B8%B4%E0%B8%81%E0%B8%B2&t=m&z=12&ll=47.60621,-122.332071&output=embed|gq2| height=|gq2|360|gq2| width=|gq2|100%|gq2| frameborder=|gq2|0|gq2| marginwidth=|gq2|0|gq2| marginheight=|gq2|0|gq2| scrolling=|gq2|no|gq2|></iframe>|g1n|[gdlr_space height=|gq2|-26px|gq2|]","margin-bottom":"0px"}}],"option":{"page-item-id":"","border":"none","border-top-color":"#dddddd","border-bottom-color":"#dddddd","padding-top":"0px","padding-bottom":"0px"}}]',
					'below-sidebar'=>'[{"item-type":"wrapper","item-builder-title":"Background/Parallax Wrapper","type":"parallax-bg-wrapper","items":[{"item-type":"wrapper","item-builder-title":"Column Item","type":"column1-2","items":[{"item-type":"item","item-builder-title":"Box Icon","type":"box-icon-item","option":{"page-item-id":"","icon":"icon-envelope","icon-position":"top","icon-type":"circle","icon-color":"#ffffff","icon-background":"#e2714d","title":"Contact By Email","content":"Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.","margin-bottom":"20px"}}],"option":{},"size":"1/3"},{"item-type":"wrapper","item-builder-title":"Column Item","type":"column1-2","items":[{"item-type":"item","item-builder-title":"Box Icon","type":"box-icon-item","option":{"page-item-id":"","icon":"icon-phone-sign","icon-position":"top","icon-type":"circle","icon-color":"#ffffff","icon-background":"#e2714d","title":"Contact By Phone","content":"Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.","margin-bottom":"20px"}}],"option":{},"size":"1/3"},{"item-type":"wrapper","item-builder-title":"Column Item","type":"column1-3","items":[{"item-type":"item","item-builder-title":"Box Icon","type":"box-icon-item","option":{"page-item-id":"","icon":"icon-home","icon-position":"top","icon-type":"circle","icon-color":"#ffffff","icon-background":"#e2714d","title":"Come To See Us","content":"Lorem ipsum dolor sit amet, consectetur adipisici elit, sed eiusmod tempor incidunt ut labore et dolore magna aliqua.","margin-bottom":"20px"}}],"option":{},"size":"1/3"}],"option":{"page-item-id":"","type":"image","background":"2432","background-speed":"0","pattern":"1","video":"","video-overlay":"0.5","video-player":"enable","skin":"no-skin","border":"none","border-top-color":"#dddddd","border-bottom-color":"#dddddd","padding-top":"100px","padding-bottom":"50px"}}]',	
					'content-with-sidebar'=>'[{"item-type":"item","item-builder-title":"Content","type":"content","option":{"page-item-id":"","title-type":"none","title":"","caption":"","content":"<h4>Talk To Us!</h4>|g1n|[contact-form-7 id=|gq2|1627|gq2| title=|gq2|Contact form 1|gq2|]","margin-bottom":"60px"}}]',
					'post-option'=>'{"sidebar":"right-sidebar","left-sidebar":"Footer 1","right-sidebar":"contact","page-style":"no-footer","no-height-nav":"disable","show-title":"disable","page-caption":"","header-icon":"","show-content":"enable","header-background":""}'
				),
				'contact-2' => array(
					'above-sidebar'=>'[]',
					'below-sidebar'=>'[{"item-type":"wrapper","item-builder-title":"Full Size Wrapper","type":"full-size-wrapper","items":[{"item-type":"item","item-builder-title":"Content","type":"content","option":{"page-item-id":"","title-type":"none","title":"","caption":"","content":"<iframe src=|gq2|http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=seattle&amp;aq=&amp;sll=22.447841,114.109497&amp;sspn=0.448038,0.550003&amp;vpsrc=0&amp;ie=UTF8&amp;hq=&amp;hnear=%E0%B8%8B%E0%B8%B5%E0%B9%81%E0%B8%AD%E0%B8%95%E0%B9%80%E0%B8%97%E0%B8%B4%E0%B8%A5+King,+%E0%B8%A3%E0%B8%B1%E0%B8%90%E0%B8%A7%E0%B8%AD%E0%B8%8A%E0%B8%B4%E0%B8%87%E0%B8%95%E0%B8%B1%E0%B8%99+%E0%B8%AA%E0%B8%AB%E0%B8%A3%E0%B8%B1%E0%B8%90%E0%B8%AD%E0%B9%80%E0%B8%A1%E0%B8%A3%E0%B8%B4%E0%B8%81%E0%B8%B2&amp;t=m&amp;z=12&amp;ll=47.60621,-122.332071&amp;output=embed|gq2| height=|gq2|360|gq2| width=|gq2|100%|gq2| frameborder=|gq2|0|gq2| marginwidth=|gq2|0|gq2| marginheight=|gq2|0|gq2| scrolling=|gq2|no|gq2|></iframe> [gdlr_space height=|gq2|-26px|gq2|]","margin-bottom":"0px"}}],"option":{"page-item-id":"","border":"top","border-top-color":"#d8d8d8","border-bottom-color":"#dddddd","padding-top":"0px","padding-bottom":"0px"}}]',	
					'content-with-sidebar'=>'[{"item-type":"item","item-builder-title":"Content","type":"content","option":{"page-item-id":"","title-type":"none","title":"","caption":"","content":"<h4>Talk To Us!</h4>|g1n|[contact-form-7 id=|gq2|1627|gq2| title=|gq2|Contact form 1|gq2|]","margin-bottom":"60px"}}]',
					'post-option'=>'{"sidebar":"left-sidebar","left-sidebar":"contact","right-sidebar":"contact","page-style":"no-footer","no-height-nav":"enable","show-title":"enable","page-caption":"Amet Porta Dolor","header-icon":"icon-phone","show-content":"enable","header-background":""}'
				),
				'about-1' => array(
					'above-sidebar'=>'[]',
					'below-sidebar'=>'[]',	
					'content-with-sidebar'=>'[{"item-type":"wrapper","item-builder-title":"Background/Parallax Wrapper","type":"parallax-bg-wrapper","items":[{"item-type":"item","item-builder-title":"Personnel","type":"personnel","option":{"page-item-id":"","personnel":"[{|gq2|gdl-tab-author-image-url|gq2|:|gq2|http://themes.goodlayers2.com/musicclub/wp-content/uploads/2014/02/member-1.jpg|gq2|,|gq2|gdl-tab-author-image|gq2|:|gq2|2451|gq2|,|gq2|gdl-tab-title|gq2|:|gq2|Joan Honey|gq2|,|gq2|gdl-tab-position|gq2|:|gq2|Vocal|gq2|,|gq2|gdl-tab-content|gq2|:|gq2|Maecenas sed diam eget risus varius blandit sit amet non magna. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.|gq2|,|gq2|gdl-tab-social-list|gq2|:|gq2||gq2|},{|gq2|gdl-tab-author-image-url|gq2|:|gq2|http://themes.goodlayers2.com/musicclub/wp-content/uploads/2014/02/member-3.jpg|gq2|,|gq2|gdl-tab-author-image|gq2|:|gq2|2453|gq2|,|gq2|gdl-tab-title|gq2|:|gq2|Thomas Smith|gq2|,|gq2|gdl-tab-position|gq2|:|gq2|Vocal|gq2|,|gq2|gdl-tab-content|gq2|:|gq2|Maecenas sed diam eget risus varius blandit sit amet non magna. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.|gq2|,|gq2|gdl-tab-social-list|gq2|:|gq2||gq2|},{|gq2|gdl-tab-author-image-url|gq2|:|gq2|http://themes.goodlayers2.com/musicclub/wp-content/uploads/2014/02/member-2.jpg|gq2|,|gq2|gdl-tab-author-image|gq2|:|gq2|2452|gq2|,|gq2|gdl-tab-title|gq2|:|gq2|Albert Silva|gq2|,|gq2|gdl-tab-position|gq2|:|gq2|Guitar|gq2|,|gq2|gdl-tab-content|gq2|:|gq2|Maecenas sed diam eget risus varius blandit sit amet non magna. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.|gq2|,|gq2|gdl-tab-social-list|gq2|:|gq2||gq2|}]","title-type":"none","title":"","caption":"","personnel-columns":"3","personnel-type":"static","personnel-style":"plain-style","thumbnail-size":"full","margin-bottom":"40px"}},{"item-type":"item","item-builder-title":"Personnel","type":"personnel","option":{"page-item-id":"","personnel":"[{|gq2|gdl-tab-author-image-url|gq2|:|gq2|http://themes.goodlayers2.com/musicclub/wp-content/uploads/2014/02/member-4.jpg|gq2|,|gq2|gdl-tab-author-image|gq2|:|gq2|2454|gq2|,|gq2|gdl-tab-title|gq2|:|gq2|Palo Sorlo|gq2|,|gq2|gdl-tab-position|gq2|:|gq2|Pianist|gq2|,|gq2|gdl-tab-content|gq2|:|gq2|Maecenas sed diam eget risus varius blandit sit amet non magna. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.|gq2|,|gq2|gdl-tab-social-list|gq2|:|gq2||gq2|},{|gq2|gdl-tab-author-image-url|gq2|:|gq2|http://themes.goodlayers2.com/musicclub/wp-content/uploads/2014/02/member-5.jpg|gq2|,|gq2|gdl-tab-author-image|gq2|:|gq2|2455|gq2|,|gq2|gdl-tab-title|gq2|:|gq2|Jane Mott|gq2|,|gq2|gdl-tab-position|gq2|:|gq2|Chorus|gq2|,|gq2|gdl-tab-content|gq2|:|gq2|Maecenas sed diam eget risus varius blandit sit amet non magna. Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum.|gq2|,|gq2|gdl-tab-social-list|gq2|:|gq2||gq2|}]","title-type":"none","title":"","caption":"","personnel-columns":"2","personnel-type":"static","personnel-style":"plain-style","thumbnail-size":"full","margin-bottom":"40px"}}],"option":{"page-item-id":"","type":"image","background":"2463","background-speed":"-1","pattern":"1","video":"","video-overlay":"0.5","video-player":"enable","skin":"no-skin","border":"none","border-top-color":"#e9e9e9","border-bottom-color":"#e9e9e9","padding-top":"90px","padding-bottom":"20px"}}]',
					'post-option'=>'{"sidebar":"no-sidebar","left-sidebar":"Footer 1","right-sidebar":"Footer 1","page-style":"normal","no-height-nav":"disable","show-title":"disable","page-caption":"Venenatis Nullam","header-icon":"icon-star","show-content":"enable","header-background":""}'
				),
				'about-2' => array(
					'above-sidebar'=>'[]',
					'below-sidebar'=>'[]',	
					'content-with-sidebar'=>'[{"item-type":"wrapper","item-builder-title":"Background/Parallax Wrapper","type":"parallax-bg-wrapper","items":[{"item-type":"item","item-builder-title":"Event Counter","type":"event-counter","option":{"page-item-id":"","post-name":"oakland-ca","margin-bottom":"20px"}}],"option":{"page-item-id":"","type":"image","background":"2472","background-speed":"0","pattern":"1","video":"","video-overlay":"0.5","video-player":"enable","skin":"gdlr-skin-white-text","border":"none","border-top-color":"#e9e9e9","border-bottom-color":"#e9e9e9","padding-top":"80px","padding-bottom":"40px"}},{"item-type":"wrapper","item-builder-title":"Background/Parallax Wrapper","type":"parallax-bg-wrapper","items":[{"item-type":"item","item-builder-title":"Event","type":"event","option":{"page-item-id":"","title-type":"none","title":"","caption":"","right-text":"View All Events","right-text-link":"","category":"","tag":"","event-style":"list-by-month","num-fetch":"99","orderby":"date","order":"asc","pagination":"disable","margin-bottom":"60px"}}],"option":{"page-item-id":"","type":"image","background":"2375","background-speed":"-1","pattern":"1","video":"","video-overlay":"0.5","video-player":"enable","skin":"no-skin","border":"none","border-top-color":"#e9e9e9","border-bottom-color":"#e9e9e9","padding-top":"80px","padding-bottom":"60px"}}]',
					'post-option'=>'{"sidebar":"no-sidebar","left-sidebar":"Footer 1","right-sidebar":"Footer 1","page-style":"normal","no-height-nav":"enable","show-title":"enable","page-caption":"Fusce Cras Ridiculus","header-icon":"icon-th-list","show-content":"enable","header-background":""}'
				),
				'service' => array(
					'above-sidebar'=>'[]',
					'below-sidebar'=>'[]',	
					'content-with-sidebar'=>'[{"item-type":"wrapper","item-builder-title":"Background/Parallax Wrapper","type":"parallax-bg-wrapper","items":[{"item-type":"item","item-builder-title":"Album List","type":"album","option":{"page-item-id":"","title-type":"center","title":"Music Album","caption":"","album-style":"carousel-no-space","album-size":"1/2","album":"all","thumbnail-size":"post-slider-bottom","margin-bottom":"60px"}}],"option":{"page-item-id":"","type":"image","background":"2444","background-speed":"0.3","pattern":"1","video":"","video-overlay":"0.5","video-player":"enable","skin":"no-skin","border":"none","border-top-color":"#e9e9e9","border-bottom-color":"#e9e9e9","padding-top":"90px","padding-bottom":"40px"}},{"item-type":"wrapper","item-builder-title":"Color Wrapper","type":"color-wrapper","items":[{"item-type":"item","item-builder-title":"Stunning Text","type":"stunning-text","option":{"page-item-id":"","title":"Consectetur Pharetra","caption":"Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Donec ullamcorper nulla non metus auctor fringilla.","button-text":"Buy Now","button-link":"#","style":"center","margin-bottom":"20px"}}],"option":{"page-item-id":"","background":"#222222","skin":"gdlr-skin-white-text","border":"none","border-top-color":"#e9e9e9","border-bottom-color":"#e9e9e9","padding-top":"70px","padding-bottom":"25px"}}]',
					'post-option'=>'{"sidebar":"no-sidebar","left-sidebar":"Footer 1","right-sidebar":"Footer 1","page-style":"normal","no-height-nav":"disable","show-title":"disable","page-caption":"Venenatis Egestas Inceptos","header-icon":"icon-headphones","show-content":"enable","header-background":""}'
				),				
			);

			$loaded_data = $default_data[$_POST['slug']];
			foreach( $loaded_data as $meta_key => $meta_value ){
				update_post_meta($_POST['post_id'], $meta_key, $meta_value);
			}
		}
	}
?>