<?php
    $mod_field = esc_attr( get_sub_field('mod_field'));
    $mod_title = esc_attr( get_sub_field('mod_title'));
    $mod_subtitle = esc_attr( get_sub_field('mod_subtitle'));
    $mod_post = get_sub_field('mod_selpost');
    $mod_style = esc_attr( get_sub_field('mod_style'));
    $mod_back = esc_url( get_sub_field('mod_back'));
    $mod_btntitle = esc_attr( get_sub_field('mod_btn_title'));
    $mod_btnlink = esc_url( get_sub_field('mod_btn_link'));

?>
<?php if ($mod_back) : ?>
	<style type="text/css">
		.soundtheme-mod-<?php if ($mod_field) : ?><?php echo esc_attr($mod_field); ?><?php endif; ?> {
		background: url(<?php echo esc_url($mod_back); ?>) no-repeat center center;
		<?php if ($mod_style == "light"): ?>
		background-color:#FBFCFC;
		<?php elseif ($mod_style == "grey"): ?>
		background-color:#F4F6F7;
		<?php elseif ($mod_style == "dark"): ?>
		background-color:#24252A;
		<?php endif; ?>
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover; 
		  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo esc_url($mod_back); ?>', sizingMethod='scale');
		  -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo esc_url($mod_back); ?>', sizingMethod='scale')";
		}
	</style>
<?php endif; ?>

<div class="container-fluid soundtheme-mod-<?php if ($mod_field) : ?><?php echo esc_attr($mod_field); ?><?php endif; ?> soundtheme-container <?php if ($mod_style == "light"): ?>soundtheme-mod-light <?php elseif ($mod_style == "grey"): ?>soundtheme-mod-grey <?php elseif ($mod_style == "dark"): ?>soundtheme-mod-dark <?php endif; ?>">
	<div class="container">
		<?php if ($mod_title) : ?>
			<div class="col-md-12">
				<div class="soundtheme-mod-title <?php if ($mod_style == "dark"): ?> soundtheme-mod-title-dark <?php endif; ?>">
					<h1><?php echo esc_attr($mod_title); ?></h1>
					<?php if ($mod_subtitle) : ?>
						<h2><?php echo esc_attr($mod_subtitle); ?></h2>
					<?php endif; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="clearfix"></div>

		<?php if( $mod_post ): ?>
			<div class="soundtheme-mod-featcon-two">
				<ul class="soundtheme-event-ul">
					<?php foreach( $mod_post as $post): // variable must be called $post (IMPORTANT) ?>
			    		<?php setup_postdata($post); ?>
						<?php
							$soundtheme_artist_name = esc_attr( get_field('soundtheme_artist_name'));
							$soundtheme_album_name = esc_attr( get_field('soundtheme_album_name'));
							$soundtheme_genre = esc_attr( get_field('soundtheme_music_genre'));
							$soundtheme_button = esc_attr( get_field('soundtheme_main_btntitle'));
							$soundtheme_map = get_field('soundtheme_embed_map');
							$soundtheme_date = esc_attr( get_field('soundtheme_release_date'));
							$get_startdate = $soundtheme_date;
							$start_date = (strtotime($get_startdate));
							$start_date_pretty = date_i18n( 'd', $start_date );
							$start_date_all = date_i18n( 'M Y', $start_date );
						?>

						
						<li>
							<div class="row">
								<div class="hidden-xs col-sm-2 col-md-1">
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="soundtheme-single-gallery">
											<a href="<?php the_permalink() ?>">
												<?php the_post_thumbnail( 'soundtheme-thumb-small' ); ?>
											</a>
										</div>
									<?php else: ?>
										<div class="soundtheme-single-gallery">
											<a href="<?php the_permalink() ?>">
												<img src="<?php echo esc_url( get_template_directory_uri() . '/images/space.png' ); ?>" />
											</a>
										</div>
									<?php endif; ?>
								</div>

								<div class="hidden-xs col-sm-2 col-md-1">
									<div class="soundtheme-mod-dates <?php if ($mod_style == "dark"): ?> soundtheme-mod-detail-dark <?php endif; ?>">
										<?php if ($soundtheme_date) : ?>
											<h1><?php echo $start_date_pretty; ?></h1>
											<h2><?php echo $start_date_all; ?></h2>
										<?php else: ?>
											<h2><?php echo get_the_time('d M y', $post->ID); ?></h2>
										<?php endif; ?>
									</div>
								</div>

								<div class="col-xs-12 col-sm-3 col-md-6 soundtheme-event-title">
									<div class="soundtheme-mod-detail <?php if ($mod_style == "dark"): ?> soundtheme-mod-detail-dark <?php endif; ?>">
										<?php if ($soundtheme_artist_name) : ?>
											<h1><a href="<?php the_permalink() ?>"><?php echo esc_attr( $soundtheme_artist_name); ?></a></h1>
										<?php else: ?>
											<h1><a href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a></h1>
										<?php endif; ?>
										
										<?php if ($soundtheme_map) : ?>
											<h2><?php $map_location = $soundtheme_map; echo $map_location['address']; ?> </h2>
										<?php endif; ?>
									</div>
								</div>

								<div class="hidden-xs col-sm-2 col-md-1 soundtheme-event-price">
									<div class="soundtheme-mod-detail <?php if ($mod_style == "dark"): ?> soundtheme-mod-detail-dark <?php endif; ?>">
										<div class="soundtheme-mod-dates">
											<?php if ($soundtheme_album_name) : ?>
												<h1><?php echo esc_attr($soundtheme_album_name); ?></h1>
												<h2><?php _e( 'Price', 'sound-theme' ); ?></h2>
											<?php endif; ?>
										</div>
									</div>
								</div>

								<div class="hidden-xs hidden-sm col-md-1">
								</div>

								<div class="hidden-xs col-sm-3 col-md-2">
									<div class="soundtheme-event-btn">
										<?php if ($soundtheme_button) : ?>
						        			<a href="<?php the_permalink() ?>" class="btn btn-block btn-lg btn-success"><?php echo esc_attr( $soundtheme_button); ?></a>
						        		<?php else: ?>
						        			<a href="<?php the_permalink() ?>" class="btn btn-block btn-lg btn-success"><?php _e( 'Read More', 'sound-theme' ); ?></a>
						        		<?php endif; ?>
									</div>
								</div>
								<div class="clearfix"></div>
							</div>
						</li>

					<?php endforeach; ?>
				</ul>
			</div>
		<?php endif; ?>
		<div class="clearfix"></div>

		<?php if ($mod_btntitle) : ?>
			<div class="col-md-4">
			</div>
			<div class="col-md-4">
				<div class="soundtheme-mod-bigbutton">
					<a href="<?php echo esc_url($mod_btnlink); ?>" class="btn btn-block btn-lg <?php if ($mod_style == "dark"): ?> btn-success <?php else: ?> btn-primary <?php endif; ?>"><?php echo esc_attr($mod_btntitle); ?></a>
				</div>
			</div>
			<div class="col-md-4">
			</div>

			<div class="clearfix"></div>
		<?php endif; ?>
	</div>
</div>
<?php wp_reset_postdata(); ?>
<?php wp_reset_query(); ?>