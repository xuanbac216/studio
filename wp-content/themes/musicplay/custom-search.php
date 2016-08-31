<?php 
/***
 * Custom Search for Albums/Tracks and Artists
 *
 */
$search_option 		= get_option('atp_custom_search') ?  get_option('atp_custom_search') : 'enable';
$gnrs_lbls_display  = get_option('atp_genres_labels_display') ?  get_option('atp_genres_labels_display') : 'enable';


$search_genres_color 	=  get_option('atp_search_genres') ? get_option('atp_search_genres') :''; 
$search_labels_color 	=  get_option('atp_search_labels') ? get_option('atp_search_labels') :''; 
$search_submit_color 	=  get_option('atp_search_button') ? get_option('atp_search_button') :''; 

if( $search_option == 'enable'){ ?>
 
	<div class="iva-music-bar">
		<div class="inner">
			<div class="one_half nomargin"> 
				<div class="searchmenu-wrap">
				
				<?php 
				$iva_genres_count = wp_count_terms( 'genres', array( 'orderby'=> 'name','hide_empty' => 1) );
				if( $gnrs_lbls_display == 'enable'){
					if ( !empty( $iva_genres_count ) ) { ?>
						<div class="searchmenu-align iva-cs-gen">
							<ul class="search-nav iva-cs-gen-list clearfix">
								<li><a href="#" class="btn small <?php echo $search_genres_color; ?>"><span><?php _e( 'Genres','musicplay');?></span><i class="fa fa-angle-down fa-fw"></i></a>
									<div class="searchmenu-container <?php echo $search_genres_color; ?>">
										<?php
										$out = '';
										$terms = get_terms( array( 'genres'),array( 'orderby'=> 'name','hide_empty' => 1));
										if ( !empty( $terms ) && !is_wp_error( $terms ) ){
												$out .='<ul class="quickaccess">';
												foreach ( $terms as $term ) {
													$out .='<li><a class="'.$term->slug.' iva-search-genres" href="'. get_term_link( $term ).'" >' . $term->name . '</a></li>'; 	
												}
												$out .='</ul>';
											}
										echo $out;
										?>
									</div><!-- .container-2-->
								</li>
							</ul><!-- search-nav clearfix animated-->
						</div><!-- searchmenu-align-->
						
					<?php } ?>
					<?php 
					$iva_label_count = wp_count_terms( 'label', array( 'orderby'=> 'name','hide_empty' => 1) );
					if ( !empty( $iva_label_count ) ) { ?>

						<div class="searchmenu-align iva-cs-lbl">
							<ul class="search-nav iva-cs-lbl-list clearfix">
								<li><a href="#" class="btn small <?php echo $search_labels_color; ?>"><span><?php _e( 'Labels','musicplay');?></span><i class="fa fa-angle-down fa-fw"></i></a>
							
									<div class="searchmenu-container  <?php echo $search_labels_color; ?>">
										<?php
										$out = '';
										$terms = get_terms( array( 'label'),array( 'orderby'=> 'name','hide_empty' => 1));
										if ( !empty( $terms ) && !is_wp_error( $terms ) ){
										   $out .='<ul class="quickaccess">';
											foreach ( $terms as $term ) {
												$out .='<li><a class="'.$term->slug.' iva-search-labels" href="'. get_term_link( $term ).'" >' . $term->name . '</a></li>'; 
											}
											$out .='</ul>';
										}
										echo $out;
										?>
									</div><!-- .container-2-->
								</li>
							</ul><!-- search-nav clearfix animated-->
						</div><!-- searchmenu-align-->
					<?php }
					} ?>	
				</div><!-- searchmenu-wrap-->
			</div><!-- .one_half-->
		
			<div class="one_half last nomargin"> 
			
				<div class="iva-custom-search">
				<script>
				jQuery(document).ready(function () {

					jQuery(".iva_search").on("input", function() {
					   jQuery("#search_val").val( jQuery(this).val());
					});
			
					jQuery(".iva_search_btn").click(function(){
					
					var search_keyword = jQuery(".iva_search").val();
						if( search_keyword === "" ){
							jQuery(".pop-modal").css('display', 'block');
							jQuery("#hide-box").click(function () {
								jQuery(".pop-modal").css('display', 'none');
							});
							jQuery("#hide-x").click(function () {
								jQuery(".pop-modal").css('display', 'none');
							});
							return false; 
						}else{
							return true; 
						}
					});
				});
				</script>
				
					<form method="get" action="<?php echo home_url(); ?>">
				
				
					<div class="pop-modal">
						<div class="pop-overlay" id="hide-box">&nbsp;</div>
						<div class="pop-box round-corners">
							<div class="xbutton round-corners" id="hide-x">&#215;</div>
							<p>Enter Keyword To Search</p>
						</div>
					</div>
					
					<!-- Custom search posttype select -->
					<div class="iva_music_search_select">	
						<?php
						
						$albums_count 	= wp_count_posts('albums');
						$artists_count 	= wp_count_posts('artists');
						$djmix_count 	= wp_count_posts('djmix');

						$albums_title 	= get_option('atp_album_slug') ? get_option('atp_album_slug'):__('Albums','musicplay');
						$djmix_title 	= get_option('atp_djmix_slug') ? get_option('atp_djmix_slug'):__('Djmix','musicplay');
						$artists_title 	= get_option('atp_artists_slug') ? get_option('atp_artists_slug'):__('Artists','musicplay');
						
						$search_tracks_txt 	= get_option('atp_search_tracks_txt') ? get_option('atp_search_tracks_txt'):__('Search Tracks','musicplay');
						$search_placeholder = get_option('atp_search_placeholder') ? get_option('atp_search_placeholder'):__('Search Album, Artist, Track','musicplay');
						$search_btn_txt = get_option('atp_search_btn_txt') ? get_option('atp_search_btn_txt'):__('Search','musicplay');
	
						echo '<div class="iva_select_wrapper">';
						echo '<span class="iva-select-arrow"><i class="iva-arrpos fa fa-angle-down fa-lg"></i></span>';
						echo '<select name="iva_custom_search_select" id="cs_posttype" class="cs-posttype">';

						echo '<option value="all">'.$search_tracks_txt.'</option>';
						if( $albums_count->publish != ''){
							echo '<option value="albums">'.$albums_title.'</option>';
						}
						if( $djmix_count->publish != ''){
							echo '<option value="djmix">'.$djmix_title.'</option>';
						}
						if( $artists_count->publish != ''){
							echo '<option value="artists">'.$artists_title.'</option>';
						}
						echo '</select>	';
						echo '</div>';
						?>	
						</div>
				
						<!-- Custom search input -->
						<div class="iva_music_search_input">	
						<input type="hidden" id="search_val" name="s" value="">
						<input type="hidden" name="iva_search_keyword" value="Musicplay_Custom_Search">
						<input type="text" class="iva_search" name="iva_search_input" placeholder="<?php echo $search_placeholder; ?>" value="" size="25">
						</div>
						
						<!-- Custom search button -->
						<div class="iva_music_search_button">	
						<input type="submit" class="iva_search_btn btn small <?php echo $search_submit_color; ?>" value="<?php echo $search_btn_txt; ?>">
						</div>
						
					</form>
				
			</div><!-- .iva-custom-search -->
			
		</div><!-- .one_half last-->
		
	</div><!-- .inner -->
</div><!-- .iva-music-bar -->

<?php } ?>