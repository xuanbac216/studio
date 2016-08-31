<?php
	/*	
	*	Goodlayers Event Item Management File
	*	---------------------------------------------------------------------
	*	This file contains functions that help you create event item
	*	---------------------------------------------------------------------
	*/
	
	// add action to check for event item
	add_action('gdlr_print_item_selector', 'gdlr_check_event_item', 10, 2);
	if( !function_exists('gdlr_check_event_item') ){
		function gdlr_check_event_item( $type, $settings = array() ){
			if($type == 'event'){
				echo gdlr_print_event_item( $settings );
			}else if($type == 'event-counter'){
				echo gdlr_print_event_counter( $settings );
			}
		}
	}
	
	// print event item
	if( !function_exists('gdlr_print_event_item') ){
		function gdlr_print_event_item( $settings = array() ){
			$item_id = empty($settings['page-item-id'])? '': ' id="' . $settings['page-item-id'] . '" ';

			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-port-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';
			
			$settings['title-type'] = (empty($settings['title-type']))? 'none': $settings['title-type'];
			$settings['title'] = (empty($settings['title']))? '': $settings['title'];
			$settings['caption'] = (empty($settings['caption']))? '': $settings['caption'];	
			
			$settings['right-text'] = (empty($settings['right-text']))? '': $settings['right-text'];		
			$settings['right-text-link'] = (empty($settings['right-text-link']))? '': $settings['right-text-link'];	
			if( !empty($settings['right-text-link']) ){
				$right_text_class = ' gdlr-right-text';
				$right_text = '<a class="gdlr-right-text-link" href="' . $settings['right-text-link'] . '" >' . $settings['right-text'] . '</a>';

				$ret  = gdlr_get_item_title($settings['title-type'], $settings['title'], $settings['caption'], 
					$right_text_class, '<div class="nav-container style-1" >' . $right_text . '</div>');	
			}else{ 
				$ret  = gdlr_get_item_title($settings['title-type'], $settings['title'], $settings['caption']);	
			}
			$ret .= '<div class="event-item-wrapper" ' . $item_id . $margin_style . '>'; 
			
			// query posts section
			$args = array('post_type' => 'event', 'suppress_filters' => false);
			$args['posts_per_page'] = (empty($settings['num-fetch']))? '5': $settings['num-fetch'];
			if( empty($settings['orderby']) || $settings['orderby'] == 'date' ){
				$args['orderby'] = 'meta_value';
				$args['meta_key'] = 'gdlr-event-date';
			}else{
				$args['orderby'] = (empty($settings['orderby']))? 'post_date': $settings['orderby'];
			}
			$args['order'] = (empty($settings['order']))? 'desc': $settings['order'];
			$args['paged'] = (get_query_var('paged'))? get_query_var('paged') : get_query_var('page');
			$args['paged'] = (empty($args['paged']) || empty($settings['pagination']))? 1: $args['paged'];
			if( !empty($settings['past-event']) && $settings['past-event'] == 'disable' ){
				$current = substr(current_time('mysql'), 0, 16);
				$args['meta_query'] = array( array( 'key'=>'gdlr-event-date', 
					'value'=> $current, 'compare' => '>') );
			} 
			
			if( !empty($settings['category']) || !empty($settings['tag']) ){
				$args['tax_query'] = array('relation' => 'OR');
				
				if( !empty($settings['category']) ){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['category']), 'taxonomy'=>'event_category', 'field'=>'slug'));
				}
				if( !empty($settings['tag']) ){
					array_push($args['tax_query'], array('terms'=>explode(',', $settings['tag']), 'taxonomy'=>'event_tag', 'field'=>'slug'));
				}				
			}			
			$query = new WP_Query( $args );

			$ret .= '<div class="event-item-holder">';
			if($settings['event-style'] == 'widget-style'){		
				$ret .= gdlr_get_widget_event($query);
			}else if($settings['event-style'] == 'list-style'){
				$ret .= gdlr_get_list_event($query);
			}else{	
				$ret .= gdlr_get_list_by_month_event($query);
			}
			$ret .= '<div class="clear"></div>';
			$ret .= '</div>';
			
			// create pagination
			if( $settings['pagination'] == 'enable' ){
				$ret .= gdlr_get_pagination($query->max_num_pages, $args['paged']);
			}
			
			$ret .= '</div>'; // event-item-wrapper
			return $ret;
		}
	}
	
	// get event status
	if( !function_exists('gdlr_get_event_status') ){
		function gdlr_get_event_status( $event_option ){
			$ret  = '<div class="event-status-wrapper">';
			if( $event_option['status'] == 'buy-now' ){
				$ret .= '<a class="gdlr-button buy-now-button" href="';
				$ret .= $event_option['buy-now'];
				$ret .= '" >' . __('Buy Now' , 'gdlr-event') . '</a>';
			}else if( $event_option['status'] == 'sold-out' ){
				$ret .= '<span class="sold-out" >' . __('Sold Out' , 'gdlr-event') . '</span>';
			}else if( $event_option['status'] == 'cancelled' ){
				$ret .= '<span class="gdlr-button cancelled-button" >' . __('Cancelled' , 'gdlr-event') . '</span>';
			}else if( $event_option['status'] == 'coming-soon' ){
				$ret .= '<span class="coming-soon" >' . __('Coming Soon' , 'gdlr-event') . '</span>';
			}else if( $event_option['status'] == 'on-sale' ){
				$ret .= '<span class="on-sale" >' . __('On Sale' , 'gdlr-event') . ' ';
				$ret .= gdlr_text_filter($event_option['on-sale']) . '</span>';
			}else if( $event_option['status'] == 'custom' ){
				$ret .= '<span class="coming-soon" >';
				$ret .= gdlr_text_filter($event_option['on-sale']) . '</span>';
			}
			$ret .= '</div>';
			return $ret;
		}
	}		
	
	// print widget event
	if( !function_exists('gdlr_get_widget_event') ){
		function gdlr_get_widget_event($query){
			global $post;
			
			$ret = '';				
			while($query->have_posts()){ $query->the_post();
				$ret .= '<div class="gdlr-item gdlr-event-item gdlr-widget-event">';
				$ret .= '<div class="gdlr-ux gdlr-widget-event-ux">';
				
				$event_option = json_decode(gdlr_decode_preventslashes(get_post_meta($post->ID, 'post-option', true)), true);
				$event_date = strtotime($event_option ['date'] . 'T00:00:00');
				// event date
				$ret .= '<div class="event-date-wrapper">';
				$ret .= '<span class="event-date-day">' . date_i18n('d', $event_date) . '</span>';
				$ret .= '<span class="event-date-month">' . date_i18n('F', $event_date) . '</span>';
				$ret .= '</div>';
				
				// event content
				$ret .= '<div class="event-content-wrapper">';
				$ret .= '<div class="event-content-inner-wrapper">';
				$ret .= '<h3 class="event-title"><a href="' . get_permalink() . '" >' . get_the_title() . '</a></h3>';
				if( !empty($event_option['location']) ){
					$ret .= '<div class="event-location">' . $event_option['location'] . '</div>';
				}
				$ret .= '</div>';
				
				$ret .= gdlr_get_event_status($event_option);
				$ret .= '</div>';
				
				$ret .= '<div class="clear"></div>';
				$ret .= '</div>'; // gdlr-ux
				$ret .= '</div>'; // gdlr-item			
			}
			wp_reset_postdata();
			
			return $ret;
		}
	}	
	
	// print list event
	if( !function_exists('gdlr_get_list_event') ){
		function gdlr_get_list_event($query){
			global $post;
			
			$ret = '';				
			while($query->have_posts()){ $query->the_post();
				$ret .= '<div class="gdlr-item gdlr-event-item gdlr-list-event">';
				$ret .= '<div class="gdlr-ux gdlr-list-event-ux">';
				
				$event_option = json_decode(gdlr_decode_preventslashes(get_post_meta($post->ID, 'post-option', true)), true);
				$event_date = strtotime($event_option ['date'] . 'T00:00:00');
				// event date
				$ret .= '<div class="event-date-wrapper">';
				$ret .= '<span class="event-date-day">' . date_i18n('d', $event_date) . '</span>';
				$ret .= '<span class="separator">/</span>';
				$ret .= '<span class="event-date-month">' . date_i18n('M', $event_date) . '</span>';
				$ret .= '</div>';
				
				// event content
				$ret .= '<h3 class="event-title"><a href="' . get_permalink() . '" >' . get_the_title() . '</a></h3>';
				if( !empty($event_option['location']) ){
					$ret .= '<div class="event-location"><a href="' . get_permalink() . '" >' . $event_option['location'] . '</a></div>';
				}
				
				$ret .= gdlr_get_event_status( $event_option );
				
				$ret .= '<div class="clear"></div>';
				$ret .= '</div>'; // gdlr-ux
				$ret .= '</div>'; // gdlr-item			
			}
			wp_reset_postdata();
			
			return $ret;
		}
	}	
	
	// print list by month event
	if( !function_exists('gdlr_get_list_by_month_event') ){
		function gdlr_get_list_by_month_event($query){
			global $post;
			
			$ret = '';			
			$month = '';
			while($query->have_posts()){ $query->the_post();
				$event_option = json_decode(gdlr_decode_preventslashes(get_post_meta($post->ID, 'post-option', true)), true);
				$event_date = strtotime($event_option ['date'] . 'T00:00:00');
				
				if( $month != date_i18n('F Y', $event_date) ){
					$month = date_i18n('F Y', $event_date);
					$ret .= '<h4 class="gdlr-list-by-month-header">' . $month . '</h4>';
				}
				
				$ret .= '<div class="gdlr-item gdlr-event-item gdlr-list-event">';
				$ret .= '<div class="gdlr-ux gdlr-list-event-ux">';
				
				// event date
				$ret .= '<div class="event-date-wrapper">';
				$ret .= '<span class="event-date-day">' . date_i18n('d', $event_date) . '</span>';
				$ret .= '<span class="separator">/</span>';
				$ret .= '<span class="event-date-month">' . date_i18n('M', $event_date) . '</span>';
				$ret .= '</div>';
				
				// event content
				$ret .= '<h3 class="event-title"><a href="' . get_permalink() . '" >' . get_the_title() . '</a></h3>';
				if( !empty($event_option['location']) ){
					$ret .= '<div class="event-location"><a href="' . get_permalink() . '" >' . $event_option['location'] . '</a></div>';
				}
				
				$ret .= gdlr_get_event_status( $event_option );
				
				$ret .= '<div class="clear"></div>';
				$ret .= '</div>'; // gdlr-ux
				$ret .= '</div>'; // gdlr-item			
			}
			wp_reset_postdata();
			
			return $ret;
		}
	}	

	if( !function_exists('gdlr_date_subtract') ){
		function gdlr_date_subtract( $start_date, $end_date ){
			$diff = array();
			$diff_time = abs($start_date - $end_date);
			$diff_temp = $diff_time;
			
			$diff['day'] = floor($diff_temp / (24*60*60));
			$diff_temp = $diff_temp - ($diff['day']*24*60*60);
			
			$diff['hour'] = floor($diff_temp / (60*60));
			$diff_temp = $diff_temp - ($diff['hour']*60*60);
			
			$diff['minute'] = floor($diff_temp / 60);
			$diff_temp = $diff_temp - ($diff['minute']*60);
			
			$diff['second'] = $diff_temp;

			return $diff;
		}	
	}
	
	if( !function_exists('gdlr_print_event_counter') ){
		function gdlr_print_event_counter($settings){
			global $gdlr_spaces;
			$margin = (!empty($settings['margin-bottom']) && 
				$settings['margin-bottom'] != $gdlr_spaces['bottom-item'])? 'margin-bottom: ' . $settings['margin-bottom'] . ';': '';
			$margin_style = (!empty($margin))? ' style="' . $margin . '" ': '';		
		
			wp_enqueue_script('event-counter', plugins_url('gdlr-event-counter.js', __FILE__), array(), '1.0', true);	
		
			$event = get_posts(array('name'=>$settings['post-name'], 'post_type'=>'event', ));
			$event_option = json_decode(gdlr_decode_preventslashes(get_post_meta($event[0]->ID, 'post-option', true)), true);
			
			$event_time = substr($event_option['time'], 0,5);
			$event_date = strtotime($event_option['date'] . ' ' . $event_time);			
			$current_date = strtotime(current_time('mysql'));
			$diff_date = gdlr_date_subtract($event_date, $current_date);
			
			$ret  = '<div class="gdlr-event-counter-item gdlr-item" ' . $margin_style . '>';
			$ret .= '<h3 class="gdlr-event-counter-title">' . $event[0]->post_title . '</h3>';
			$ret .= '<div class="gdlr-event-date">' .  date_i18n('d M', $event_date) . '</div>';
			
			$ret .= '<div class="gdlr-event-counter" >';
			$ret .= '<span class="upcoming-event-day time-box"><span>' . $diff_date['day'] . '</span> ' . __('Days', 'gdl_front_end') . '</span>';
			$ret .= '<span class="upcoming-event-hour time-box"><span>' . $diff_date['hour'] . '</span> ' . __('Hrs', 'gdl_front_end') . '</span>';
			$ret .= '<span class="upcoming-event-minute time-box"><span>' . $diff_date['minute'] . '</span> ' . __('Min', 'gdl_front_end') . '</span>';
			$ret .= '<span class="upcoming-event-second time-box"><span>' . $diff_date['second'] . '</span> ' . __('Sec', 'gdl_front_end') .'</span>';	
			$ret .= '</div>';
			
			$ret .= '</div>';
			
			return $ret;
		}
	}
?>