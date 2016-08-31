<?php global $gdlr_post_settings; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="gdlr-standard-style">
		<?php get_template_part('single/thumbnail', get_post_format()); ?>
		
		<div class="gdlr-blog-content-wrapper">
			<div class="gdlr-blog-content-inner">
				<header class="post-header">
					<?php echo gdlr_get_blog_info($gdlr_post_settings['blog-info']); ?>

					<?php if( is_single() && get_post_type() == 'post' ){ ?>
						<h1 class="gdlr-blog-title"><?php the_title(); ?></h1>
					<?php }else if( !is_single() ){ ?>
						<h3 class="gdlr-blog-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php } ?>	
					<div class="clear"></div>
				</header><!-- entry-header -->

				<?php 
					if( $gdlr_post_settings['excerpt'] < 0 ){
						global $more; $more = 0;
					
						echo '<div class="gdlr-blog-content">';
						echo gdlr_content_filter($gdlr_post_settings['content'], true);
						wp_link_pages( array( 
							'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'gdlr_translate' ) . '</span>', 
							'after' => '</div>', 
							'link_before' => '<span>', 
							'link_after' => '</span>' )
						);
						echo '</div>';
					}else if($gdlr_post_settings['excerpt'] > 0){
						echo '<div class="gdlr-blog-content">' . get_the_excerpt() . '</div>';
					}
				?>
					
				<div class="blog-date-wrapper">
					<span class="blog-date-day"><?php echo get_the_time('d'); ?></span>
					<div class="blog-date-right">
						<span class="blog-date-month"><?php echo get_the_time('F'); ?></span>
						<span class="blog-date-year"><?php echo get_the_time('Y'); ?></span>
					</div>
					<div class="clear"></div>
				</div>				
			</div> <!-- blog-content-inner -->
		</div> <!-- blog-content-wrapper -->
		<div class="clear"></div>
	</div>
</article><!-- #post -->