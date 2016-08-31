<!-- SOUND THEME / LIST -->
<div class="<?php if (get_field('soundtheme_musicshow_info') == "true"): ?> col-md-8 <?php else : ?> col-md-12 <?php endif; ?>	">
	<?php
		$soundtheme_tracklisttitle = get_field('soundtheme_sg_tracktitle');
	?>
	<div class="soundtheme-single-titles">
		<?php if ($soundtheme_tracklisttitle) : ?>
			<h1><?php echo esc_attr($soundtheme_tracklisttitle); ?></h1>
		<?php else: ?>
			<h1><?php _e( 'Jobs', 'sound-theme' ); ?></h1>
		<?php endif; ?>
	</div>

	<div class="soundtheme-bio-spaceone"></div>

	<!-- SOUND THEME / ALBUMS -->
	<div class="soundtheme-loop-list">
		<?php $soundtheme_albumcount = get_field('soundtheme_select_albums');
				$soundtheme_showalbumcount = count($soundtheme_albumcount); ?>

		<?php
			$soundtheme_jobalbum_title = get_field('soundtheme_jobalbum_title');
		?>
		<?php if ($soundtheme_jobalbum_title) : ?>
			<h1><?php echo esc_attr($soundtheme_jobalbum_title); ?> <span>(<?php echo esc_attr( $soundtheme_showalbumcount); ?>)</span></h1>
		<?php else: ?>
			
		<?php endif; ?>
		<?php 
            $soundtheme_albums = get_field('soundtheme_select_albums');
            if( $soundtheme_albums ): ?>
				<div class="soundtheme-loop-row">                        
				    <?php foreach( $soundtheme_albums as $post): // variable must be called $post (IMPORTANT) ?>
					    <?php setup_postdata($post); ?>
					    <div class="col-xs-6 col-sm-3">
					        <div class="soundtheme-post-loops">
							    <!-- #THUMB IMAGE -->
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink() ?>">
										<?php the_post_thumbnail( 'soundtheme-thumb-medium' ); ?>
										<div class="soundtheme-biography-hover"><i class="fa fa-check"></i></div>
									</a>
								<?php else: ?>
									<a href="<?php the_permalink() ?>">
										<img src="<?php echo esc_url( get_template_directory_uri() . '/images/space.png' ); ?>" />
										<div class="soundtheme-biography-hover"><i class="fa fa-check"></i></div>
									</a>
								<?php endif; ?>
					        </div>
					    </div>
				    <?php endforeach; ?> 
				</div>
			    <div class="clearfix"></div>
		    <?php wp_reset_postdata(); ?>
            <?php endif; ?>
	</div>
	<div class="clearfix"></div>

	<!-- SOUND THEME / VIDEO -->
	<div class="soundtheme-loop-list">
		<?php $soundtheme_videocount = get_field('soundtheme_select_videos');
				$soundtheme_showvideocount = count($soundtheme_videocount); ?>
		<?php
			$soundtheme_jobvideo_title = get_field('soundtheme_jobvideo_title');
		?>
		<?php if ($soundtheme_jobvideo_title) : ?>
			<h1><?php echo esc_attr($soundtheme_jobvideo_title); ?> <span>(<?php echo esc_attr( $soundtheme_showvideocount); ?>)</span></h1>
		<?php else: ?>
		<?php endif; ?>
		<?php 
            $soundtheme_videos = get_field('soundtheme_select_videos');
            if( $soundtheme_videos ): ?>
				<div class="soundtheme-loop-row">                        
				    <?php foreach( $soundtheme_videos as $post): // variable must be called $post (IMPORTANT) ?>
					    <?php setup_postdata($post); ?>
					    <div class="col-xs-6 col-sm-3">
					        <div class="soundtheme-post-loops">
							    <!-- #THUMB IMAGE -->
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink() ?>">
										<?php the_post_thumbnail( 'soundtheme-thumb-medium' ); ?>
										<div class="soundtheme-biography-hover"><i class="fa fa-check"></i></div>
									</a>
								<?php else: ?>
									<a href="<?php the_permalink() ?>">
										<img src="<?php echo esc_url( get_template_directory_uri() . '/images/space.png' ); ?>" />
										<div class="soundtheme-biography-hover"><i class="fa fa-check"></i></div>
									</a>
								<?php endif; ?>
					        </div>
					    </div>
				    <?php endforeach; ?> 
				</div>
			    <div class="clearfix"></div>
		    <?php wp_reset_postdata(); ?>
            <?php endif; ?>
	</div>
	<div class="clearfix"></div>
	
	<!-- SOUND THEME / GALLERY -->
	<div class="soundtheme-loop-list">
		<?php $soundtheme_gallerycount = get_field('soundtheme_select_gallery');
				$soundtheme_showgallerycount = count($soundtheme_gallerycount); ?>
		<?php
			$soundtheme_jobgallery_title = get_field('soundtheme_jobgallery_title');
		?>
		<?php if ($soundtheme_jobgallery_title) : ?>
			<h1><?php echo esc_attr($soundtheme_jobgallery_title); ?> <span>(<?php echo esc_attr( $soundtheme_showgallerycount); ?>)</span></h1>
		<?php else: ?>
		<?php endif; ?>
		<?php 
            $soundtheme_galleries = get_field('soundtheme_select_gallery');
            if( $soundtheme_galleries ): ?>
				<div class="soundtheme-loop-row">                        
				    <?php foreach( $soundtheme_galleries as $post): // variable must be called $post (IMPORTANT) ?>
					    <?php setup_postdata($post); ?>
					    <div class="col-xs-6 col-sm-3">
					        <div class="soundtheme-post-loops">
							    <!-- #THUMB IMAGE -->
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink() ?>">
										<?php the_post_thumbnail( 'soundtheme-thumb-medium' ); ?>
										<div class="soundtheme-biography-hover"><i class="fa fa-check"></i></div>
									</a>
								<?php else: ?>
									<a href="<?php the_permalink() ?>">
										<img src="<?php echo esc_url( get_template_directory_uri() . '/images/space.png' ); ?>" />
										<div class="soundtheme-biography-hover"><i class="fa fa-check"></i></div>
									</a>
								<?php endif; ?>
					        </div>
					    </div>
				    <?php endforeach; ?> 
				</div>
			    <div class="clearfix"></div>
		    <?php wp_reset_postdata(); ?>
            <?php endif; ?>
	</div>
	<div class="clearfix"></div>

	<!-- SOUND THEME / EVENT -->
	<div class="soundtheme-loop-list">
		<?php $soundtheme_eventcount = get_field('soundtheme_select_events');
				$soundtheme_showeventcount = count($soundtheme_eventcount); ?>
		<?php
			$soundtheme_jobevent_title = get_field('soundtheme_jobevent_title');
		?>
		<?php if ($soundtheme_jobevent_title) : ?>
			<h1><?php echo esc_attr($soundtheme_jobevent_title); ?> <span>(<?php echo esc_attr( $soundtheme_showeventcount); ?>)</span></h1>
		<?php else: ?>
		<?php endif; ?>
		<?php 
            $soundtheme_events = get_field('soundtheme_select_events');
            if( $soundtheme_events ): ?>
				<div class="soundtheme-loop-row">                        
				    <?php foreach( $soundtheme_events as $post): // variable must be called $post (IMPORTANT) ?>
					    <?php setup_postdata($post); ?>
					    <div class="col-xs-6 col-sm-3">
					        <div class="soundtheme-post-loops">
							    <!-- #THUMB IMAGE -->
								<?php if ( has_post_thumbnail() ) : ?>
									<a href="<?php the_permalink() ?>">
										<?php the_post_thumbnail( 'soundtheme-thumb-medium' ); ?>
										<div class="soundtheme-biography-hover"><i class="fa fa-check"></i></div>
									</a>
								<?php else: ?>
									<a href="<?php the_permalink() ?>">
										<img src="<?php echo esc_url( get_template_directory_uri() . '/images/space.png' ); ?>" />
										<div class="soundtheme-biography-hover"><i class="fa fa-check"></i></div>
									</a>
								<?php endif; ?>
					        </div>
					    </div>
				    <?php endforeach; ?> 
				</div>
			    <div class="clearfix"></div>
		    <?php wp_reset_postdata(); ?>
            <?php endif; ?>
		</div>
		<div class="clearfix"></div>
