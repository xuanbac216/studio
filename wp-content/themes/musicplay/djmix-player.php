<?php
$autoplay = ( get_option( 'atp_audio_autoplay' ) == 'on' ) ? 'true' : 'false';
$playnext = ( get_option( 'atp_audio_player_next' ) == 'on' ) ? 'true' : 'false';
$atp_audio_visible = ( get_option('atp_audio_visible') == 'on' ) ? 'true' : 'false';
$atp_audio_page_id = get_option( 'atp_djmix_page_id' )  ? get_option( 'atp_djmix_page_id' ) : '';
$pop_player_button 			= ( get_option( 'atp_popup_player_button' ) == 'on' ) ? 'true' : 'false';
?>
<script type="text/javascript">
jQuery(document).ready(function($){
	soundManager.url ="<?php echo get_template_directory_uri();?>/swf/";
	soundManager.flashVersion = 9;
	soundManager.useHTML5Audio = true;
	soundManager.debugMode = false;
	jQuery('#fap').fullwidthAudioPlayer({
		keyboard: false,
		autoPlay:<?php echo $autoplay ?>,
		wrapperPosition: 'bottom',
		openLabel: '<i class="fa fa-music"></i>', //1.6.1 - the label for the close button
		closeLabel: '<i class="fa fa-music"></i>', //1.6.1 - the label for the open button
		playNextWhenFinished: <?php echo $playnext ?>,
		opened:<?php echo $atp_audio_visible; ?>,
		popup : <?php echo $pop_player_button; ?>,
		popupUrl: "<?php echo get_template_directory_uri();?>/popup.html"
	});

});
</script>
<?php     

	$playlist = $playmeta = $playlisttitles = $mp3_list = '';
	if ( $atp_audio_page_id != '' ) {
		$postid_array 	= array();
		$postid_array  	= explode(',',$atp_audio_page_id);
		$args = array(
		  'post_type'	=> 'djmix',
		  'post__in'	=>$postid_array,
		  'order'		=> 'ASC'
		);
	}else{
		$args = array(
		  'post_type'	=> 'djmix',
		  'showposts'	=> '1'
		);
	}
	$start=1;
	query_posts( $args );
	while (have_posts()):
		the_post();
		$audiolist = get_post_meta( $post->ID, 'djmix_upload_mix', true ) ? get_post_meta( $post->ID, 'djmix_upload_mix', true ) : '';
		$audio_posttype_option		= get_post_meta( $post->ID, 'audio_posttype_option', true ) ?  get_post_meta( $post->ID, 'audio_posttype_option', true ) :'player';
		$imagesrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID) , 'full', false, '' );
		$image = aq_resize( $imagesrc[0], '80', '80', true );
	if($audio_posttype_option == 'player'){
		$audio_list = array();
		$audio_list = explode(',',$audiolist);
		
		$count = count($audio_list);
		$i = 1;
		if (is_array($audio_list)){
			foreach($audio_list as $attachment_id) {
				$attachment = get_post( $attachment_id );
				$attachment_title=$attachment->post_title;
				$playlist .= ' <a href="' .  $attachment->guid. '" title="' . $attachment_title . '" rel="' . $image . '" data-meta="#player-meta'.$start.'"></a>';
			}
		}
	}elseif($audio_posttype_option == 'externalmp3'){
		$audiolist=get_post_meta($post->ID,'audio_mp3',true) ? get_post_meta($post->ID,'audio_mp3',true) :'';
		$mp3_title='';
		if( isset($mp3_list['mp3title']) && $mp3_list['mp3title'] !='' ){
		$mp3_title = $mp3_list['mp3title'];
		}
		$playlist .= ' <a href="' .  esc_attr( get_post_meta($post->ID,'djmix_externalmp3',true)). '" title="' . $mp3_title . '" rel="' . $image . '" data-meta="#player-meta'.$start.'"></a>';
	}elseif($audio_posttype_option == 'medialibrary'){

		$audiolist = get_post_meta($post->ID,'audio_medialibrary',false) ? get_post_meta($post->ID,'audio_medialibrary',false) :'';
			$count = count($audiolist);
			if($audiolist !='') {
				
				if($count > 0) {
					$i = 1;
					foreach($audiolist as $mediaupload_list) {
						$attachment = get_post( $mediaupload_list );

						$mediaupload_title= $attachment->post_title;
						$playlist .= ' <a href="'.$attachment->guid. '" title="' . $mediaupload_title . '" rel="' . $image . '" data-meta="#player-meta'.$start.'"></a>';
					
					}
				}
			}

	}else{
		$audio_soundcloud_title = get_post_meta($post->ID,'audio_soundcloud_title',true);
		$audio_soundcloud_url = get_post_meta($post->ID,'audio_soundcloud_url',true);
		$playlist .= ' <a href="' .  $audio_soundcloud_url. '" title="' . $audio_soundcloud_title . '" rel="' . $image . '" data-meta="#player-meta'.$start.'"></a>';
	

	}	
	global $default_date;
	$playlisttitle = get_the_title( get_the_id());
	$post_date = get_post_meta(get_the_id(),'djmix_release_date',true);
	if($post_date !='') { 
		if(is_numeric($post_date)){
			$post_date= date_i18n($default_date,$post_date);
		}	
	}

	$audio_label = get_post_type( get_the_ID() );
	$playmeta .='<div class="single-player-meta" id="player-meta'.$start.'"><a href="'.get_permalink().'">'.$playlisttitle.'</a></div>';
	$start++;
	endwhile;
		
	echo '<div id="fap">';
	echo '' . $playlist . ' ';
	echo '' . $playmeta . ' ';
	echo '</div>';

?><?php wp_reset_query(); ?> 