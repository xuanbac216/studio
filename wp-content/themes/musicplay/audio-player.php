<?php
$autoplay = ( get_option( 'atp_audio_autoplay' ) == 'on' ) ? 'true' : 'false';
$playnext = ( get_option( 'atp_audio_player_next' ) == 'on' ) ? 'true' : 'false';
$atp_audio_visible = ( get_option('atp_audio_visible') == 'on' ) ? 'true' : 'false';
$pop_player_button 			= ( get_option( 'atp_popup_player_button' ) == 'on' ) ? 'true' : 'false';
$atp_audio_page_id = get_option( 'atp_audio_page_id' )  ? get_option( 'atp_audio_page_id' ) : '';
$atp_playlist_volume = get_option( 'atp_playlist_volume' )  ? get_option( 'atp_playlist_volume' ) : '0.6';

?>
<script type="text/javascript">
jQuery(document).ready(function(){
	soundManager.url ="<?php echo get_template_directory_uri();?>/swf/";
	soundManager.flashVersion = 9;
	soundManager.useHTML5Audio = true;
	soundManager.debugMode = false;
	jQuery('#fap').fullwidthAudioPlayer({
		keyboard: false,
		autoPlay:<?php echo $autoplay ?>,
		wrapperPosition: 'bottom',
		playNextWhenFinished: <?php echo $playnext ?>,
		opened:<?php echo $atp_audio_visible; ?>,
		popup : <?php echo $pop_player_button; ?>,
		popupUrl: "<?php echo get_template_directory_uri();?>/popup.html"

	});

	  jQuery('#fap').bind('onFapReady', function(evt, trackData) {
        jQuery.fullwidthAudioPlayer.volume(<?php echo $atp_playlist_volume; ?>);
    });
	jQuery('.fap-single-track').on('click',function(){
		jQuery.fullwidthAudioPlayer.setPlayerPosition('open', true );
	});
	selectedPlayButton = null;
	jQuery('#fap').on('onFapTrackSelect', function(evt, trackData, playState) {
			currentTrackUrl = null;
			if(trackData.duration == null) {
				currentTrackUrl = trackData.stream_url;
	
				if(currentTrackUrl.search('official.fm') != -1) {
	
					currentTrackUrl = trackData.permalink_url;
	
				}
			}
			else {
				//soundcloud
				currentTrackUrl = trackData.permalink_url;
	
			}
			if( 0 ) {
				currentTrackUrl = currentTrackUrl;
			}
			else {
				currentTrackUrl = currentTrackUrl.replace(/.*?:\/\//g, "").replace(/^www./, "");
			}
	
			selectedPlayButton = jQuery('.fap-single-track[href*="'+currentTrackUrl+'"]');
			if(playState) {
				jQuery('.selected').removeClass('selected');
				jQuery('ul').children().removeClass('selected');
				jQuery(selectedPlayButton).closest('li').addClass('selected');
				jQuery(selectedPlayButton).addClass('selected').parents('.hover_type').addClass('selected');
			}
			else {
				jQuery('.selected').removeClass('selected');
				jQuery(this).closest('li').addClass('selected');
				jQuery(this).addClass('selected').parents('.hover_type').addClass('selected');

			}
	})
	.on('onFapPlay', function() {
							if(selectedPlayButton != null) {
								jQuery('.selected').removeClass('selected');
								jQuery('ul').children().removeClass('selected');
								jQuery(selectedPlayButton).closest('li').addClass('selected');
								jQuery(selectedPlayButton).addClass('selected').parents('.hover_type').addClass('selected');
								//jQuery('.djmix-content').removeClass('selected');
								//jQuery(selectedPlayButton).closest('div').addClass('selected');
							;
							}
						})
						.on('onFapPause', function() {
							if(selectedPlayButton != null) {
							jQuery('.selected').removeClass('selected');
							jQuery('ul').children().removeClass('selected');

							}
						});


});
</script>
<?php     
	global $default_date;
	$playlist = $playlisttitles = '';
	$start=1;
	if ( $atp_audio_page_id != '' ) {
		$postid_array 	= array();
		$postid_array  	= explode(',',$atp_audio_page_id);
		$args = array(
		  'post_type'	=> 'albums',
		  'post__in'	=>$postid_array
		);
	}else{
		$args = array(
		  'post_type'	=> 'albums',
		  'showposts'	=> '1'
		);
	}
	query_posts( $args );
	
	while (have_posts()):
		the_post();

		$imagesrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID) , 'full', false, '' );
		$audio_posttype_option		= get_post_meta( $post->ID, 'audio_posttype_option', true ) ?  get_post_meta( $post->ID, 'audio_posttype_option', true ) :'player';
		$image = aq_resize( $imagesrc[0], '', '80', true );

		$audio_artist_name = get_post_meta( get_the_ID(),'audio_artist_name',TRUE );
		if ( is_array( $audio_artist_name ) && count( $audio_artist_name ) > 0 ) {
			
			foreach( $audio_artist_name as $audio_artist_id){
				$permalink 		= get_permalink(  $audio_artist_id);
				$cs_artist_name 	= get_the_title(  $audio_artist_id);
				$audio_artist[]	= '<a href="'.$permalink.'">'.$cs_artist_name.'</a>';
			}
			$audio_artist_name = implode( ', ', $audio_artist );
		}

		if($audio_posttype_option == 'player'){
			$audiolist = get_post_meta( $post->ID, 'audio_upload', true ) ? get_post_meta( $post->ID, 'audio_upload', true ) : '';
			$audio_list=array();
			$audio_list=explode(',',$audiolist);
			
			$count = count($audio_list);
			$i = 1;
			if (is_array($audio_list)){
				foreach($audio_list as $attachment_id) {
					$attachment = get_post( $attachment_id );
					$attachment_title=$attachment->post_title;
					$playlist .= ' <a href="' .  $attachment->guid. '" title="' . $attachment_title . '" rel="' . $imagesrc[0] . '" data-meta="#player-meta'.$start.'"></a>';
				}
			}
		}elseif($audio_posttype_option == 'externalmp3'){
			$audiolist=get_post_meta($post->ID,'audio_mp3',true) ? get_post_meta($post->ID,'audio_mp3',true) :'';
			$count=count($audiolist);
				if($audiolist !='') {
				
				if($count > 0) {
					$i = 1;
					foreach($audiolist as $mp3_list) {
						//$attachment = get_post( $attachment_id );
						$mp3_title=$mp3_list['mp3title'];
						$playlist .= ' <a href="' .  esc_attr($mp3_list['mp3url']). '" title="' . $mp3_title . '" rel="' . $imagesrc[0] . '" data-meta="#player-meta'.$start.'"></a>';
					
					}
				}
			}
							
		}elseif($audio_posttype_option == 'medialibrary'){
			
			$audiolist = get_post_meta($post->ID,'audio_medialibrary',false) ? get_post_meta($post->ID,'audio_medialibrary',false) :'';
			$count = count($audiolist);
			if($audiolist !='') {
				
				if($count > 0) {
					$i = 1;
					foreach($audiolist as $mediaupload_list) {
						$attachment = get_post( $mediaupload_list );

						$mediaupload_title= $attachment->post_title;
						$playlist .= ' <a href="'.$attachment->guid. '" title="' . $mediaupload_title . '" rel="' . $imagesrc[0] . '" data-meta="#player-meta'.$start.'"></a>';
					
					}
				}
			}
							
		}else{
			$audio_soundcloud_title = get_post_meta($post->ID,'audio_soundcloud_title',true);
			$audio_soundcloud_url = get_post_meta($post->ID,'audio_soundcloud_url',true);

			$playlist .= ' <a href="' .  $audio_soundcloud_url. '" title="' . $audio_soundcloud_title . '" rel="' . $imagesrc[0] . '" data-meta="#player-meta"></a>';
		}
		$playlisttitle = get_the_title( get_the_id());
		$post_date = get_post_meta(get_the_id(),'audio_release_date',true);
		if($post_date !='') { 
			if(is_numeric($post_date)){
				$post_date= date_i18n($default_date,$post_date);
			}	
		}
		$audio_label = get_the_term_list( $post->ID, 'label', '', ', ', '' );
		$audio_genre_music = get_the_term_list( $post->ID, 'genres', '', ', ', '' );
		$playlist .= '<div class="single-player-meta" id="player-meta'.$start.'">'.$audio_artist_name.' &mdash; <a href="'.get_permalink().'">'.$playlisttitle.'</a></div>';
		$start++;
		endwhile;

		
		echo '<div id="fap">';
		echo '' . $playlist . ' ';
		//echo ''.$playmeta.' ';
		echo '</div>'
?><?php wp_reset_query(); ?> 