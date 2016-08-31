<?php
/**
 * The template for displaying Tag pages
 *
 * Used to display archive-type pages for posts in a tag.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage sound-theme
 * @since sound-theme
 */

get_header(); ?>

<?php get_template_part( 'page-templates/archive-tag', 'page' ); ?>

<?php
get_footer();