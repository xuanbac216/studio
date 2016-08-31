<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage sound-theme
 * @since sound-theme
 */
get_header(); ?>

	<?php if ( ! class_exists( 'Acf' ) ) : ?>

		<div class="container-fluid soundtheme-header-back soundtheme-head-wall">
			<div class="container">
				<div class="row">

					<?php if ( has_post_thumbnail() ) : ?>
					<!-- SOUND THEME / THUMB IMAGE -->
					<div class="col-md-3">
						<div id="soundtheme-thumb-image" class="soundtheme-thumb-image soundtheme-single-thumb">					
							<!-- #THUMB IMAGE -->
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="item">
									<div class="meida-holder">
										<?php the_post_thumbnail( 'soundtheme-thumb-medium' ); ?>
									</div>
								</div>
							<?php else: ?>
								<div class="item">
									<div class="meida-holder">
										<img src="<?php echo esc_url( get_template_directory_uri() . '/images/space.png' ); ?>" />
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>

					<?php if ( has_post_thumbnail() ) : ?>
					<!-- SOUND THEME / TITLES -->
					<div class="col-md-9">
						<div class="soundtheme-big-title">
							<h1><?php echo get_the_title(); ?></h1>
							<h2><?php the_date(); ?></h2>
						</div>
					</div>

					<?php else: ?>
					
						<!-- SOUND THEME / TITLES -->
						<div class="col-md-12">
							<div class="soundtheme-big-title soundtheme-nothumb-title">
								<h1><?php echo get_the_title(); ?></h1>
								<h2><?php the_date(); ?></h2>
							</div>
						</div>

					<?php endif; ?>

					<div class="clearfix"></div>
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
		<div class="soundtheme-single-space"></div>

		<!-- SOUND THEME / DETAILS -->
		<div class="container-fluid soundtheme-white-backtwo soundtheme-single-details">
			<div class="container">
				<div class="row">
					<!-- #DETAILS -->
					<div class="col-md-12">
						<div class="soundtheme-post-detail" style="padding-top:60px;">
							<?php
			                    the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sound-theme' ) );
			                    wp_link_pages();
			                ?>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>

		<!-- SOUND THEME / COMMENTS -->
		<?php if ( ! comments_open() ) : ?>
		<?php else : ?>
		<div class="container-fluid soundtheme-white-backone soundtheme-comment-details">
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

	<?php else: ?>

		<!-- SOUND THEME / HEADER AREA -->
		<?php get_template_part( 'page-templates/inc-headback', 'page' ); ?>

		<div class="container-fluid soundtheme-header-back soundtheme-head-wall">
			<div class="container">
				<div class="row">

					<?php if ( has_post_thumbnail() ) : ?>
					<!-- SOUND THEME / THUMB IMAGE -->
					<div class="col-md-3">
						<div id="soundtheme-thumb-image" class="soundtheme-thumb-image soundtheme-single-thumb">					
							<!-- #THUMB IMAGE -->
							<?php if ( has_post_thumbnail() ) : ?>
								<div class="item">
									<div class="meida-holder">
										<?php the_post_thumbnail( 'soundtheme-thumb-medium' ); ?>
									</div>
								</div>
							<?php else: ?>
								<div class="item">
									<div class="meida-holder">
										<img src="<?php echo esc_url( get_template_directory_uri() . '/images/space.png' ); ?>" />
									</div>
								</div>
							<?php endif; ?>
						</div>
					</div>
					<?php endif; ?>

					<?php if ( has_post_thumbnail() ) : ?>
					<!-- SOUND THEME / TITLES -->
					<div class="col-md-9">
						<div class="soundtheme-big-title">
							<h1><?php echo get_the_title(); ?></h1>
							<h2><?php the_date(); ?></h2>
						</div>
					</div>

					<?php else: ?>
					
						<!-- SOUND THEME / TITLES -->
						<div class="col-md-12">
							<div class="soundtheme-big-title soundtheme-nothumb-title">
								<h1><?php echo get_the_title(); ?></h1>
								<h2><?php the_date(); ?></h2>
							</div>
						</div>

					<?php endif; ?>

					<div class="clearfix"></div>
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
		<div class="soundtheme-single-space"></div>

		<!-- SOUND THEME / DETAILS -->
		<div class="container-fluid soundtheme-white-backtwo soundtheme-single-details">
			<div class="container">
				<div class="row">
					<!-- #DETAILS -->
					<div class="col-md-12">
						<div class="soundtheme-post-detail" style="padding-top:60px;">
							<?php
			                    the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sound-theme' ) );
			                    wp_link_pages();
			                ?>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>

		<!-- SOUND THEME / COMMENTS -->
		<?php if ( ! comments_open() ) : ?>
		<?php else : ?>
		<div class="container-fluid soundtheme-white-backone soundtheme-comment-details">
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

	<?php endif; ?>

<?php get_footer(); ?>