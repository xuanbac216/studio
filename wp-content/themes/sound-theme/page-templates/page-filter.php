<?php
/**
 * Template Name: Filter Page Builder
 *
 * @package WordPress
 * @subpackage sound-theme
 * @since sound-theme
 */

get_header(); ?>
	<!-- SOUND THEME / HEADER AREA -->
	<?php get_template_part( 'page-templates/inc-headback', 'page' ); ?>

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
				<div class="hidden-xs hidden-sm col-md-2">
					<?php if (get_field('soundtheme_hidefilter') == "show"): ?>
						<div class="soundtheme-filter-random">
							<ul>
								<li class="sort" data-sort="default"> <i class="fa fa-sliders"></i></i></li>
								<li class="sort" data-sort="random"> <i class="fa fa-exchange"></i></li>
							</ul>
						</div>
					<?php endif ?>
				</div>

				<div class="hidden-xs col-xs-12 col-md-8">
					<?php if (get_field('soundtheme_hidefilter') == "show"): ?>
						<div class="soundtheme-filters">
							<div class="soundtheme-filter-menu">
								<ul>
									<li class="filter active" data-filter="all">All</li>
									<?php if( have_rows('soundtheme_filter_genre') ): $i = 0; ?>
										<?php while( have_rows('soundtheme_filter_genre') ): the_row($i++); 
											$soundtheme_filters = get_sub_field('soundtheme_filter_name');
										?>
											<li class="filter" data-filter=".<?php echo esc_attr( $soundtheme_filters); ?>"><?php echo esc_attr( $soundtheme_filters); ?></li>
										<?php endwhile; ?>
									<?php endif; ?>	
								</ul>
								<div class="clearfix"></div>
							</div>
						</div>
					<?php endif; ?>
				</div>

				<div class="col-xs-12 hidden-sm hidden-md hidden-lg">
					<div class="hidden-sm hidden-md hidden-lg soundtheme-mini-share soundtheme-mini-sharetwo">
						<ul>
							<li><a href="#soundtheme-mini-filter" class="soundtheme-mini-link btn-success btn btn-block btn-lg"><?php _e( 'Filterable', 'sound-theme' ); ?><i class="fa fa-sliders"></i></a></li>
						</ul>
						<div class="clearfix"></div>
						<div id="soundtheme-mini-filter" class="soundtheme-mini-popup mfp-hide">
						  	<ul>
								<li class="filter active btn-primary btn btn-block btn-lg" data-filter="all">All</li>
								<?php if( have_rows('soundtheme_filter_genre') ): $i = 0; ?>
									<?php while( have_rows('soundtheme_filter_genre') ): the_row($i++); 
										$soundtheme_filters = get_sub_field('soundtheme_filter_name');
									?>
										<li class="filter btn-primary btn btn-block btn-lg" data-filter=".<?php echo esc_attr( $soundtheme_filters); ?>"><?php echo esc_attr( $soundtheme_filters); ?></li>
									<?php endwhile; ?>
								<?php endif; ?>	
							</ul>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>

				<div class="hidden-xs hidden-sm col-md-2">
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
				
					<?php if (get_field('soundtheme_hidefilter') == "show"): ?>
						<div id="Container">
							<?php get_template_part( 'page-templates/filter-list', 'page' ); ?>
						</div>
					<?php elseif (get_field('soundtheme_hidefilter') == "hide"): ?>
						<div id="Containertwo">
							<?php get_template_part( 'page-templates/filter-no', 'page' ); ?>
						</div>
					<?php else: ?>
						<div id="Containertwo">
							<?php get_template_part( 'page-templates/filter-no', 'page' ); ?>
						</div>
					<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>

<?php get_footer(); ?>