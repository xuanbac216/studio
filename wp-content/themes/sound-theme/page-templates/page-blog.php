<?php
/**
 * Template Name: Blog Page Builder
 *
 * @package WordPress
 * @subpackage sound-theme
 * @since sound-theme
 */

get_header(); ?>

	<!-- SOUND THEME / HEADER AREA -->
	<?php get_template_part( 'page-templates/inc-headback-blog', 'page' ); ?>

	<!-- SOUND THEME / TITLES -->
	<div class="container-fluid soundtheme-header-back soundtheme-head-wall">
		<div class="container">
			<div class="row">
					<?php $soundtheme_blogtitle = esc_attr( get_field('soundtheme_blogsubtitle')); ?>
					<div class="col-md-12">
						<div class="soundtheme-big-title soundtheme-nothumb-title">
							<h1><?php echo get_the_title(); ?></h1>
							<?php if ($soundtheme_blogtitle) : ?>
								<h2><?php echo esc_attr($soundtheme_blogtitle); ?></h2>
							<?php endif; ?>
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
						<?php get_template_part( 'page-templates/inc-blog-list', 'page' ); ?>
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
						<?php get_template_part( 'page-templates/inc-blog-list', 'page' ); ?>
					</div>
					<div class="clearfix"></div>

				<!-- # FULLWIDTH BLOG -->
				<?php elseif (esc_attr( get_field('soundtheme_blog_layouts', 'option') == "full") ): ?>
					<!-- #BLOG LIST -->
					<div class="col-md-12">
						<?php get_template_part( 'inc-blog-full', 'page' ); ?>
					</div>
					<div class="clearfix"></div>

				<!-- # BIG BLOG -->
				<?php elseif (esc_attr( get_field('soundtheme_blog_layouts', 'option') == "big") ): ?>
					<!-- #BLOG LIST -->
					<div class="col-md-12">
						<?php get_template_part( 'page-templates/inc-blog-big', 'page' ); ?>
					</div>
					<div class="clearfix"></div>

				<!-- # DEFAULT BLOG -->
				<?php else: ?>
					<!-- #BLOG LIST -->
					<div class="col-md-8">
						<?php get_template_part( 'page-templates/inc-blog-list', 'page' ); ?>
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

<?php get_footer(); ?>