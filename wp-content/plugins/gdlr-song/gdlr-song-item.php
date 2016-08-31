<?php
	/*	
	*	Goodlayers Song Item Management File
	*	---------------------------------------------------------------------
	*	This file contains functions that help you create song item
	*	---------------------------------------------------------------------
	*/
	
	// add action for the player at the footer area
	add_action('gdlr_footer_section', 'gdlr_float_player', 10, 2);
	if( !function_exists('gdlr_float_player') ){
		function gdlr_float_player(){	
			global $theme_option;
			
			if( !empty($theme_option['enable-float-player']) && $theme_option['enable-float-player'] == 'enable' ){

				// query posts section
				$args = array('post_type' => 'song', 'suppress_filters' => false);
				$args['posts_per_page'] = (empty($theme_option['float-player-num-fetch']))? '100': $theme_option['float-player-num-fetch'];
				$args['orderby'] = (empty($theme_option['float-player-orderby']))? 'post_date': $theme_option['float-player-orderby'];
				$args['order'] = (empty($theme_option['float-player-order']))? 'desc': $theme_option['float-player-order'];
				$args['paged'] = 1;

				if( is_tax('album') ){
					$theme_option['float-player-category'] = get_query_var('album');
					$args['orderby'] = 'post_date';
					$args['order'] = 'desc';
				}
				
				if( !empty($theme_option['float-player-category']) ){
					$args['tax_query'] = array();
					if( !empty($theme_option['float-player-category']) ){
						array_push($args['tax_query'], array('terms'=>explode(',', $theme_option['float-player-category']), 'taxonomy'=>'album', 'field'=>'slug'));
					}				
				}			
				$query = new WP_Query( $args );

				// get album meta option 
				$album_meta = get_option('gdlr_album_meta', array());
				$album_meta = !empty($album_meta[$theme_option['float-player-category']])? $album_meta[$theme_option['float-player-category']]: array();				
				
				$autoplay = ($theme_option['float-player-autoplay'] == 'enable')? 'autoplay': '';
				
				$count = 1;
				echo '<div class="gdlr-open-float-player" id="gdlr-open-float-player" ><i class="icon-play"></i></div>';
				echo '<div class="gdlr-float-player" id="gdlr-float-player" >';
				echo '<div class="container">';
				while($query->have_posts()){ $query->the_post(); 

					$post_option = json_decode(gdlr_decode_preventslashes(get_post_meta(get_the_ID(), 'post-option', true)), true);
					
					if($count == 1){ 
						echo '<div class="gdlr-float-top-player gdlr-item">';

						echo '<div class="gdlr-top-player-thumbnail">';
						echo gdlr_get_image($album_meta['upload'], 'thumbnail');
						echo '</div>';
						echo '<div class="gdlr-top-player-title">' . gdlr_get_full_song_title($post_option) . '</div>';
						
						// download section
						echo '<div class="gdlr-top-player-download">';
						echo '<a class="top-player-list" href="#">';
						echo '<i class="icon-list-ul"></i>';
						echo '</a>';
						echo gdlr_print_download_link($post_option['download-link'], $post_option['apple-store'], $post_option['amazon-link'], 'source');
						echo '</div>'; // top player download
						
						echo '<audio class="gdlr-audio-player" ' . $autoplay . ' preload="auto" style="width: 100%; height: 70px;">';
						echo gdlr_print_audio_link($post_option['mp3'], $post_option['ogg'], $post_option['wav'], 'source');
						echo '</audio>';	
						echo '</div>'; // gdlr-top-player	
						echo '<ol class="gdlr-player-list">';
					}
					
					echo '<li ';
					echo ($count == 1)? 'class="active" ': '';
					echo gdlr_print_download_link($post_option['download-link'], $post_option['apple-store'], $post_option['amazon-link'], 'attr');
					echo gdlr_print_audio_link($post_option['mp3'], $post_option['ogg'], $post_option['wav'], 'attr');
					echo '>' . gdlr_get_full_song_title($post_option) . '</li>';					
				
					$count++;
				}
				echo '</ol>';
				echo '</div>'; // container
				echo '</div>'; // gdlr-float-player
			}	
		}
	}
	
	// add action to check for song item
	add_action('gdlr_print_item_selector', 'gdlr_check_song_item', 10, 2);
	if( !function_exists('gdlr_check_song_item') ){
		function gdlr_check_song_item( $type, $settings = array() ){
			if($type == 'player'){
				echo gdlr_print_player_item( $settings );
			}else if($type == 'album'){
				echo gdlr_print_album_item( $settings );
			}
		}
	}
	
	// print player item
	if( !function_exists('gdlr_print_player_item') ){
		function gdlr_print_player_item( $settings = array() ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$settings['title-type'] = (empty($settings['title-type']))? 'none': $settings['title-type'];
			$settings['title'] = (empty($settings['title']))? '': $settings['title'];
			$settings['caption'] = (empty($settings['caption']))? '': $settings['caption'];	

			$ret  = gdlr_get_item_title($settings['title-type'], $settings['title'], $settings['caption']);	
			$ret .= '<div class="gdlr-player-item-wrapper gdlr-item" ' . $item_id . $margin_style . '>'; 
			
			// query posts section
			$args = array('post_type' => 'song', 'suppress_filters' => false);
			$args['posts_per_page'] = (empty($settings['num-fetch']))? '5': $settings['num-fetch'];
			$args['orderby'] = (empty($settings['orderby']))? 'post_date': $settings['orderby'];
			$args['order'] = (empty($settings['order']))? 'desc': $settings['order'];
			$args['paged'] = 1;

			if( !empty($settings['album']) ){
				$args['tax_query'] = array();
				if( !empty($settings['album']) ){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['album']), 'taxonomy'=>'album', 'field'=>'slug'));
				}				
			}			
			$query = new WP_Query( $args );
			
			// get album meta option 
			$album_meta = get_option('gdlr_album_meta', array());
			$album_meta = !empty($album_meta[$settings['album']])? $album_meta[$settings['album']]: array();

			$count = 1;
			if( $query->have_posts() ){
				while($query->have_posts()){ $query->the_post(); 
					$post_option = json_decode(gdlr_decode_preventslashes(get_post_meta(get_the_ID(), 'post-option', true)), true);
					
					if($count == 1){ 
						$ret .= '<div class="gdlr-player-item">';	
						$ret .= '<div class="gdlr-top-player">';
						
						$ret .= '<div class="gdlr-top-player-inner">';
						if( !empty($album_meta['upload']) ){
							$ret .= '<div class="gdlr-top-player-thumbnail">';
							$ret .= gdlr_get_image($album_meta['upload'], 'thumbnail');
							$ret .= '</div>';
						}
						$ret .= '<div class="gdlr-top-player-content">';
						$ret .= '<div class="gdlr-top-player-title">' . get_the_title() . '</div>';
						
						// download section
						$ret .= '<div class="gdlr-top-player-download">';
						$ret .= gdlr_print_download_link($post_option['download-link'], $post_option['apple-store'], $post_option['amazon-link'], 'source');
						$ret .= '</div>'; // top player download
						
						$ret .= '</div>'; // top player content
						$ret .= '<div class="clear"></div>';
						$ret .= '</div>'; // top player inner
						
						$ret .= '<audio class="gdlr-audio-player" preload="auto" style="width: 100%; height: 50px;">';
						$ret .= gdlr_print_audio_link($post_option['mp3'], $post_option['ogg'], $post_option['wav'], 'source');
						$ret .= '</audio>';	
						$ret .= '</div>'; // gdlr-top-player				
						$ret .= '<ol class="gdlr-player-list">';
					}

					$ret .= '<li ';
					$ret .= ($count == 1)? 'class="active" ': '';
					$ret .= 'data-title="' . get_the_title() . '" ';
					$ret .= gdlr_print_download_link($post_option['download-link'], $post_option['apple-store'], $post_option['amazon-link'], 'attr');
					$ret .= gdlr_print_audio_link($post_option['mp3'], $post_option['ogg'], $post_option['wav'], 'attr');
					$ret .= '>' . $count . '. ' . get_the_title() . '</li>';
					
					$count++;
				} 
				$ret .= '</ol>';
				$ret .= '<div class="clear"></div>';
				$ret .= '</div>'; // gdlr-player-item
				wp_reset_postdata();
			}
				
			$ret .= '</div>'; // gdlr-player-item-wrapper
			return $ret;
		}
	}

	// print album item
	if( !function_exists('gdlr_print_album_item') ){
		function gdlr_print_album_item( $settings = array(), $with_title = true ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-port-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$ret  = '';
			if( $with_title ){
				$settings['title-type'] = (empty($settings['title-type']))? 'none': $settings['title-type'];
				$settings['title'] = (empty($settings['title']))? '': $settings['title'];
				$settings['caption'] = (empty($settings['caption']))? '': $settings['caption'];	
				
				if( $settings['album-style'] == 'carousel' || $settings['album-style'] == 'carousel-no-space' ){
					$ret .= gdlr_get_item_title($settings['title-type'], $settings['title'], $settings['caption'],
						'gdlr-nav-container', '<div class="nav-container style-1" ></div>');
				}else{
					$ret .= gdlr_get_item_title($settings['title-type'], $settings['title'], $settings['caption']);	
				}
			}
			
			$ret .= '<div class="gdlr-album-item-wrapper" ' . $item_id . $margin_style . '>'; 
			
			if( empty($settings['album']) || $settings['album'] == 'all' ){
				$settings['album'] = '';
			}else{
				$parent_id = get_term_by('slug', $settings['album'], 'album');
				$settings['album'] = $parent_id->term_id;
			}

			$order = empty($settings['order'])? 'asc': $settings['order'];
			$orderby = empty($settings['orderby'])? 'name': $settings['orderby'];
			$album_list = get_categories( array('taxonomy'=>'album', 'hide_empty'=>1, 'parent'=>$settings['album'],
				'number'=>9999, 'hierarchical'=>0, 'orderby'=>$orderby, 'order'=>$order) );

			$max_num_page = ceil(sizeOf($album_list) / intval($settings['num-fetch']));
			$paged = (get_query_var('paged'))? get_query_var('paged') : get_query_var('page');
			$paged = empty($paged)? 1: intval($paged);
			
			$album_list_t = array(); 
			for( $i=($paged-1) * intval($settings['num-fetch']); $i<($paged) * intval($settings['num-fetch']); $i++ ){
				if( !empty($album_list[$i]) ){
					$album_list_t[] = $album_list[$i];
				}
			}
			
			$settings['album-size'] = str_replace('1/', '', $settings['album-size']);
			$item_class = (strpos($settings['album-style'], 'no-space') > 0)? 'gdlr-item-no-space': '';
			
			$ret .= '<div class="gdlr-album-item-holder ' . $item_class . '">';
			if( $settings['album-style'] == 'grid' || $settings['album-style'] == 'grid-no-space' ){
				$ret .= gdlr_print_album_grid($album_list_t, $settings['album-size'], $settings['thumbnail-size']);	
			}else if( $settings['album-style'] == 'carousel' || $settings['album-style'] == 'carousel-no-space' ){
				$ret .= gdlr_print_album_carousel($album_list_t, $settings['album-size'], $settings['thumbnail-size']);
			}
			$ret .= '</div>'; // gdlr-album-item-holder

			if( !empty($settings['pagination']) && $settings['pagination'] == 'enable' ){
				$ret .= gdlr_get_pagination($max_num_page, $paged);
			}
			$ret .= '</div>';
			return $ret;
		}
	}
	
	// get full song title
	if( !function_exists('gdlr_get_full_song_title') ){
		function gdlr_get_full_song_title( $option ){
			
			$ret  = get_the_title();
			
			if( !empty($option['album']) ){
				$album = $option['album'];
			}else{
				$term = get_the_terms(get_the_ID(), 'album');
				if( is_array($term) ){
					$term = reset($term);
					$album = $term->name;
				}else{
					$album = '';
				}
			}

			if( !empty($option['artist']) || !empty($album) ){
				$ret .= ' // <span class="gdlr-song-title-info">';
				if( !empty($option['artist']) ){
					$ret .= $option['artist'];
				}
				if( !empty($album) ){
					$ret .= !empty($option['artist'])? ' - ' . $album: $album;
				}
				$ret .= '</span>';
			}
			
			return $ret;
		}
	}
	
	// print grid album
	if( !function_exists('gdlr_print_album_grid') ){
		function gdlr_print_album_grid( $album_list, $size, $thumbnail_size ){
			$album_meta = get_option('gdlr_album_meta', array());
			
			$current_size = 0;
			$ret = '';
			foreach( $album_list as $album ){
				if( $current_size % $size == 0 ){
					$ret .= '<div class="clear"></div>';
				}
				
				$album_info = $album_meta[$album->slug];
				$album_link = get_term_link($album, 'album');
				
				$ret .= '<div class="' . gdlr_get_column_class('1/' . $size) . '">';
				$ret .= '<div class="gdlr-item gdlr-album-item" >';
				$ret .= '<div class="gdlr-album-image"><a href="' . $album_link . '" >';
				$ret .= gdlr_get_image($album_info['upload'], $thumbnail_size);
				$ret .= '</a></div>';
				
				$ret .= '<div class="gdlr-album-content">';
				$ret .= '<span class="gdlr-play-album"><i class="icon-play"></i></span>';
				$ret .= '<a class="gdlr-album-title" href="' . $album_link . '" >' . $album->name . '</a>';
				$ret .= '<span class="gdlr-album-download">';
				$ret .= gdlr_print_download_link($album_info['download-link'], $album_info['apple-link'],
					$album_info['amazon-link'], 'source');
				$ret .= '</span>';
				
				// get album list
				$ret .= '<div class="gdlr-album-thumbnail" >' . gdlr_get_image($album_info['upload'], 'thumbnail') . '</div>';
				$ret .= '<ol class="gdlr-album-list">';
				$args = array('post_type' => 'song', 'suppress_filters' => false, 'posts_per_page' => 100, 
					'orderby' => 'post_date', 'order' => 'desc');
				$args['tax_query'] = array( array('terms'=>$album->slug, 'taxonomy'=>'album', 'field'=>'slug') );	
				$query = new WP_Query( $args );		
				while($query->have_posts()){ $query->the_post(); 
					$post_option = json_decode(gdlr_decode_preventslashes(get_post_meta(get_the_ID(), 'post-option', true)), true);
					
					$ret .= '<li ';
					$ret .= gdlr_print_download_link($post_option['download-link'], $post_option['apple-store'], $post_option['amazon-link'], 'attr');
					$ret .= gdlr_print_audio_link($post_option['mp3'], $post_option['ogg'], $post_option['wav'], 'attr');
					$ret .= '>' . gdlr_get_full_song_title($post_option) . '</li>';
				}
				$ret .= '</ol>';
				$ret .= '</div>'; // album-content
				
				$ret .= '</div>'; // gdlr-item
				$ret .= '</div>'; // column class
				
				$current_size++;
			}
			$ret .= '<div class="clear"></div>';
			
			return $ret;
		}
	}
	
	// print carousel album
	if( !function_exists('gdlr_print_album_carousel') ){
		function gdlr_print_album_carousel( $album_list, $size, $thumbnail_size ){
			$album_meta = get_option('gdlr_album_meta', array());
			
			$ret  = '<div class="flexslider" data-type="carousel" data-nav-container="gdlr-album-item-wrapper" data-columns="' . $size . '" >';	
			$ret .= '<ul class="slides" >';			
			foreach( $album_list as $album ){
				$album_info = $album_meta[$album->slug];
				$album_link = get_term_link($album, 'album');
				
				$ret .= '<li class="gdlr-item gdlr-album-item" >';
				$ret .= '<div class="gdlr-album-image"><a href="' . $album_link . '" >';
				$ret .= gdlr_get_image($album_info['upload'], $thumbnail_size);
				$ret .= '</a></div>';
				
				$ret .= '<div class="gdlr-album-content">';
				$ret .= '<span class="gdlr-play-album"><i class="icon-play"></i></span>';
				$ret .= '<a class="gdlr-album-title" href="' . $album_link . '" >' . $album->name . '</a>';
				$ret .= '<span class="gdlr-album-download">';
				$ret .= gdlr_print_download_link($album_info['download-link'], $album_info['apple-link'],
					$album_info['amazon-link'], 'source');
				$ret .= '</span>';
				
				// get album list
				$ret .= '<div class="gdlr-album-thumbnail" >' . gdlr_get_image($album_info['upload'], 'thumbnail') . '</div>';
				$ret .= '<ol class="gdlr-album-list">';
				$args = array('post_type' => 'song', 'suppress_filters' => false, 'posts_per_page' => 100, 
					'orderby' => 'post_date', 'order' => 'desc');
				$args['tax_query'] = array( array('terms'=>$album->slug, 'taxonomy'=>'album', 'field'=>'slug') );	
				$query = new WP_Query( $args );		
				while($query->have_posts()){ $query->the_post(); 
					$post_option = json_decode(gdlr_decode_preventslashes(get_post_meta(get_the_ID(), 'post-option', true)), true);
					
					$ret .= '<li ';
					$ret .= gdlr_print_download_link($post_option['download-link'], $post_option['apple-store'], $post_option['amazon-link'], 'attr');
					$ret .= gdlr_print_audio_link($post_option['mp3'], $post_option['ogg'], $post_option['wav'], 'attr');
					$ret .= '>' . gdlr_get_full_song_title($post_option) . '</li>';
				}
				$ret .= '</ol>';
				$ret .= '</div>'; // album-content
				$ret .= '</li>'; // gdlr-item
			}
			$ret .= '</ul>';
			$ret .= '</div>'; // flex slider
			
			return $ret;
		}
	}	
	
	// print audio link
	if( !function_exists('gdlr_print_audio_link') ){
		function gdlr_print_audio_link($mp3, $ogg, $wav, $type = 'attr'){
			$mp3 = (!empty($mp3) && is_numeric($mp3))? wp_get_attachment_url($mp3): $mp3;
			$ogg = (!empty($ogg) && is_numeric($ogg))? wp_get_attachment_url($ogg): $ogg;
			$wav = (!empty($wav) && is_numeric($wav))? wp_get_attachment_url($wav): $wav;

			if($type == 'attr'){
				$ret  = !empty($mp3)? 'data-mp3="' . $mp3 . '" ': '';
				$ret .= !empty($ogg)? 'data-ogg="' . $ogg . '" ': '';
				$ret .= !empty($wav)? 'data-wav="' . $wav . '" ': '';
			}else if($type == 'source'){
				$ret  = !empty($mp3)? '<source type="audio/mpeg" src="' . $mp3 . '">': '';
				$ret .= !empty($ogg)? '<source type="audio/ogg" src="' . $ogg . '">': '';
				$ret .= !empty($wav)? '<source type="audio/wav" src="' . $wav . '">': '';		
			}
			
			return $ret;
		}
	}
	
	// print download link
	if( !function_exists('gdlr_print_download_link') ){
		function gdlr_print_download_link($download, $apple, $amazon, $type = 'source'){
			
			if( $type == 'attr' ){
				$ret  = 'data-download="' . $download . '" ';
				$ret .= 'data-apple="' . $apple . '" ';
				$ret .= 'data-amazon="' . $amazon . '" ';			
			}else if( $type == 'source' ){
				$ret  = '<a class="top-player-download gdlr-download" target="_blank" ';
				$ret .= !empty($download)? 'href="' . $download . '" >': 'style="display: none;" >';
				$ret .= '<img src="' . GDLR_PATH . '/images/icon-download.png" alt="icon-download" />';
				$ret .= '</a>';
				
				$ret .= '<a class="top-player-apple" target="_blank" ';
				$ret .= !empty($apple)? 'href="' . $apple . '" >': 'style="display: none;" >';
				$ret .= '<img src="' . GDLR_PATH . '/images/icon-apple.png" alt="icon-download" />';
				$ret .= '</a>';
				
				$ret .= '<a class="top-player-amazon" target="_blank" ';
				$ret .= !empty($amazon)? 'href="' . $amazon . '" >': 'style="display: none;" >';
				$ret .= '<img src="' . GDLR_PATH . '/images/icon-amazon.png" alt="icon-download" />';
				$ret .= '</a>';
			}
			
			return $ret;
		}
	}
?>