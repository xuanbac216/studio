<?php
	$soundtheme_sliderhomepost = get_field('soundtheme_select_categories');
	$soundtheme_sliderhomeposts = implode(',',$soundtheme_sliderhomepost);
	$soundtheme_sliderhomeshow = esc_attr( get_field('soundtheme_show_post'));
?>
<div class="row soundtheme-blog-listing">
	<?php if (have_posts()) : ?>
		<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
				query_posts("cat=$soundtheme_sliderhomeposts&showposts=$soundtheme_sliderhomeshow&somecat&paged=$paged"); ?>

		<?php while (have_posts()) : the_post(); ?>
			<div class="soundtheme-blogs">
				<div class="col-md-4">
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
				</div>
				<div class="col-md-8">
					<div class="soundtheme-blog-list">
						<h1><a href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a></h1>
						<h2><i class="fa fa-folder-o"></i> <?php the_category(', ') ?> <i class="fa fa-bookmark-o"></i> <?php echo get_the_time('d M y', $post->ID); ?> <i class="fa fa-commenting-o"></i> <?php comments_number( '0', '1', '%' ); ?></h2>
						<div class="soundtheme-post-detail">
							<?php
			                    the_content( __( '<span class="soundtheme-more">Continue Reading <i class="fa fa-angle-right"></i></span>', 'sound-theme' ) );
			                    wp_link_pages();
			                ?>
			            </div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
		<?php  endwhile; ?>

		<div class="col-md-12">
		    <div class="soundtheme-pagenavi">
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
</div>
<?php wp_reset_query(); ?>