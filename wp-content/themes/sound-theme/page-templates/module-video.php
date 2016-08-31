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

		<div class="row soundtheme-mod-videolist" style="margin-top:60px;">
			<?php if( $mod_post ): ?>
				<?php foreach( $mod_post as $post): // variable must be called $post (IMPORTANT) ?>
		    		<?php setup_postdata($post); ?>
					<?php
						$soundtheme_artist_name = esc_attr( get_field('soundtheme_artist_name'));
						$soundtheme_album_name = esc_attr( get_field('soundtheme_album_name'));
						$soundtheme_embed = get_field('soundtheme_embed_video');
					?>

					<div class="col-md-6">
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="soundtheme-single-gallery">
								<a class="soundtheme-video-popup" href="#soundtheme-video<?php the_ID(); ?>">
									<?php the_post_thumbnail( 'soundtheme-thumb-formal' ); ?>
									<div class="soundtheme-video-play"><i class="fa fa-play"></i></div>
								</a>
							</div>
						<?php else: ?>
							<div class="soundtheme-single-gallery">
								<a class="soundtheme-video-popup" href="#soundtheme-video<?php the_ID(); ?>">
									<img src="<?php echo esc_url( get_template_directory_uri() . '/images/space.png' ); ?>" />
									<div class="soundtheme-video-play"><i class="fa fa-play"></i></div>
								</a>
							</div>
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

						<div id="soundtheme-video<?php the_ID(); ?>" class="mfp-hide">
							<div class="col-md-2"></div>
							<div class="col-md-8">
							<?php if ($soundtheme_embed) : ?>
								<div class="embed-container">
									<?php echo $soundtheme_embed; ?>
								</div>
							<?php endif; ?>
							</div>
							<div class="col-md-2"></div>
						</div>
					</div>

				<?php endforeach; ?>
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