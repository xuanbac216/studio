<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage sound-theme
 * @since sound-theme
 */
?>

	<div class="col-md-12">
		<div class="soundtheme-content-none">
			<div class="soundtheme-content-block">
				<h1><i class="fa fa-cog fa-spin"></i> <?php _e( 'Nothing Found', 'sound-theme' ); ?></h1>
			</div>

			<div class="soundtheme-content-block">
				<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
					<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'sound-theme' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
				<?php elseif ( is_search() ) : ?>
					<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'sound-theme' ); ?></p>
				<?php else : ?>
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'sound-theme' ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>

	<div class="clearfix"></div>