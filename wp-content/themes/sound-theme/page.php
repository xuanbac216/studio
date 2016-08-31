<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage sound-theme
 * @since sound-theme
 */

get_header(); ?>

<?php
    while ( have_posts() ) : the_post();
        get_template_part( 'page-templates/content-page', 'page' );
    endwhile;
?>

<?php get_footer(); ?>