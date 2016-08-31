<?php if (esc_attr( get_field('soundtheme_related_show') == "true") ): ?>
	<?php
		$soundtheme_related_back = esc_url( get_field('soundtheme_related_back'));
	?>
	<?php if ($soundtheme_related_back) : ?>
		<style type="text/css">
			.soundtheme-related-wall {
			background: url(<?php echo esc_url($soundtheme_related_back); ?>) no-repeat center center;
			background-color:#24252A;
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover; 
			  filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo esc_url($soundtheme_related_back); ?>', sizingMethod='scale');
			  -ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo esc_url($soundtheme_related_back); ?>', sizingMethod='scale')";
			}
		</style>
	<?php endif; ?>
	<!-- SOUND THEME / RELATED POSTS -->
	<div class="container-fluid soundtheme-darkback-one soundtheme-related-wall">
		<div class="container">
			<div class="row">
				<?php
					$soundtheme_relatedname = esc_attr( get_field('soundtheme_related_title'));
				?>
				<div class="soundtheme-related-title">
					<?php if ($soundtheme_relatedname) : ?>
						<h1><?php echo esc_attr($soundtheme_relatedname); ?></h1>
					<?php else : ?>
						<h1><?php _e( 'Related Posts', 'sound-theme' ); ?></h1>
					<?php endif; ?>	
				</div>
				<?php
	                $tags = wp_get_post_categories($post->ID);  
	                if ($tags) {  
	                $tag_ids = array();  
	                foreach($tags as $c) $tag_ids[] = get_cat_name( $c );
	                  $lister = implode(",", $tag_ids);

	                $args=array(  
	                'category__in' => $tags, 
	                'post__not_in' => array($post->ID),  
	                'showposts'=>4,
	                'ignore_sticky_posts'=>1  
	                );  

	                $my_query = new wp_query($args);  
	                if( $my_query->have_posts() ) {  
	                echo '';  
	                while ($my_query->have_posts()) {  
	                $my_query->the_post();  
	            ?>
		         	<div class="col-xs-12 col-sm-6 col-md-3">
		         		<div class="soundtheme-related-posts">
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
	            <?php } ?>                                         
	            <?php  }   }   
	            wp_reset_query();  
	            ?>
	            <div class="clearfix"></div>
	            <div class="soundtheme-related-space"></div> 

			</div>
		</div>
	</div>
<?php endif; ?>
<div class="clearfix"></div>