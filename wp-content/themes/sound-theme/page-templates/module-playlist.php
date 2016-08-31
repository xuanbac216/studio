<?php
	$mod_field = esc_attr( get_sub_field('mod_field'));
    $mod_title = esc_attr( get_sub_field('mod_title'));
    $mod_subtitle = esc_attr( get_sub_field('mod_subtitle'));
    $mod_post = get_sub_field('mod_selpost');
    $mod_style = esc_attr( get_sub_field('mod_style'));
    $mod_back = esc_url( get_sub_field('mod_back'));
    $mod_btntitle = esc_attr( get_sub_field('mod_btn_title'));
    $mod_btnlink = esc_url( get_sub_field('mod_btn_link'));
    $mod_other = get_sub_field('mod_selother');
    $mod_othertitle = esc_attr( get_sub_field('mod_othertitle'));
    $mod_othersub = esc_attr( get_sub_field('mod_othersub'));

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

		<div class="row soundtheme-mod-playlist" style="margin-top:60px;">
			<?php if( $mod_post ): ?>
				<?php foreach( $mod_post as $post): // variable must be called $post (IMPORTANT) ?>
		    		<?php setup_postdata($post); ?>
					<?php
						$soundtheme_artist_name = esc_attr( get_field('soundtheme_artist_name'));
						$soundtheme_album_name = esc_attr( get_field('soundtheme_album_name'));
					?>

					<div class="col-md-4">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="soundtheme-single-gallery">
								<a href="<?php the_permalink() ?>">
									<?php the_post_thumbnail( 'soundtheme-thumb-small' ); ?>
									<div class="soundtheme-hover-play"><i class="fa fa-hand-peace-o"></i></div>
								</a>
							</div>
						<?php else: ?>
							<div class="soundtheme-single-gallery">
								<a href="<?php the_permalink() ?>">
									<img src="<?php echo esc_url( get_template_directory_uri() . '/images/space.png' ); ?>" />
									<div class="soundtheme-hover-play"><i class="fa fa-hand-peace-o"></i></div>
								</a>
							</div>
						<?php endif; ?>
					</div>

					<div class="<?php if( $mod_other ): ?>col-md-4<?php else: ?>col-md-8<?php endif; ?> soundtheme-mod-playreposive">
						<div class="soundtheme-mod-detail <?php if ($mod_style == "dark"): ?> soundtheme-mod-detail-dark <?php endif; ?>">
							<?php if ($soundtheme_artist_name) : ?>
								<h1><a href="<?php the_permalink() ?>"><?php echo esc_attr( $soundtheme_artist_name); ?></a></h1>
							<?php else: ?>
								<h1><a href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a></h1>
							<?php endif; ?>
							<h2>
								<?php if ($soundtheme_album_name) : ?>
									"<?php echo esc_attr($soundtheme_album_name); ?>"
								<?php else: ?>
									"<?php echo get_the_time('d M y', $post->ID); ?>""
								<?php endif; ?>
							</h2>
						</div>

						<?php if (esc_attr( get_field('soundtheme_select_player') == "sound") ): ?>
							<div class="soundtheme-single-track">
								<div class="soundtheme-single-tracklist">
									<ol class="fap-my-playlist">
										<?php if( have_rows('soundtheme_tracklist') ): $i = 0; ?>
											<?php while( have_rows('soundtheme_tracklist') ): the_row($i++); 
												$soundtheme_pltitle = esc_attr( get_sub_field('soundtheme_pltrack_name'));
												$soundtheme_plupload = esc_url( get_sub_field('soundtheme_upload_mp'));
												$soundtheme_pllink = esc_url( get_sub_field('soundtheme_linkto_mp'));
											?>
												<li>
													<!-- SOUND THEME / TRACK -->
													<a data-music="<?php if (esc_attr( get_sub_field('soundtheme_track_files') == "upload") ): ?> <?php echo esc_url( $soundtheme_plupload ); ?> <?php elseif (esc_attr( get_sub_field('soundtheme_track_files') == "link") ): ?>  <?php echo esc_url( $soundtheme_pllink ); ?> <?php endif; ?>" title="<?php echo esc_attr( $soundtheme_pltitle); ?>" target="<?php echo get_post_permalink(); ?>">
														<?php echo esc_attr( $soundtheme_pltitle); ?>
													</a>

													<!-- SOUND THEME / DOWNLOAD -->
													<div class="soundtheme-single-download">
														<i class="fa fa-music"></i>
													</div>
												</li>
											<?php endwhile; ?>
										<?php endif; ?>			
									</ol>
									<div class="clearfix"></div>
								</div>
							</div>
						<?php elseif (esc_attr( get_field('soundtheme_select_player') == "iframe") ): ?>
							<?php
								$soundtheme_iframecode = get_field('soundtheme_iframecode');
							?>
								<div class="soundtheme-single-track">
									<div class="embed-container">
										<?php echo $soundtheme_iframecode; ?>
									</div>
								</div>
						<?php endif; ?>

					</div>
				<?php endforeach; ?>
			<?php endif; ?>

			<?php if( $mod_other ): ?>
				<div class="col-md-4">
					<div class="soundtheme-mod-detail <?php if ($mod_style == "dark"): ?> soundtheme-mod-detail-dark <?php endif; ?>">
						<?php if ($mod_othertitle) : ?>
							<h1><?php echo esc_attr( $mod_othertitle); ?></h1>
						<?php endif; ?>
						<?php if ($mod_othersub) : ?>
							<h2>"<?php echo esc_attr( $mod_othersub); ?>"</h2>
						<?php endif; ?>
					</div>

					<?php if( $mod_other ): ?>
						<?php foreach( $mod_other as $post): // variable must be called $post (IMPORTANT) ?>
				    		<?php setup_postdata($post); ?>
							<?php
								$soundtheme_artist_name = esc_attr( get_field('soundtheme_artist_name'));
								$soundtheme_album_name = esc_attr( get_field('soundtheme_album_name'));
							?>

							<div class="soundtheme-mod-others">
								<ul>
									<li>
										<?php if ( has_post_thumbnail() ) : ?>
											<a href="<?php the_permalink() ?>">
												<?php the_post_thumbnail( 'soundtheme-thumb-small' ); ?>
											</a>
										<?php else: ?>
											<a href="<?php the_permalink() ?>">
												<img src="<?php echo esc_url( get_template_directory_uri() . '/images/space.png' ); ?>" />
											</a>
										<?php endif; ?>

										<div class="soundtheme-mod-detail <?php if ($mod_style == "dark"): ?> soundtheme-mod-detail-dark <?php endif; ?>">
											<?php if ($soundtheme_artist_name) : ?>
												<h1><a href="<?php the_permalink() ?>"><?php echo esc_attr( $soundtheme_artist_name); ?></a></h1>
											<?php else: ?>
												<h1><a href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a></h1>
											<?php endif; ?>
											<h2>
												<?php if ($soundtheme_album_name) : ?>
													"<?php echo esc_attr($soundtheme_album_name); ?>"
												<?php else: ?>
													"<?php echo get_the_time('d M y', $post->ID); ?>""
												<?php endif; ?>
											</h2>
										</div>
										<div class="clearfix"></div>
									</li>
								</ul>
							</div>

						<?php endforeach; ?>
					<?php endif; ?>

				</div>
			<?php endif; ?>

			<div class="clearfix"></div>
		</div>

		<?php if ($mod_btntitle) : ?>
			<div class="row">
				<div class="col-md-4 soundtheme-mod-playreposive">
				</div>
				<div class="col-md-4">
					<div class="soundtheme-mod-bigbutton soundtheme-mod-playbtn">
						<a href="<?php echo esc_url($mod_btnlink); ?>" class="btn btn-block btn-lg <?php if ($mod_style == "dark"): ?> btn-success <?php else: ?> btn-primary <?php endif; ?>"><?php echo esc_attr($mod_btntitle); ?></a>
					</div>
				</div>
				<div class="col-md-4">
				</div>

				<div class="clearfix"></div>
			</div>
		<?php endif; ?>
	</div>
</div>
<?php wp_reset_postdata(); ?>
<?php wp_reset_query(); ?>