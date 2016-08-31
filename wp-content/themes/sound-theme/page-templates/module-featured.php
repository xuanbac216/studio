<?php
	$mod_field = esc_attr( get_sub_field('mod_field'));
    $mod_title = esc_attr( get_sub_field('mod_title'));
    $mod_subtitle = esc_attr( get_sub_field('mod_subtitle'));
    $mod_post = get_sub_field('mod_selpost');
    $mod_style = esc_attr( get_sub_field('mod_style'));
    $mod_back = esc_url( get_sub_field('mod_back'));

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
		<div class="row">
			<?php if ($mod_title) : ?>
				<div class="col-md-12">
					<div class="soundtheme-mod-title <?php if ($mod_style == "dark"): ?> soundtheme-mod-title-dark <?php endif; ?>">
						<h1><?php echo esc_attr($mod_title); ?> </h1>
						<?php if ($mod_subtitle) : ?>
							<h2><?php echo esc_attr($mod_subtitle); ?></h2>
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>

			<div class="clearfix"></div>

			<?php if( $mod_post ): ?>
				<div id="soundtheme-module-featured" class="util-carousel team-showcase soundtheme-mod-featcon">
					<?php foreach( $mod_post as $post): // variable must be called $post (IMPORTANT) ?>
			    		<?php setup_postdata($post); ?>
						<?php
							$soundtheme_artist_name = esc_attr( get_field('soundtheme_artist_name'));
							$soundtheme_album_name = esc_attr( get_field('soundtheme_album_name'));
							$soundtheme_genre = esc_attr( get_field('soundtheme_music_genre'));
						?>
						<div class="item">
							<div class="meida-holder soundtheme-mod-thumb">
								<?php if ( has_post_thumbnail() ) : ?>
									<div class="soundtheme-single-gallery">
										<a href="<?php the_permalink() ?>">
											<?php the_post_thumbnail( 'soundtheme-thumb-medium' ); ?>
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
						</div>
					<?php endforeach; ?> 
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php wp_reset_postdata(); ?>
<?php wp_reset_query(); ?>