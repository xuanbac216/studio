<!-- Module Slider -->
<?php if( have_rows('soundtheme_addslide') ): ?>
	
	<div id="component" class="component component-fullwidth <?php echo esc_attr(the_field('soundtheme_slider_effect')); ?>">
	    <ul class="itemwrap">
	        <?php while ( have_rows('soundtheme_addslide') ) : the_row(); ?>
	        	<?php
					$soundtheme_slider_tone = esc_attr( get_sub_field('soundtheme_slidertitle'));
					$soundtheme_slider_ttwo = esc_attr( get_sub_field('soundtheme_slidertitletwo'));
					$soundtheme_slider_btn = esc_attr( get_sub_field('soundtheme_sliderbtn_text'));
					$soundtheme_slider_btnlink = esc_url( get_sub_field('soundtheme_sliderbtn_link'));
				?>
		        <li <?php if (esc_attr( get_sub_field('soundtheme_currentslide') == "true") ): ?> class="current" <?php endif ?> style="background-image: url(<?php esc_url(the_sub_field('soundtheme_sliderimage')); ?>);" >
		            <div class="soundtheme-slidertitle">
		                <?php if ($soundtheme_slider_tone) : ?>
		                	<h1><?php echo esc_attr($soundtheme_slider_tone); ?></h1>
		                <?php endif; ?>
		                <?php if ($soundtheme_slider_ttwo) : ?>
		                	<h2><?php echo esc_attr($soundtheme_slider_ttwo); ?></h2>
		                <?php endif; ?>
		                <?php if ($soundtheme_slider_btn) : ?>
			                <div class="soundtheme-slider-button">
				            	<a href="<?php echo esc_url($soundtheme_slider_btnlink); ?>" class="btn btn-lg btn-success">
				            		<?php echo esc_attr($soundtheme_slider_btn); ?>
				            	</a>
				            </div>
				        <?php endif; ?>
		            </div>
		            <img src="<?php esc_url(the_sub_field('soundtheme_sliderimage')); ?>" alt="Slider" />
	        	</li>
	        <?php endwhile; ?>
	    </ul>
	    <nav>
	        <a class="prev" href="#"><i class="fa fa-chevron-left"></i></a>
	        <a class="next" href="#"><i class="fa fa-chevron-right"></i></a>
	    </nav>
	</div>
	<div class="clearfix"></div>
<?php endif; ?> 
<?php wp_reset_postdata(); ?>
<?php wp_reset_query(); ?>