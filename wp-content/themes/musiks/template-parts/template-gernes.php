<?php
/**
 * Template Name: Genres
*/

get_header(); ?>
<section class="<?php if( get_theme_mod( 'hide-player' ) == 0 ){ echo "w-f-md";} ?>" id="ajax-container">
    <section class="hbox stretch">
        <aside class="aside bg-light dk">
            <section class="vbox">
                <section class="scrollable hover hidden-xs" id="genres">
                    <?php the_widget( 'music_term_widget', 'taxonomy=download_category&display=list&widget=false&hide_empty=on&show_count=on' );?>
                </section>
            </section>
        </aside>
        <section>
            <section class="vbox">
                <section class="scrollable padder-lg" id="tracks">
                    <a href="#" class="btn btn-link visible-xs pull-right m-t" data-toggle="class:show" data-target="#genres">
                      <i class="icon-list"></i>
                    </a>
                	<h1 class="font-thin h2 m-t m-b"><?php esc_html_e('All', 'musik'); ?></h1>
                    <?php 
                        $size = get_theme_mod( 'track-pagesize' ) ? get_theme_mod( 'track-pagesize' ) : '12';
                        the_widget( 'music_post_widget', 'count='.$size.'&orderby=date&pagination=on' );
                    ?>
                </section>
            </section>
        </section>
    </section>
</section>
<?php get_template_part( 'template-parts/player' ); ?>
<?php get_footer( );  ?>
