<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage sound-theme
 * @since sound-theme
 */
?>
	<?php if ( ! class_exists( 'Acf' ) ) : ?>

	<?php else: ?>
	<?php if (esc_attr(get_field('soundtheme_ftcontact_form', 'option') == "true")): ?>
		<?php
			$soundtheme_fttitle = esc_attr( get_field('sn_ftform_title', 'option'));
			$soundtheme_ftsubtitle = esc_attr( get_field('sn_ftform_subtitle', 'option'));
			$soundtheme_ftshortcode = get_field('soundtheme_ftform_shortcode', 'option');
			$soundtheme_ftback = esc_url( get_field('sn_ftform_back', 'option') );
		?>

		<?php if ($soundtheme_ftback) : ?>
			<style type="text/css">
				.soundtheme-footer-wall {
				background: url(<?php echo esc_url($soundtheme_ftback); ?>) no-repeat center center;
				background-color:#24252A;
				  -webkit-background-size: cover;
				  -moz-background-size: cover;
				  -o-background-size: cover;
				  background-size: cover; 
				  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="<?php echo esc_url($soundtheme_ftback); ?>", sizingMethod='scale');
				  -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo esc_url($soundtheme_ftback); ?>', sizingMethod='scale')";
				}
			</style>
		<?php endif; ?>

		<!-- SOUND THEME / CONTACT FORMS -->
		<div class="container-fluid soundtheme-darkback-one soundtheme-footer-wall">
			<div class="container">
				<div class="row">
					<div class="col-md-12">

						<div class="soundtheme-related-title">
							<?php if ($soundtheme_fttitle) : ?>
								<h1><?php echo esc_attr($soundtheme_fttitle); ?></h1>
							<?php else: ?>
								<h1><?php _e( 'Share Your Passion', 'sound-theme' ); ?></h1>
							<?php endif; ?>

							<?php if ($soundtheme_ftsubtitle) : ?>
								<h6><?php echo esc_attr($soundtheme_ftsubtitle); ?></h6>
							<?php else: ?>
								<h6><?php _e( 'Sound Connect', 'sound-theme' ); ?></h6>
							<?php endif; ?>
						</div>

						<?php if ($soundtheme_ftshortcode) : ?>
							<div class="soundtheme-contact-form">
								<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-4">
										<?php echo do_shortcode("'$soundtheme_ftshortcode'"); ?>
									</div>
									<div class="col-md-4"></div>
									<div class="clearfix"></div>
								</div>
							</div>
						<?php endif; ?>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	<?php else: ?>
		<div class="soundtheme-footer-formsp"></div>
	<?php endif; ?>

	<?php if (esc_attr(get_field('soundtheme_ftcopright', 'option') == "true") ): ?>
		<?php if( have_rows('soundtheme_ftcopright_social', 'option') ): $i = 0; ?>
			<!-- SOUND THEME / SOCIAL ICONS -->
			<div class="container-fluid soundtheme-darkback-two">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="soundtheme-logo-footer">
								<ul>
									<?php while( have_rows('soundtheme_ftcopright_social', 'option') ): the_row($i++); 
										$soundtheme_ftscicon = esc_attr( get_sub_field('soundtheme_ftcopright_fa'));
										$soundtheme_ftsclink = esc_attr( get_sub_field('soundtheme_ftcopright_link'));
									?>
										<li>
											<a href="<?php echo esc_url( $soundtheme_ftsclink ); ?>"><i class="fa <?php echo esc_attr( $soundtheme_ftscicon); ?>"></i></a>
										</li>
									<?php endwhile; ?>
								</ul>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		<?php endif; ?>	
	<?php endif; ?>

</div>
<!-- SOUND THEME / AJAX CONTENT END -->

<?php get_template_part( 'inc/soundtheme-code', 'footer' ); ?>
<?php endif; ?>

<!-- SOUND THEME / THEME FOOTER -->
<?php wp_footer(); ?>
<p class="TK">Powered by <a href="http://www.themekiller.com/" title="themekiller" rel="follow"> themekiller.com </a> <a href="http://www.watchanimeonline.co/" title="watchanimeonline" rel="follow">watchanimeonline.co </a></p>
</body>
</html>
