<?php
/**
 * Downloads Category Template
*/

get_header(); ?>

<section class="<?php if( get_theme_mod( 'hide-player' ) == 0 ){ echo "w-f-md";} ?>" id="ajax-container">
    <section class="hbox stretch">
        <aside class="aside bg-light dk">
            <section class="vbox">
                <section class="scrollable hover">
                    <?php the_widget( 'music_term_widget', 'taxonomy=download_tag&display=list&widget=false' );?>
                </section>
            </section>
        </aside>
        <section>
            <section class="vbox">
                <section class="scrollable padder-lg">
                    <h1 class="font-thin h2 m-t m-b"><?php single_term_title(); ?></h1>
                    
                    <?php if ( have_posts() ) : ?>

                        <div class="row row-sm">
                            <?php while ( have_posts() ) : the_post(); ?>
                                <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2">
                                    <?php get_template_part( 'template-parts/content', 'download' ); ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                        
                        <?php get_template_part( 'template-parts/pagination'); ?>

                    <?php else: ?>
                        
                        <?php get_template_part( 'template-parts/content', 'none' ); ?>
                        
                    <?php endif; ?>
                </section>
            </section>
        </section>
    </section>
</section>
<?php get_template_part( 'template-parts/player' ); ?>

<?php get_footer( );  ?>
