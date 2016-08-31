<?php
/* Footer Sidebar
 * Copyright 
 * Google Analytics
 */
?>		</div><!-- #Ajax wrap -->
			</div><!-- #main -->
	
		<div id="footer">
			<?php if ( get_option( 'atp_audio_player' ) == 'radio' ) { ?>
				<div id="skin-wrapper" data-skin-name="premium-pixels"><div id="jquery_jplayer_1" class="jp-jplayer"></div></div>
			<?php } ?>
			<div class="inner">
			
				<?php
				// Get footer sidebar widgets
				if ( get_option( 'atp_footer_sidebar' ) != 'on' ){
						if( is_active_sidebar( 'footercolumn1')
						|| is_active_sidebar( 'footercolumn2')
						|| is_active_sidebar( 'footercolumn3')
						|| is_active_sidebar( 'footercolumn4')
						|| is_active_sidebar( 'footercolumn5')
						|| is_active_sidebar( 'footercolumn6')
					) {
						get_template_part( 'sidebar', 'footer' );
					}
				}
				?>

				<div class="copyright clearfix">
					<div class="copyright_left">
						<?php echo stripslashes( nl2br( do_shortcode(get_option( 'atp_leftcopyright' )))); ?>
					</div>
					<!-- .copyright_left -->
					<div class="copyright_right">
						<?php echo stripslashes( nl2br( do_shortcode(get_option( 'atp_rightcopyright' )))); ?>
					</div>
					<!-- .copyright_left -->
				</div>
				<!-- .copyright -->
			
			</div><!-- .inner -->
		</div><!-- #footer -->

	</div><!-- #wrapper -->
</div><!-- #layout -->
<?php
	$atp_player=get_option('atp_audio_player');
	switch($atp_player) {
		case 'radio':
					if ( get_option( 'atp_radio_enable' ) == 'on' ) {
						get_template_part('radio','player');
					}
					break;
		case 'album':
					if ( get_option( 'atp_audio_enable' ) == 'on' ) {
						get_template_part('audio', 'player'); 
					}
					break;
		case 'djmix':
					if ( get_option( 'atp_audio_enable' ) == 'on' ) {
						get_template_part('djmix', 'player'); 
					}
					break;
	
		default:
					if ( get_option( 'atp_audio_enable' ) == 'on' ) {
						get_template_part('audio', 'player'); 
					}
	}
?>
	<?php wp_footer();?>
	<div id="back-top"><a href="#header"><span class="fadeInUp"></span></a></div>

	</body>
</html>