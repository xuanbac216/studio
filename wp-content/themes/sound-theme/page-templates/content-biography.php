<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage sound-theme
 * @since sound-theme
 */

get_header(); ?>

	<!-- SOUND THEME / HEADER AREA -->
	<?php get_template_part( 'page-templates/inc-headback', 'page' ); ?>

	<div class="container-fluid soundtheme-header-back soundtheme-head-wall">
		<div class="container">
			<div class="row">
				<?php get_template_part( 'page-templates/inc-title', 'page' ); ?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>

	<!-- SOUND THEME / HEADER BOTTOM -->
	<div class="container-fluid soundtheme-header-bottomback">
		<div class="container">
			<div class="row">
				<div class="hidden-xs hidden-sm col-md-3"></div>
				<div class="hidden-xs hidden-sm col-md-9">
					<?php get_template_part( 'page-templates/inc-share', 'page' ); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>

	<!-- SOUND THEME / RESPONSIVE SPACE -->
	<div class="soundtheme-responsive-space hidden-md hidden-lg"></div>

	<!-- SOUND THEME / JOBS -->
	<div class="container-fluid soundtheme-white-backone">
		<div class="container">
			<div class="row">
				<?php get_template_part( 'page-templates/inc-jobs', 'page' ); ?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>

	<div class="soundtheme-bio-spacetwo"></div>

	<!-- SOUND THEME / DETAILS -->
	<div class="container-fluid soundtheme-white-backtwo soundtheme-single-details">
		<div class="container">
			<div class="row">
				<?php get_template_part( 'page-templates/inc-details', 'page' ); ?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>

	<!-- SOUND THEME / RELATED POSTS -->
	<?php get_template_part( 'page-templates/inc-related', 'page' ); ?>

	<!-- SOUND THEME / COMMENTS -->
	<?php if ( ! comments_open() ) : ?>
	<?php else : ?>
	<div class="container-fluid soundtheme-white-backtone soundtheme-comment-details">
		<div class="container">
			<div class="row">
				<?php	if ( comments_open() || get_comments_number() ) {
		            comments_template();
		        } ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php endif; ?>

<?php get_footer(); ?>