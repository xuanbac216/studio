<?php
/**
 * Template Name: Category Masonry
*/

get_header(); ?>

<section class="<?php if( get_theme_mod( 'hide-player' ) == 0 ){ echo "w-f-md";} ?>" id="ajax-container">
    <section class="vbox">
        <section class="scrollable">
            <?php if ( have_posts() ) : ?>
                <div id="masonry" class="pos-rlt">
                    <?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php

                            /*
                             * Include the Post-Format-specific template for the content.
                             * If you want to override this in a child theme, then include a file
                             * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                             */
                            get_template_part( 'template-parts/content-simple' );
                        ?>

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

<?php get_footer( );  ?>
