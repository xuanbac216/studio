<?php
/**
 * Template Name: Page with player
*/

get_header('page'); ?>
<section class="<?php if( get_theme_mod( 'hide-player' ) == 0 ){ echo "w-f-md";} ?>" id="ajax-container">
    <section class="vbox">
        <section class="scrollable wrapper-lg">
        	<?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'template-parts/content', 'page' ); ?>

                <?php
                    // If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;
                ?>

            <?php endwhile; // End of the loop. ?>
        </section>
    </section>
</section>
<?php get_template_part( 'template-parts/player' ); ?>
<?php get_footer('page');  ?>

