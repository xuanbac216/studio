<?php
	if( !is_single() ){ 
		global $gdlr_post_settings; 
		if($gdlr_post_settings['excerpt'] < 0) global $more; $more = 0;
	}else{
		global $gdlr_post_settings, $theme_option;
	}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="gdlr-standard-style">
		<div class="blog-date-wrapper">
			<span class="blog-date-day"><?php echo get_the_time('d'); ?></span>
			<span class="blog-date-month"><?php echo get_the_time('F'); ?></span>
			<span class="blog-date-year"><?php echo get_the_time('Y'); ?></span>
		</div>	

		<div class="gdlr-blog-content-wrapper">
			<div class="gdlr-blog-content-inner">
				<?php get_template_part('single/thumbnail', get_post_format()); ?>
			
				<header class="post-header">
					<?php if( is_single() ){ ?>
						<h1 class="gdlr-blog-title"><?php the_title(); ?></h1>
					<?php }else{ ?>
						<h3 class="gdlr-blog-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
					<?php } ?>	
					
					<?php 
						// print blog information
						if( is_single() && get_post_type() == 'post' ){
							echo gdlr_get_blog_info(array('author', 'comment', 'category')); 
						}else{
							echo gdlr_get_blog_info($gdlr_post_settings['blog-info']);
						}
					?>					
					<div class="clear"></div>
				</header><!-- entry-header -->

				<?php 
					if( is_single() || $gdlr_post_settings['excerpt'] < 0 ){
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
			</div> <!-- blog-content-inner -->
			
			<?php if( is_single() ){ ?>
				<div class="gdlr-single-blog-tag">
					<?php echo gdlr_get_blog_info(array('tag'), false); ?>
				</div>

				<?php gdlr_get_social_shares(); ?>
				
				<nav class="gdlr-single-nav">
					<?php previous_post_link('<div class="previous-nav">%link</div>', '<i class="icon-angle-left"></i><span>%title</span>', true); ?>
					<?php next_post_link('<div class="next-nav">%link</div>', '<span>%title</span><i class="icon-angle-right"></i>', true); ?>
					<div class="clear"></div>
				</nav><!-- .nav-single -->

				<!-- abou author section -->
				<?php if($theme_option['single-post-author'] != "disable"){ ?>
					<div class="gdlr-post-author">
					<h3 class="post-author-title" ><?php echo __('About Post Author', 'gdlr_translate'); ?></h3>
					<div class="post-author-avartar"><?php echo get_avatar(get_the_author_meta('ID'), 90); ?></div>
					<div class="post-author-content">
					<h4 class="post-author"><?php the_author_posts_link(); ?></h4>
					<?php echo get_the_author_meta('description'); ?>
					</div>
					<div class="clear"></div>
					</div>
				<?php } ?>						

				<?php comments_template( '', true ); ?>				
			<?php } ?>			
			
		</div> <!-- blog-content-wrapper -->
		<div class="clear"></div>
	</div>
</article><!-- #post -->