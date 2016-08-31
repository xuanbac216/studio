<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage sound-theme
 * @since sound-theme
 */

get_header(); ?>
	<?php while (have_posts()) : the_post(); ?>
        
        <?php if ( ! class_exists( 'Acf' ) ) : ?>

            <?php get_template_part( 'page-templates/content-single', 'page' ); ?>
            
            <div class="soundtheme-single-paginate-link">
                <?php paginate_links(); ?>
            </div>
            
            <!-- Page Links & Comments -->
            <div class="soundtheme-comment-form-box">
                <?php comment_form(); ?>
            </div>
        <?php else: ?>
            <!-- Content Event Single -->
            <?php if ( has_post_format( 'Chat' )) : ?>
            <?php get_template_part( 'page-templates/content-event', 'page' ); ?>
            
            <!-- Content Biography Single -->
            <?php elseif ( has_post_format( 'Aside' )) : ?>
            <?php get_template_part( 'page-templates/content-biography', 'page' ); ?>

            <!-- Content Gallery Single -->
            <?php elseif ( has_post_format( 'Gallery' )) : ?>
            <?php get_template_part( 'page-templates/content-gallery', 'page' ); ?>
            
            <!-- Content Video Single -->
            <?php elseif ( has_post_format( 'Video' )) : ?>
            <?php get_template_part( 'page-templates/content-video', 'page' ); ?>
            
            <!-- Content Music Single -->
            <?php elseif ( has_post_format( 'Audio' )) : ?>
            <?php get_template_part( 'page-templates/content-album', 'page' ); ?>
            
            <?php else : ?>
               
            <!-- Content Normal Blog Single -->
            <?php get_template_part( 'page-templates/content-single', 'page' ); ?>
            
            <?php endif; ?>

            <div class="soundtheme-single-paginate-link">
                <?php paginate_links(); ?>
            </div>
            
            <!-- Page Links & Comments -->
            <div class="soundtheme-comment-form-box">
                <?php comment_form(); ?>
            </div>
        <?php endif; ?>
        
    <?php  endwhile; ?>

<?php get_footer(); ?>