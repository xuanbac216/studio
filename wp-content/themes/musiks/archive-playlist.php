<?php

if ( ! have_posts() ) {
    get_template_part( '404' );
}

get_header( ); ?>

<section class="<?php if( get_theme_mod( 'hide-player' ) == 0 ){ echo "w-f-md";} ?>" id="ajax-container">
	<section class="vbox">
		<section class="scrollable padder-lg">
			<header>
				<?php
					the_archive_title( '<h1 class="font-thin h2 m-t m-b">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

            <?php if ( have_posts() ) : ?>
            	<div class="row row-sm">
				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="col-sm-4 col-md-3 col-lg-2">
					<?php

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'download' );
					?>
					</div>
				<?php endwhile; ?>
				</div>
				<div class="text-center">
					<?php get_template_part( 'template-parts/pagination'); ?>
				</div>
			<?php else : ?>

				<?php get_template_part( 'template-parts/content', 'none' ); ?>

			<?php endif; ?>
		</section>
    </section>
</section>

<?php get_template_part( 'template-parts/player' ); ?>

<?php get_footer( ); ?>
