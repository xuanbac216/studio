<!-- SOUND THEME / THUMB IMAGE -->
<div class="col-md-3">
	<div id="soundtheme-thumb-image" class="soundtheme-thumb-image">					
		<div id="soundtheme-single-thumb" class="util-carousel sample-img">
			
			<!-- #THUMB IMAGE -->
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="item">
					<div class="meida-holder">
						<?php the_post_thumbnail( 'soundtheme-thumb-medium' ); ?>
					</div>
				</div>
			<?php else: ?>
				<div class="item">
					<div class="meida-holder">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/images/space.png' ); ?>" />
					</div>
				</div>
			<?php endif; ?>

			<!-- #GALLERY -->
			<?php $images = get_field('soundtheme_single_figallery'); if( $images ): ?>
            	<?php foreach( $images as $image ): ?>
					<div class="item">
						<div class="meida-holder">
							<img src="<?php echo esc_url($image['sizes']['soundtheme-thumb-medium']); ?>" alt="" />
						</div>
						<div class="hover-content">
							<div class="overlay"></div>
							<div class="link-container">
								<a href="<?php echo esc_url($image['sizes']['soundtheme-thumb-normal']); ?>" class="img-link" data-effect="mfp-3d-unfold"><i class="icon-search"></i></a>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>

<!-- SOUND THEME / TITLES -->
<?php
	$soundtheme_artist_name = esc_attr( get_field('soundtheme_artist_name'));
	$soundtheme_album_name = esc_attr( get_field('soundtheme_album_name'));
	$soundtheme_release_date = esc_attr( get_field('soundtheme_release_date'));
?>
<div class="col-md-9">
	<div class="soundtheme-big-title">
		<?php if ($soundtheme_artist_name) : ?>
			<h1><?php echo esc_attr($soundtheme_artist_name); ?></h1>
		<?php else: ?>
			<h1><?php echo get_the_title(); ?></h1>
		<?php endif; ?>

		<?php if ($soundtheme_album_name) : ?>
			<h2>"<?php echo esc_attr($soundtheme_album_name); ?>" - <?php echo esc_attr($soundtheme_release_date); ?></h2>
		<?php endif; ?>
	</div>
</div>

<div class="clearfix"></div>