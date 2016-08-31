<?php
/**
 * The template for displaying all single posts.
 *
 * @package musik
 */

get_header(); ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php if ( $post_type == 'post' ): ?>
                <?php get_template_part( 'template-parts/content-single', get_post_format() ); ?>
            <?php else: ?>
                <?php get_template_part( 'template-parts/content-single', $post_type ); ?>
            <?php endif ?>
            
		<?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>
