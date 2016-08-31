<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage sound-theme
 * @since sound-theme
 */

get_header(); ?>
	
	<?php if ( ! class_exists( 'Acf' ) ) : ?>
		<!-- SOUND THEME / TITLES -->
		<div class="container-fluid soundtheme-header-back soundtheme-head-wall">
			<div class="container">
				<div class="row">
						<div class="col-md-12">
							<div class="soundtheme-big-title soundtheme-nothumb-title">
								<h1><?php bloginfo('name'); ?></h1>
								<h2>"<?php bloginfo('description'); ?>"</h2>
							</div>
						</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>

		<div class="container-fluid soundtheme-white-backone soundtheme-single-details soundtheme-blog-loops">
			<div class="container">
				<div class="row">
					<!-- #BLOG LIST -->
					<div class="col-md-8">
						<?php get_template_part( 'page-templates/normal-list', 'index' ); ?>
					</div>
					<!-- #SIDEBAR -->
					<div class="col-md-4">
						<div class="soundtheme-widget">
							<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
								<?php dynamic_sidebar( 'sidebar-1' ); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>

	<?php else: ?>
	<!-- SOUND THEME / HEADER AREA -->
	<?php get_template_part( 'page-templates/inc-headback-blog', 'page' ); ?>

	<!-- SOUND THEME / TITLES -->
	<div class="container-fluid soundtheme-header-back soundtheme-head-wall">
		<div class="container">
			<div class="row">
					<?php $soundtheme_blogtitle = esc_attr( get_field('soundtheme_blogsubtitle')); ?>
					<div class="col-md-12">
						<div class="soundtheme-big-title soundtheme-nothumb-title">
							<h1><?php bloginfo('name'); ?></h1>
							<h2>"<?php bloginfo('description'); ?>"</h2>
						</div>
					</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>

	<!-- SOUND THEME / HEADER BOTTOM -->
	<div class="container-fluid soundtheme-header-bottomback">
		<div class="container">
			<div class="row">
				<div class="hidden-xs hidden-sm col-md-3">
					<div class="soundtheme-mini-share-two">
						<ul>
							<li>
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="fa fa-home"></i> <?php _e( 'Home', 'sound-theme' ); ?></a>
							</li>
						</ul>
					</div>
				</div>
				<div class="hidden-xs hidden-sm col-md-9">
					<?php get_template_part( 'page-templates/inc-share', 'page' ); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>

	<!-- SOUND THEME / RESPONSIVE SPACE -->
	<div class="soundtheme-single-space"></div>

	<!-- SOUND THEME / DETAILS -->
	<div class="container-fluid soundtheme-white-backone soundtheme-single-details soundtheme-blog-loops">
		<div class="container">
			<div class="row">

				<!-- # LEFT BLOG -->
				<?php if (esc_attr( get_field('soundtheme_blog_layouts', 'option') == "left") ): ?>
					<!-- #BLOG LIST -->
					<div class="col-md-8">
						<?php get_template_part( 'page-templates/archive-blog-list', 'index' ); ?>
					</div>
					<!-- #SIDEBAR -->
					<div class="col-md-4">
						<div class="soundtheme-widget">
							<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
								<?php dynamic_sidebar( 'sidebar-1' ); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="clearfix"></div>

				<!-- # RIGHT BLOG -->
				<?php elseif (esc_attr( get_field('soundtheme_blog_layouts', 'option') == "right") ): ?>
					<!-- #SIDEBAR -->
					<div class="col-md-4">
						<div class="soundtheme-widget">
							<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
								<?php dynamic_sidebar( 'sidebar-1' ); ?>
							<?php endif; ?>
						</div>
					</div>
					<!-- #BLOG LIST -->
					<div class="col-md-8">
						<?php get_template_part( 'page-templates/archive-blog-list', 'index' ); ?>
					</div>
					<div class="clearfix"></div>

				<!-- # FULLWIDTH BLOG -->
				<?php elseif (esc_attr( get_field('soundtheme_blog_layouts', 'option') == "full") ): ?>
					<!-- #BLOG LIST -->
					<div class="col-md-12">
						<?php get_template_part( 'page-templates/archive-blog-full', 'index' ); ?>
					</div>
					<div class="clearfix"></div>

				<!-- # BIG BLOG -->
				<?php elseif (esc_attr( get_field('soundtheme_blog_layouts', 'option') == "big") ): ?>
					<!-- #BLOG LIST -->
					<div class="col-md-12">
						<?php get_template_part( 'page-templates/archive-blog-big', 'index' ); ?>
					</div>
					<div class="clearfix"></div>

				<!-- # DEFAULT BLOG -->
				<?php else: ?>
					<!-- #BLOG LIST -->
					<div class="col-md-8">
						<?php get_template_part( 'page-templates/normal-list', 'index' ); ?>
					</div>
					<!-- #SIDEBAR -->
					<div class="col-md-4">
						<div class="soundtheme-widget">
							<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
								<?php dynamic_sidebar( 'sidebar-1' ); ?>
							<?php endif; ?>
						</div>
					</div>
					<div class="clearfix"></div>
				<?php endif; ?>

			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php endif; ?>

<?php get_footer(); ?>