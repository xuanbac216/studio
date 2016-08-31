<?php

if ( ! have_posts() ) {
    get_template_part( '404' );
}

get_header( ); ?>

    <section class="scrollable padder-lg">
            
            <?php if ( have_posts() ) : ?>
                
                <?php do_action( 'digitalstore_before_template_header' ); ?>
                
                <header class="page-header">
                    <h1 class="font-thin h2 m-t m-b"><?php single_term_title(); ?></h1>
                
                    <?php
                        $term_description = term_description();
                        if ( isset( $term_description ) ) 
                        echo apply_filters( 'term_archive_meta', '<div class="intro-meta">' .  $term_description . '</div>' );
                    ?>
                </header>
                        
                <?php while ( have_posts() ) : the_post(); ?>
                
                    <?php get_template_part( 'content', get_post_format() ); ?>
                
                <?php endwhile; ?>
                
                <?php get_template_part( 'pagination' ); ?>
                
            <?php else: ?>
                
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
                    
            <?php endif; ?>

    </section>
<?php get_footer( ); ?>
