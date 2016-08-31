<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package musik
 */

get_header('category'); ?>
<section id="ajax-container">
    <section class="vbox">
		<section class="scrollable padder-lg">
			<header>
				<?php
					the_archive_title( '<h1 class="font-thin h2 m-t m-b">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="row">
				<div class="col-sm-9">
					<?php if ( have_posts() ) : ?>

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_format() );
							?>

						<?php endwhile; ?>

						<div class="text-center">
							<?php get_template_part( 'template-parts/pagination'); ?>
						</div>
					<?php else : ?>

						<?php get_template_part( 'template-parts/content', 'none' ); ?>

					<?php endif; ?>
				</div>
				<div class="col-sm-3">
					<?php get_sidebar('category');  ?>
				</div>
			</div>
		</section>
  	</section>
</section>
<?php get_footer('category'); ?>
