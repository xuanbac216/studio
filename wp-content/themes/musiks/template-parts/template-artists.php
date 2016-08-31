<?php
/**
 * Template Name: Artists
*/

get_header(); ?>
<section class="<?php if( get_theme_mod( 'hide-player' ) == 0 ){ echo "w-f-md";} ?>" id="ajax-container">
    <section class="hbox stretch">
        <section>
            <section class="vbox">
                <section class="scrollable wrapper-lg">
                    <div class="row">
                        <div class="col-sm-9">    
                            <?php the_title( '<h1 class="h2 m-b-md m-t-none font-thin">', '</h1>' ); ?>
                            <?php
                            $size = get_theme_mod( 'artist-pagesize' ) ? get_theme_mod( 'artist-pagesize' ) : '12';
                            the_widget( 'music_term_widget', 'taxonomy=download_artist&display=grid&widget=false&hide_empty=off&pagination=on&count='.$size );?>
                        </div>
                        <div class="col-sm-3">
                            <?php dynamic_sidebar( 'artist-sidebar' ); ?>
                        </div>
                    </div>
                </section>
            </section>
        </section>
    </section>
</section>
<?php get_template_part( 'template-parts/player' ); ?>
<?php get_footer( );  ?>

