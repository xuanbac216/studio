<?php
/**
 * Downloads Artist Template
*/

get_header(); ?>

<section class="<?php if( get_theme_mod( 'hide-player' ) == 0 ){ echo "w-f-md";} ?>" id="ajax-container">
    <section class="hbox stretch">
        <section>
            <section class="vbox">
                <section class="scrollable wrapper-lg">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="panel wrapper-md">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <?php 
                                        $term_id  = get_queried_object()->term_id;
                                        $photoid  = get_term_meta($term_id, 'photo', true);
                                        $photourl = wp_get_attachment_image_src($photoid, 'medium');
                                        if ( $photourl ): ?>
                                            <img src="<?php echo esc_url($photourl[0]); ?>" alt="<?php echo esc_attr(single_term_title('',false)); ?>" class="img-full m-b"/>
                                        <?php else: ?>
                                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/default_300_300.jpg" alt="<?php echo esc_attr(single_term_title('',false)); ?>" class="img-full m-b"/>
                                        <?php endif ?>
                                    </div>
                                    <div class="col-sm-8">
                                        <h1 class="m-t-none m-b text-black h2"><?php single_term_title(); ?></h1>
                                        <?php
                                             echo term_description();
                                             echo do_shortcode(wpautop(get_term_meta($term_id, 'content', true)));
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php if ( have_posts() ) : ?>
                                <h3 class="m-t-none"><?php echo get_theme_mod( 'title-music', esc_html__('Music', 'musik') ); ?></h3>
                                <div class="list-group list-group-lg">
                                    <?php while ( have_posts() ) : the_post(); ?>
                                        <div class="list-group-item">
                                            <?php get_template_part( 'template-parts/content', 'download-list' ); ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>

                                <?php get_template_part( 'template-parts/pagination' ); ?>

                            <?php endif; ?>
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
