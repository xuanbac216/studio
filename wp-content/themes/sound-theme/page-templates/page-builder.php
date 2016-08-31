<?php
/**
 * Template Name: Page Builder
 *
 * @package WordPress
 * @subpackage sound-theme
 * @since sound-theme
 */

get_header(); ?>

	<!-- SOUND THEME / MODULE SLIDER -->
	<?php get_template_part( 'page-templates/module-slider', 'page' ); ?>

	<!-- SOUND THEME / BUILDER START -->
	<?php while(has_sub_field("soundtheme_modules")): ?>		
		
		<!-- SOUND THEME / FEATURED SLIDER -->
		<?php if(get_row_layout("sound-theme_modul_builder") == "mod_featured_slider"): ?>
			<?php get_template_part( 'page-templates/module-featured', 'page' ); ?>

		<!-- SOUND THEME / EVENT LIST -->
		<?php elseif(get_row_layout("sound-theme_modul_builder") == "mod_event"): ?>
			<?php get_template_part( 'page-templates/module-event', 'page' ); ?>

		<!-- SOUND THEME / PLAYLIST -->
		<?php elseif(get_row_layout("sound-theme_modul_builder") == "mod_playlist"): ?>
			<?php get_template_part( 'page-templates/module-playlist', 'page' ); ?>

		<!-- SOUND THEME / GALLERY -->
		<?php elseif(get_row_layout("sound-theme_modul_builder") == "mod_gallery"): ?>
			<?php get_template_part( 'page-templates/module-gallery', 'page' ); ?>

		<!-- SOUND THEME / VIDEO -->
		<?php elseif(get_row_layout("sound-theme_modul_builder") == "mod_video"): ?>
			<?php get_template_part( 'page-templates/module-video', 'page' ); ?>

		<!-- SOUND THEME / NEWS -->
		<?php elseif(get_row_layout("sound-theme_modul_builder") == "mod_news"): ?>
			<?php get_template_part( 'page-templates/module-news', 'page' ); ?>

		<!-- SOUND THEME / BIG NEWS -->
		<?php elseif(get_row_layout("sound-theme_modul_builder") == "mod_bignews"): ?>
			<?php get_template_part( 'page-templates/module-bignews', 'page' ); ?>

		<?php endif; ?>
	<?php endwhile; ?> 
<?php get_footer(); ?>