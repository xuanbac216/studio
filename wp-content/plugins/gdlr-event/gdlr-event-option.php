<?php
	/*	
	*	Goodlayers Event Option file
	*	---------------------------------------------------------------------
	*	This file creates all event options and attached to the theme
	*	---------------------------------------------------------------------
	*/
	
	// add a event option to event page
	if( is_admin() ){ add_action('after_setup_theme', 'gdlr_create_event_options'); }
	if( !function_exists('gdlr_create_event_options') ){
	
		function gdlr_create_event_options(){
			global $gdlr_sidebar_controller;
			
			if( !class_exists('gdlr_page_options') ) return;
			new gdlr_page_options( 
				
				// page option attribute
				array(
					'post_type' => array('event'),
					'meta_title' => __('Goodlayers Event Option', 'gdlr-event'),
					'meta_slug' => 'goodlayers-page-option',
					'option_name' => 'post-option',
					'position' => 'normal',
					'priority' => 'high',
				),
					  
				// page option settings
				array(
					'page-layout' => array(
						'title' => __('Page Layout', 'gdlr-event'),
						'options' => array(
								'sidebar' => array(
									'type' => 'radioimage',
									'options' => array(
										'no-sidebar'=>GDLR_PATH . '/include/images/no-sidebar-2.png',
										'both-sidebar'=>GDLR_PATH . '/include/images/both-sidebar-2.png', 
										'right-sidebar'=>GDLR_PATH . '/include/images/right-sidebar-2.png',
										'left-sidebar'=>GDLR_PATH . '/include/images/left-sidebar-2.png'
									),
									'default' => 'no-sidebar'
								),	
								'left-sidebar' => array(
									'title' => __('Left Sidebar' , 'gdlr-event'),
									'type' => 'combobox',
									'options' => $gdlr_sidebar_controller->get_sidebar_array(),
									'wrapper-class' => 'sidebar-wrapper left-sidebar-wrapper both-sidebar-wrapper'
								),
								'right-sidebar' => array(
									'title' => __('Right Sidebar' , 'gdlr-event'),
									'type' => 'combobox',
									'options' => $gdlr_sidebar_controller->get_sidebar_array(),
									'wrapper-class' => 'sidebar-wrapper right-sidebar-wrapper both-sidebar-wrapper'
								),						
						)
					),
					
					'page-option' => array(
						'title' => __('Page Option', 'gdlr-event'),
						'options' => array(
							'page-title' => array(
								'title' => __('Page Title' , 'gdlr-event'),
								'type' => 'text'
							),	
							'page-caption' => array(
								'title' => __('Page Caption' , 'gdlr-event'),
								'type' => 'textarea'
							),						
							'header-icon' => array(
								'title' => __('Header Icon' , 'gdlr-event'),
								'type' => 'text'
							),								
							'header-background' => array(
								'title' => __('Header Background Image' , 'gdlr-event'),
								'button' => __('Upload', 'gdlr-event'),
								'type' => 'upload'
							),	
							'map' => array(
								'title' => __('Map' , 'gdlr-event'),
								'type' => 'textarea'
							),
							'location' => array(
								'title' => __('Location' , 'gdlr-event'),
								'type' => 'text',
								'wrapper-class' => 'gdlr-top-divider'
							),
							'date' => array(
								'title' => __('Date' , 'gdlr-event'),
								'type' => 'date-picker'
							),
							'time' => array(
								'title' => __('Time' , 'gdlr-event'),
								'type' => 'text'
							),
							'address' => array(
								'title' => __('Address' , 'gdlr-event'),
								'type' => 'textarea'
							),
							'number' => array(
								'title' => __('Telephone Number' , 'gdlr-event'),
								'type' => 'text'
							),
							'email' => array(
								'title' => __('Email' , 'gdlr-event'),
								'type' => 'text'
							),
							'status' => array(
								'title' => __('Ticket Status' , 'gdlr-event'),
								'type' => 'combobox',
								'options' => array(
									'buy-now'=> __('Buy Tickets' , 'gdlr-event'),
									'sold-out'=> __('Sold Out' , 'gdlr-event'),
									'cancelled'=> __('Cancelled' , 'gdlr-event'),
									'coming-soon'=> __('Coming Soon' , 'gdlr-event'),
									'on-sale'=> __('On Sale' , 'gdlr-event'),
									'custom'=> __('Custom Text' , 'gdlr-event'),
								)
							),
							'buy-now' => array(
								'title' => __('Buy Now Button URL' , 'gdlr-event'),
								'type' => 'text',
								'wrapper-class' => 'status-wrapper buy-now-wrapper'
							),	
							'on-sale' => array(
								'title' => __('On Sale Date / Custom Text' , 'gdlr-event'),
								'type' => 'text',
								'wrapper-class' => 'status-wrapper on-sale-wrapper custom-wrapper'
							),							
						
								
						)
					),

				)
			);
			
		}
	}	
	
	// add event in page builder area
	add_filter('gdlr_page_builder_option', 'gdlr_register_event_item');
	if( !function_exists('gdlr_register_event_item') ){
		function gdlr_register_event_item( $page_builder = array() ){
			global $gdlr_spaces;
		
			$page_builder['content-item']['options']['event'] = array(
				'title'=> __('Event', 'gdlr-event'), 
				'type'=>'item',
				'options'=>array(		
					'title-type'=> array(	
						'title'=> __('Title Type' ,'gdlr-event'),
						'type'=> 'combobox',
						'options'=> array(
							'none'=> __('None' ,'gdlr-event'),
							'left'=> __('Left Align With Caption' ,'gdlr-event'),
							'center'=> __('Center Align With Caption' ,'gdlr-event')
						)
					),										
					'title'=> array(	
						'title'=> __('Title' ,'gdlr-event'),
						'type'=> 'text',
						'wrapper-class'=>'title-type-wrapper left-wrapper center-wrapper no-caption-wrapper'
					),			
					'caption'=> array(	
						'title'=> __('Caption' ,'gdlr-event'),
						'type'=> 'textarea',
						'wrapper-class'=>'title-type-wrapper left-wrapper center-wrapper'
					),	
					'right-text'=> array(	
						'title'=> __('Titlte Right Text' ,'gdlr-event'),
						'type'=> 'text',
						'default'=> __('View All Events', 'gdlr-event'),
						'wrapper-class'=>'title-type-wrapper left-wrapper center-wrapper no-caption-wrapper'
					),	
					'right-text-link'=> array(	
						'title'=> __('Title Right Text Link' ,'gdlr-event'),
						'type'=> 'text',
						'wrapper-class'=>'title-type-wrapper left-wrapper center-wrapper no-caption-wrapper'
					),					
					'category'=> array(
						'title'=> __('Category' ,'gdlr-event'),
						'type'=> 'multi-combobox',
						'options'=> gdlr_get_term_list('event_category'),
						'description'=> __('You can use Ctrl/Command button to select multiple categories or remove the selected category. <br><br> Leave this field blank to select all categories.', 'gdlr-event')
					),	
					'tag'=> array(
						'title'=> __('Tag' ,'gdlr-event'),
						'type'=> 'multi-combobox',
						'options'=> gdlr_get_term_list('event_tag')
					),					
					'event-style'=> array(
						'title'=> __('Event Style' ,'gdlr-event'),
						'type'=> 'combobox',
						'options'=> array(
							'widget-style' => __('Widget Style', 'gdlr-event'),
							'list-style' => __('List Style', 'gdlr-event'),
							'list-by-month' => __('List By Month Style', 'gdlr-event')
						),
					),
					'num-fetch'=> array(
						'title'=> __('Num Fetch' ,'gdlr-event'),
						'type'=> 'text',	
						'default'=> '8',
						'description'=> __('Specify the number of events you want to pull out on each page.', 'gdlr-event')
					),	
					'orderby'=> array(
						'title'=> __('Order By' ,'gdlr-event'),
						'type'=> 'combobox',
						'options'=> array(
							'date' => __('Event Date', 'gdlr-event'), 
							'title' => __('Title', 'gdlr-event'), 
							'rand' => __('Random', 'gdlr-event'), 
						)
					),
					'order'=> array(
						'title'=> __('Order' ,'gdlr-event'),
						'type'=> 'combobox',
						'options'=> array(
							'desc'=>__('Descending Order', 'gdlr-event'), 
							'asc'=> __('Ascending Order', 'gdlr-event'), 
						)
					),			
					'past-event'=> array(
						'title'=> __('Show Past Event' ,'gdlr-event'),
						'type'=> 'checkbox',
						'default'=> 'enable'
					)
					,'pagination'=> array(
						'title'=> __('Enable Pagination' ,'gdlr-event'),
						'type'=> 'checkbox'
					),					
					'margin-bottom' => array(
						'title' => __('Margin Bottom', 'gdlr-event'),
						'type' => 'text',
						'default' => $gdlr_spaces['bottom-port-item'],
						'description' => __('Spaces after ending of this item', 'gdlr-event')
					),				
				)
			);
			
			$page_builder['content-item']['options']['event-counter'] = array(
				'title'=> __('Event Counter', 'gdlr-event'), 
				'type'=>'item',
				'options'=>array(		
					'post-name'=> array(
						'title'=> __('Select Event To Display' ,'gdlr-event'),
						'type'=> 'combobox',
						'options'=> gdlr_get_post_list('event'),
						'description'=> __('The time will correctly', 'gdlr-event')
					),					
					'margin-bottom' => array(
						'title' => __('Margin Bottom', 'gdlr-event'),
						'type' => 'text',
						'default' => $gdlr_spaces['bottom-item'],
						'description' => __('Spaces after ending of this item', 'gdlr-event')
					),		
				)
			);
			return $page_builder;
		}
	}
	
?>