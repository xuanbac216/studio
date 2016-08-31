<?php get_header(); ?>
<div class="gdlr-content">

	<?php 
		global $gdlr_sidebar, $theme_option;
		if( empty($gdlr_post_option['sidebar']) || $gdlr_post_option['sidebar'] == 'default-sidebar' ){
			$gdlr_sidebar = array(
				'type'=>$theme_option['post-sidebar-template'],
				'left-sidebar'=>$theme_option['post-sidebar-left'], 
				'right-sidebar'=>$theme_option['post-sidebar-right']
			); 
		}else{
			$gdlr_sidebar = array(
				'type'=>$gdlr_post_option['sidebar'],
				'left-sidebar'=>$gdlr_post_option['left-sidebar'], 
				'right-sidebar'=>$gdlr_post_option['right-sidebar']
			); 				
		}
		$gdlr_sidebar = gdlr_get_sidebar_class($gdlr_sidebar);
	?>
	<div class="with-sidebar-wrapper">
		<div class="with-sidebar-container container">
			<div class="with-sidebar-left <?php echo $gdlr_sidebar['outer']; ?> columns">
				<div class="with-sidebar-content <?php echo $gdlr_sidebar['center']; ?> columns">
					<div class="gdlr-item gdlr-blog-full gdlr-item-start-content">
					<?php 
					while ( have_posts() ){ the_post(); 
						$post_option = json_decode(gdlr_decode_preventslashes(get_post_meta(get_the_ID(), 'post-option', true)), true);
						
						echo '<div class="gdlr-top-player">';
						
						echo '<div class="gdlr-top-player-inner">';
						echo '<div class="gdlr-top-player-content">';
						echo '<div class="gdlr-top-player-title">' . get_the_title() . '</div>';
						
						// download section
						echo '<div class="gdlr-top-player-download">';
						echo gdlr_print_download_link($post_option['download-link'], $post_option['apple-store'], $post_option['amazon-link'], 'source');
						echo '</div>'; // top player download
						
						echo '</div>'; // top player content
						echo '<div class="clear"></div>';
						echo '</div>'; // top player inner
						
						echo '<audio class="gdlr-audio-player" preload="auto" style="width: 100%; height: 50px;">';
						echo gdlr_print_audio_link($post_option['mp3'], $post_option['ogg'], $post_option['wav'], 'source');
						echo '</audio>';	
						echo '</div>'; // gdlr-top-player	
					} 
					?>
					</div>
				</div>
				<?php get_sidebar('left'); ?>
				<div class="clear"></div>
			</div>
			<?php get_sidebar('right'); ?>
			<div class="clear"></div>
		</div>				
	</div>				

</div><!-- gdlr-content -->
<?php get_footer(); ?>