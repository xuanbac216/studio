<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package musik
 */

get_header(); ?>

	<section class="scrollable padder-lg">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="font-thin h2 m-t m-b"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'musik' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'musik' ); ?></p>

				<?php get_search_form(); ?>

			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</section>

<?php get_footer(); ?>
