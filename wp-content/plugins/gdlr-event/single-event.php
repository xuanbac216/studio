<?php get_header(); ?>
<div class="gdlr-content">

	<?php 
		global $gdlr_sidebar, $theme_option;
		if( empty($gdlr_post_option['sidebar']) || $gdlr_post_option['sidebar'] == 'default-sidebar' ){
			$gdlr_sidebar = array(
				'type'=>$theme_option['post-sidebar-template'],
				'left-sidebar'=>$theme_option['post-sidebar-left'], 
				'right-sidebar'=>$theme_option['post-sidebar-right']
			); 
		}else{
			$gdlr_sidebar = array(
				'type'=>$gdlr_post_option['sidebar'],
				'left-sidebar'=>$gdlr_post_option['left-sidebar'], 
				'right-sidebar'=>$gdlr_post_option['right-sidebar']
			); 				
		}
		$gdlr_sidebar = gdlr_get_sidebar_class($gdlr_sidebar);
	?>
	<div class="with-sidebar-wrapper">
		<div class="with-sidebar-container container gdlr-class-<?php echo $gdlr_sidebar['type']; ?>">
			<div class="with-sidebar-left <?php echo $gdlr_sidebar['outer']; ?> columns">
				<div class="with-sidebar-content <?php echo $gdlr_sidebar['center']; ?> columns">
					<div class="gdlr-item gdlr-single-event gdlr-item-start-content">
					<?php while ( have_posts() ){ the_post(); ?>
					
						<div id="event-<?php the_ID(); ?>" <?php post_class(); ?>>
							<div class="gdlr-event-info-wrapper">
								<?php 
									$thumbnail = get_post_thumbnail_id();
									if(!empty($thumbnail)){
										echo '<div class="gdlr-event-thumbnail">';
										echo gdlr_get_image($thumbnail, 'full');
										echo '</div>';
									}
									
									// event info
									echo '<div class="gdlr-event-info">';
									if( !empty($gdlr_post_option['date']) ){
										$event_date = strtotime($gdlr_post_option['date'] . 'T00:00:00');
										echo '<div class="gdlr-info-date gdlr-info">';
										echo '<span class="gdlr-head">' . __('Date :', 'gdlr-event') . '</span> ';
										echo date_i18n($theme_option['date-format'], $event_date);
										echo '</div>';
									}
									
									if( !empty($gdlr_post_option['time']) ){
										echo '<div class="gdlr-info-time gdlr-info">';
										echo '<span class="gdlr-head">' . __('Time :', 'gdlr-event') . '</span> ';
										echo $gdlr_post_option['time'];
										echo '</div>';
									}
									
									if( !empty($gdlr_post_option['address']) ){
										echo '<div class="gdlr-info-time gdlr-info">';
										echo '<span class="gdlr-head">' . __('Address :', 'gdlr-event') . '</span> ';
										echo $gdlr_post_option['address'];
										echo '</div>';
									}
									
									if( !empty($gdlr_post_option['number']) ){
										echo '<div class="gdlr-info-time gdlr-info">';
										echo '<span class="gdlr-head">' . __('Tel :', 'gdlr-event') . '</span> ';
										echo $gdlr_post_option['number'];
										echo '</div>';
									}
									echo '</div>';
									
									echo gdlr_get_event_status($gdlr_post_option);
									
									// share this event
									gdlr_get_social_shares(__('Share This Event', 'gdlr-event'));
								?>							
							</div>							
							<div class="gdlr-event-content-wrapper">
								<?php 
									if( !empty($gdlr_post_option['map']) ){
										echo '<div class="gdlr-event-map">';
										echo gdlr_text_filter($gdlr_post_option['map']);
										echo '</div>';
									}
								?>
								<h1 class="gdlr-event-title"><?php the_title(); ?></h1>
								<div class="gdlr-event-location">
									<?php echo $gdlr_post_option['location']; ?>
								</div>
								<div class="gdlr-event-content">
								<?php 
									the_content(); 
									wp_link_pages( array( 
										'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'gdlr-event' ) . '</span>', 
										'after' => '</div>', 
										'link_before' => '<span>', 
										'link_after' => '</span>' ));
								?>
								</div>	
							</div>	
							<div class="clear"></div>
						</div>
						<?php //  ?>
						
						<div class="clear"></div>
						<?php 
							// print event comment
							if( $theme_option['enable-event-comment'] == 'enable' ){
								comments_template( '', true ); 
							} 							
						?>		
						
					<?php } ?>
					</div>

				</div>
				<?php get_sidebar('left'); ?>
				<div class="clear"></div>
			</div>
			<?php get_sidebar('right'); ?>
			<div class="clear"></div>
		</div>				
	</div>				

</div><!-- gdlr-content -->
<?php get_footer(); ?>