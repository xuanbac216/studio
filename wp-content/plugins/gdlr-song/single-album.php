<?php get_header(); ?>
<div class="gdlr-content">

	<?php 
		global $gdlr_sidebar, $theme_option;

		$album_meta = get_option('gdlr_album_meta', array());
		$album_info = $album_meta[get_query_var('album')];		

		if( empty($album_info['sidebar']) ){
			$album_info['sidebar'] = 'no-sidebar';
			$album_info['left-sidebar'] = '';
			$album_info['right-sidebar'] = '';
		}
		
		$gdlr_sidebar = array(
			'type'=>$album_info['sidebar'],
			'left-sidebar'=>$album_info['left-sidebar'], 
			'right-sidebar'=>$album_info['right-sidebar']
		); 				
		$gdlr_sidebar = gdlr_get_sidebar_class($gdlr_sidebar);

	?>
	<div class="with-sidebar-wrapper">
		<div class="with-sidebar-container container">
			<div class="with-sidebar-left <?php echo $gdlr_sidebar['outer']; ?> columns">
				<div class="with-sidebar-content <?php echo $gdlr_sidebar['center']; ?> columns">
					<div class="gdlr-item gdlr-single-album gdlr-item-start-content">
						<div class="gdlr-album-info-wrapper">
							<div class="gdlr-album-thumbnail">
							<?php echo gdlr_get_image($album_info['upload'], 'full'); ?>
							</div>
							<h3 class="gdlr-album-title"><?php echo single_cat_title('',false); ?></h3>
							<div class="gdlr-album-info">
								<?php if(!empty($album_info['genre'])){ ?>
								<div class="gdlr-album-genre">
									<span class="gdlr-head"><?php _e('Genre :', 'gdlr-song'); ?></span>
									<?php echo $album_info['genre']; ?>
								</div>
								<?php } ?>
								<?php if(!empty($album_info['date'])){ ?>
								<div class="gdlr-album-date">
									<span class="gdlr-head"><?php _e('Released Date :', 'gdlr-song'); ?></span> 
									<?php 
										$album_info['date'] = strtotime($album_info['date'] . 'T00:00:00');	
										echo date_i18n($theme_option['date-format'], $album_info['date']);
									?>
								</div>
								<?php } ?>
							</div>
							<?php 
								// album download link
								echo '<div class="gdlr-album-download">';
								echo gdlr_print_download_link($album_info['download-link'], $album_info['apple-link'],
									$album_info['amazon-link'], 'source');
								echo '</div>';

								// share this album
								gdlr_get_social_shares(__('Share This Album', 'gdlr-song'));
							?>
						</div>
						<div class="gdlr-album-content" >
							<?php
								$args = array('post_type' => 'song', 'suppress_filters' => false, 'posts_per_page' => 100, 
									'orderby' => 'post_date', 'order' => 'desc');
								$args['tax_query'] = array( array('terms'=>get_query_var('album'), 'taxonomy'=>'album', 'field'=>'slug') );	
								$query = new WP_Query( $args );		
								
								echo '<ol class="gdlr-album-song-list">';	
								while($query->have_posts()){ $query->the_post(); 		
									$post_option = json_decode(gdlr_decode_preventslashes(get_post_meta(get_the_ID(), 'post-option', true)), true);
								
									echo '<li>';
									echo '<span class="gdlr-list-icon"></span>';
									echo get_the_title();
									echo '<div class="gdlr-album-song-download">';
									echo gdlr_print_download_link($post_option['download-link'], 
										$post_option['apple-store'], $post_option['amazon-link'], 'source');
									echo '</div>';
									echo '</li>';										
								}
								echo '</ol>';
							?>
							<?php if(!empty($album_info['content'])){ echo gdlr_content_filter($album_info['content']); }?>
						</div>
						<div class="clear"></div>
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