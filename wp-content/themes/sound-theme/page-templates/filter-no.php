<?php
$soundtheme_sliderhomepost = get_field('soundtheme_filter_cat');
$soundtheme_sliderhomeposts = implode(',',$soundtheme_sliderhomepost);
$soundtheme_sliderhomeshow = esc_attr( get_field('soundtheme_filter_show'));
$soundtheme_col = esc_attr( get_field('soundtheme_filter_layouts'));
?>

<?php if (have_posts()) : ?>
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
		query_posts("cat=$soundtheme_sliderhomeposts&showposts=$soundtheme_sliderhomeshow&somecat&paged=$paged"); ?>

		<?php while (have_posts()) : the_post(); ?>	
			<?php
				$soundtheme_artist_name = esc_attr( get_field('soundtheme_artist_name'));
				$soundtheme_album_name = esc_attr( get_field('soundtheme_album_name'));
				$soundtheme_genre = esc_attr( get_field('soundtheme_music_genre'));
			?>
			<div class="col-xs-12 col-sm-6 <?php if ($soundtheme_col == "col-md-4"): ?> col-md-4 <?php elseif ($soundtheme_col == "col-md-3"): ?> col-md-3 <?php else: ?> col-md-4 <?php endif; ?> mix <?php echo esc_attr( $soundtheme_genre); ?>">
				<div class="soundtheme-filter-post">
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

					<div class="soundtheme-filter-posting">
						<h1>
							<?php if ($soundtheme_artist_name) : ?>
								<a href="<?php the_permalink() ?>"><?php echo esc_attr( $soundtheme_artist_name); ?></a>
							<?php else: ?>
								<a href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a>
							<?php endif; ?>
						</h1>

						<h2>
							<?php if ($soundtheme_album_name) : ?>
								"<?php echo esc_attr($soundtheme_album_name); ?>"
							<?php else: ?>
								<i class="fa fa-bookmark-o"></i> <?php echo get_the_time('d M y', $post->ID); ?> <i class="fa fa-commenting-o"></i> <?php comments_number( '0', '1', '%' ); ?>
							<?php endif; ?>
						</h2>
					</div>
				</div>
			</div>
		<?php  endwhile; ?>

		<div class="col-md-12">
		    <div class="soundtheme-pagenavi soundtheme-navicenter">
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


