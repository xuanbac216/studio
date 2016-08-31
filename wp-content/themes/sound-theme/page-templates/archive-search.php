<?php
/**
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
								<h1>
									<?php printf( __( 'Search Results for: %s', 'sound-theme' ), get_search_query() ); ?>
	                    		</h1>
								<h2><?php _e( 'Displaying', 'sound-theme' ); ?> <?php $num = $wp_query->post_count; if (have_posts()) : echo $num; endif;?> <?php _e( 'of', 'sound-theme' ); ?> <?php $search_count = 0; $search = new WP_Query("s=$s & showposts=-1"); if($search->have_posts()) : while($search->have_posts()) : $search->the_post(); $search_count++; endwhile; endif; echo $search_count;?> <?php _e( 'Results', 'sound-theme' ); ?> </h2>
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
								<h1>
									<?php printf( __( 'Search Results for: %s', 'sound-theme' ), get_search_query() ); ?>
	                    		</h1>
								<h2><?php _e( 'Displaying', 'sound-theme' ); ?> <?php $num = $wp_query->post_count; if (have_posts()) : echo $num; endif;?> <?php _e( 'of', 'sound-theme' ); ?> <?php $search_count = 0; $search = new WP_Query("s=$s & showposts=-1"); if($search->have_posts()) : while($search->have_posts()) : $search->the_post(); $search_count++; endwhile; endif; echo $search_count;?> <?php _e( 'Results', 'sound-theme' ); ?> </h2>
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
				<div class="row soundtheme-search-reseults">
					<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
							<div class="col-md-3">
								<div class="soundtheme-blog-list-img">					
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="soundtheme-single-gallery">
											<a href="<?php the_permalink() ?>">
												<?php the_post_thumbnail( 'soundtheme-thumb-medium' ); ?>
												<div class="soundtheme-hover-play"><i class="fa fa-hand-peace-o"></i></div>
											</a>
										</div>
									<?php else: ?>
										<div class="soundtheme-single-gallery">
											<a href="<?php the_permalink() ?>">
												<img src="<?php echo esc_url( get_template_directory_uri() . '/images/space.png' ); ?>" />
												<div class="soundtheme-hover-play"><i class="fa fa-hand-peace-o"></i></div>
											</a>
										</div>
									<?php endif; ?>
								</div>
								<div class="clearfix"></div>
								<div class="soundtheme-blog-list">
									<h1><a href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a></h1>
									<h2><i class="fa fa-bookmark-o"></i> <?php echo get_the_time('d M y', $post->ID); ?> <i class="fa fa-commenting-o"></i> <?php comments_number( '0', '1', '%' ); ?></h2>
								</div>
								<div class="clearfix"></div>
							</div>
						<?php  endwhile; ?>
						<div class="clearfix"></div>

						<div class="col-md-12">
						    <div class="soundtheme-pagenavi soundtheme-search-navi">
						        <div class="pagination soundtheme-navi">
						            <?php if ( function_exists( 'page_navi' ) ) page_navi( 'items=3&first_label=First&last_label=Last&show_num=1&num_position=after' ); ?>
						        </div>
						        <div class="clearfix"></div>
						    </div>
						</div>
						<div class="clearfix"></div>
					<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?> 
					<?php endif; ?>
					<?php wp_reset_query(); ?>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>

	<?php endif; ?>

<?php get_footer(); ?>