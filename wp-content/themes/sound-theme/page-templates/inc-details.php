<!-- #DETAILS -->
<?php if ( ! class_exists( 'Acf' ) ) : ?>
	<div class="col-md-8">
		<div class="soundtheme-single-titles">
				<h1><?php _e( 'Details', 'sound-theme' ); ?></h1>
		</div>
		<div class="soundtheme-post-detail">
			<?php
	            the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sound-theme' ) );
	            wp_link_pages();
	        ?>
		</div>
	</div>

	<!-- #TAGS -->
	<div class="col-md-4">
		<div class="soundtheme-single-titles">
				<h1><?php _e( 'Tags', 'sound-theme' ); ?></h1>
		</div>
		<div class="soundtheme-post-tags">
			<?php the_tags('','') ?>
		</div>
	</div>
	<div class="clearfix"></div>
<?php else: ?>
	<div class="col-md-8">
		<?php
			$soundtheme_detailstitle = esc_attr( get_field('soundtheme_sg_detailtitle'));
		?>
		<div class="soundtheme-single-titles">
			<?php if ($soundtheme_detailstitle) : ?>
				<h1><?php echo esc_attr($soundtheme_detailstitle); ?></h1>
			<?php else: ?>
				<h1><?php _e( 'Details', 'sound-theme' ); ?></h1>
			<?php endif; ?>
		</div>
		<div class="soundtheme-post-detail">
			<?php
	            the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sound-theme' ) );
	            wp_link_pages();
	        ?>
		</div>
	</div>

	<!-- #TAGS -->
	<div class="col-md-4">
		<?php
			$soundtheme_tagstitle = esc_attr( get_field('soundtheme_sg_tagstitle'));
		?>
		<div class="soundtheme-single-titles">
			<?php if ($soundtheme_tagstitle) : ?>
				<h1><?php echo esc_attr($soundtheme_tagstitle); ?></h1>
			<?php else: ?>
				<h1><?php _e( 'Tags', 'sound-theme' ); ?></h1>
			<?php endif; ?>
		</div>
		<div class="soundtheme-post-tags">
			<?php the_tags('','') ?>
		</div>
	</div>
	<div class="clearfix"></div>
<?php endif; ?>