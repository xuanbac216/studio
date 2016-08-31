<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage sound-theme
 * @since sound-theme
 */

get_header(); ?>
	
	<div class="soundtheme-nopage">
		<div class="col-md-12">
			<div class="soundtheme-content-none">
				<div class="soundtheme-content-block">
					<h1><i class="fa fa-cog fa-spin"></i> <?php _e( 'Oops! That page can&rsquo;t be found.', 'sound-theme' ); ?></h1>
				</div>

				<div class="soundtheme-content-block">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'sound-theme' ); ?></p>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>
	</div>

<?php get_footer(); ?>