</div>

<?php if (get_field('soundtheme_musicshow_info') == "true"): ?>
<!-- SOUND THEME / INFO -->
<div class="col-md-4">

	<?php
		$soundtheme_sginfotitle = get_field('soundtheme_sg_infotitle');
	?>
	<div class="soundtheme-single-titles">
		<?php if ($soundtheme_sginfotitle) : ?>
			<h1><?php echo esc_attr($soundtheme_sginfotitle); ?></h1>
		<?php else: ?>
			<h1><?php _e( 'Info', 'sound-theme' ); ?></h1>
		<?php endif; ?>
	</div>

	<?php
		$soundtheme_mininame = get_field('soundtheme_miniartist_name');
		$soundtheme_miniurl = get_field('soundtheme_miniartist_pageurl');
		$soundtheme_minidate = get_field('soundtheme_minialbum_reldate');
	?>
	<div class="soundtheme-single-mininfo">
		<ul>
			<!-- # ARTIST NAME -->
			<?php if ($soundtheme_mininame) : ?>
				<li>
					<?php if ($soundtheme_miniurl) : ?>
						<a href="<?php echo esc_url($soundtheme_miniurl); ?>">
							<i class="fa fa-male"></i> <?php echo esc_attr($soundtheme_mininame); ?>
						</a>
					<?php else : ?>
						<i class="fa fa-male"></i> <?php echo esc_attr($soundtheme_mininame); ?>
					<?php endif; ?>
				</li>
			<?php endif; ?>
			<!-- # ALBUM DATE -->
			<?php if ($soundtheme_minidate) : ?>
				<li>
					<i class="fa fa-calendar-check-o"></i> <?php _e( 'Birthday:', 'sound-theme' ); ?> <span><?php echo esc_attr($soundtheme_minidate); ?></span>
				</li>
			<?php endif; ?>
			<!-- # OTHERS -->
			<?php if( have_rows('soundtheme_miniadd_info') ): $i = 0; ?>
				<?php while( have_rows('soundtheme_miniadd_info') ): the_row($i++); 
					$soundtheme_minifa = get_sub_field('soundtheme_minifa_icon');
					$soundtheme_minititles = get_sub_field('soundtheme_minititle_infos');
					$soundtheme_minisub = get_sub_field('soundtheme_minititle_sub');
				?>
				<li>
					<i class="fa <?php echo esc_attr( $soundtheme_minifa); ?>"></i> <?php echo esc_attr( $soundtheme_minititles); ?> <span><?php echo esc_attr( $soundtheme_minisub); ?></span>
				</li>
				<?php endwhile; ?>
			<?php endif; ?>	
		</ul>
	</div>
	<div class="clearfix"></div>

	<!-- SOUND THEME / BUY BUTTONS -->
	<?php if( have_rows('soundtheme_addbuy_albums') ): $i = 0; ?>
		<div class="soundtheme-single-buy">
			
			<?php
				$soundtheme_mainbtn = get_field('soundtheme_main_btntitle');
			?>
			<a href="#soundtheme-mini-buymodal" class="soundtheme-mini-link btn btn-block btn-success btn-lg">
				<?php if ($soundtheme_mainbtn) : ?> <?php echo esc_attr($soundtheme_mainbtn); ?> <?php else : ?> <?php _e( 'Buy Now', 'sound-theme' ); ?><?php endif; ?>	
			</a>

			<div id="soundtheme-mini-buymodal" class="soundtheme-mini-popup soundtheme-buy-popup mfp-hide">

				<?php while( have_rows('soundtheme_addbuy_albums') ): the_row($i++); 
					$soundtheme_buytitle = get_sub_field('soundtheme_buyalbum_title');
					$soundtheme_buylink = get_sub_field('soundtheme_buybutton_link');
					$soundtheme_buyicon = get_sub_field('soundtheme_buybutton_icon');
				?>
					<a href="<?php echo esc_url($soundtheme_buylink); ?>" class="btn btn-block btn-primary btn-lg">
						<i class="fa <?php echo esc_attr( $soundtheme_buyicon); ?>"></i> <?php echo esc_attr($soundtheme_buytitle); ?>
					</a>
				<?php endwhile; ?>

			</div>

		</div>
	<?php endif; ?>	
</div>
<?php endif; ?>	