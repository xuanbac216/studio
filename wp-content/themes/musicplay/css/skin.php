<?php
function atp_style() {
	$atp_option_var = array(
		'atp_themecolor', 'atp_wrapbg','atp_h1', 'atp_h2', 'atp_h3','atp_h4', 'atp_h5', 'atp_h6','atp_bodyp', 'atp_headerproperties',
		'atp_subheaderproperties','atp_subheader_textcolor','atp_footerbg', 'atp_footertext','atp_copyrights', 'atp_copybgcolor','atp_copylinkcolor',
		'atp_breadcrumbtext', 'atp_stickybarcolor','atp_stickybarfontcolor','atp_sidebartitle', 'atp_footertitle','atp_entrytitle', 'atp_entrytitlelinkhover',
		'atp_bodyproperties', 'atp_sliderbgproup','atp_logotitle', 'atp_tagline','atp_footerlinkcolor', 'atp_footerlinkhovercolor',
		'atp_topmenu', 'atp_topmenu_linkhover','atp_topmenu_hoverbg','atp_topmenu_sub_bg', 'atp_topmenu_sub_link',
		'atp_topmenu_sub_linkhover', 'atp_topmenu_sub_hoverbg','atp_topmenu_active_link', 'atp_topmenu_bordercolor',
		'atp_entrytitle','atp_overlayimages', 'atp_link','atp_linkhover','atp_subheaderlink',
		'atp_subheaderlinkhover','atp_subheader_pt','atp_subheader_pb','atp_logo_ml','atp_logo_mt','atp_headerHeight',
		'atp_extracss','atp_teaser_bg','atp_teaser_color','atp_footerheadingcolor','atp_topbar_bgcolor',
		'atp_topbar_text','atp_fontwoff','atp_fontttf','atp_fontsvg',
		'atp_fonteot','atp_fontname','atp_fontclass','atpbodyfont','atp_headings','atp_mainmenufont',
		'atp_playerBG','atp_playerBr','atp_playerTitle','atp_playerVolBG','atp_playerBtnBG','atp_playerMeta','atp_stickybarenable',
		'atp_player_icon_color','atp_flex_title_bg_color','atp_flex_desc_bg_color','atp_quickaccess_link','atp_quickaccess_linkhover','atp_cus_search_bgcolor','atp_gen_preloader_image','atp_loaderbgcolor','atp_gen_preloader_icon_color'
	);

	foreach( $atp_option_var as $value ){
		$$value = get_option($value);
	}

	// Define Variables
	$bodyImage =  generate_imagecss( $atp_bodyproperties, array( 'background-color' => 'color' ) );
	if ( $atp_overlayimages != '' ) {
		$overlayimages =  generate_css( array( 'background-image' => 'url('.THEME_PATTDIR.$atp_overlayimages.')' ) );
	}

	$themeColor = isset( $atp_themecolor ) ? $atp_themecolor : '';
	$stickyBG			= $atp_stickybarcolor ? 'background:'.$atp_stickybarcolor.';': '';
	$stickyfontcolor	= $atp_stickybarfontcolor ? 'color:'.$atp_stickybarfontcolor.';': '';

	$topbarBG			= $atp_topbar_bgcolor ? 'background-color:'.$atp_topbar_bgcolor.';': '';
	$topbarText			= $atp_topbar_text ? 'color:'.$atp_topbar_text.';': '';
	$wrapbg				= $atp_wrapbg ? 'background-color:'.$atp_wrapbg.';': '';
	$bodyP				= generate_fontcss( $atp_bodyp );
	$link				= $atp_link ? 'color:'.$atp_link.';': '';
	$linkHover			= $atp_linkhover ? 'color:'.$atp_linkhover.';': '';
	$teaserBG			= $atp_teaser_bg ? 'background-color:'.$atp_teaser_bg.';': '';
	$teasercolor			= $atp_teaser_color ? 'color:'.$atp_teaser_color.';': '';
	$sliderBG			= generate_imagecss( $atp_sliderbgproup,array('background-color'=>'color'));
	$headerHeight  = $atp_headerHeight ? 'height:'.(int)$atp_headerHeight.'px;': '';
	$headerProperties	= generate_imagecss( $atp_headerproperties,array('background-color'=>'color'));
	$logoTitle			= generate_fontcss( $atp_logotitle);
	$logo_ML			= $atp_logo_ml ? 'margin-left:'.$atp_logo_ml.'px;': '';
	$logo_MT			= $atp_logo_mt ? 'margin-top:'.$atp_logo_mt.'px;': '';
	$subheaderBG		= generate_imagecss( $atp_subheaderproperties,array('background-color'=>'color'));
	$subheader_PT		= $atp_subheader_pt ? 'padding-top:'.$atp_subheader_pt.'px;': '';
	$subheader_PB		= $atp_subheader_pb ? 'padding-bottom:'.$atp_subheader_pb.'px;': '';
	$subheaderText		= $atp_subheader_textcolor ? 'color:'.$atp_subheader_textcolor.';': '';
	$subheaderLink		= $atp_subheaderlink ? 'color:'.$atp_subheaderlink.';': '';
	$subheaderLinkHover	= $atp_subheaderlinkhover ? 'color:'.$atp_subheaderlinkhover.';': '';
	$breadcrumbText		= $atp_breadcrumbtext ? 'color:'.$atp_breadcrumbtext.';': '';
	$footerBg			= generate_imagecss( $atp_footerbg,array('background-color'=>'color'));
	$footerTitleFont	= generate_fontcss( $atp_footertitle);
	$footerText			= generate_fontcss( $atp_footertext);
	$footerHeadingColor = $atp_footerheadingcolor ? 'color:'.$atp_footerheadingcolor.';': '';
	$footerLink			= $atp_footerlinkcolor ? 'color:'.$atp_footerlinkcolor.';':'';
	$footerLinkHover	= $atp_footerlinkhovercolor ? 'color:'.$atp_footerlinkhovercolor.';':'';
	$copyrightProperties = generate_fontcss( $atp_copyrights);
	$copyLinkColor		= $atp_copylinkcolor ? 'color:'.$atp_copylinkcolor.';':'';
	$copyrightBG		= $atp_copybgcolor ? 'background-color:'.$atp_copybgcolor.';': '';
	$tagLine			= generate_fontcss( $atp_tagline);

	$entryTitleFont			= generate_fontcss( $atp_entrytitle );
	$entryTitleLinkHover	= $atp_entrytitlelinkhover? 'color:'.$atp_entrytitlelinkhover.';': '';
	$sidebarTitleFont		= generate_fontcss( $atp_sidebartitle );
	$bodyfont = $atpbodyfont ? 'font-family:'.$atpbodyfont.';': '';
	$headings = $atp_headings ? 'font-family:'.$atp_headings.';': '';
	$mainmenufont = $atp_mainmenufont ? 'font-family:'.$atp_mainmenufont.';': '';

	// Top Menu
	$topmenufont = generate_fontcss($atp_topmenu);
	$topmenu_linkhover	= $atp_topmenu_linkhover?'color:'.$atp_topmenu_linkhover.';': '';
	$topmenu_hoverbg = $atp_topmenu_hoverbg?'background-color:'.$atp_topmenu_hoverbg.';': '';
	$topmenu_sub_bg	= $atp_topmenu_sub_bg? 'background:'.$atp_topmenu_sub_bg.';': '';
	$topmenu_sub_link	= $atp_topmenu_sub_link? 'color:'.$atp_topmenu_sub_link.';': '';
	$topmenu_sub_linkhover	= $atp_topmenu_sub_linkhover? 'color:'.$atp_topmenu_sub_linkhover.';': '';
	$topmenu_sub_hoverbg	= $atp_topmenu_sub_hoverbg? 'background:'.$atp_topmenu_sub_hoverbg.';': '';
	$topmenu_active_link	= $atp_topmenu_active_link? 'color:'.$atp_topmenu_active_link.';': '';
	$topmenu_bordercolor	= $atp_topmenu_bordercolor? 'border-color:'.$atp_topmenu_bordercolor.';': '';

	$playerBG	= $atp_playerBG? 'background-color:'.$atp_playerBG.' !important;': '';
	$playerBr	= $atp_playerBr? 'border-color:'.$atp_playerBr.' !important;': '';
	$playerTitle = $atp_playerTitle? 'color:'.$atp_playerTitle.' !important;': '';
	$playerVolBG = $atp_playerVolBG? 'background-color:'.$atp_playerVolBG.' !important;': '';
	$playerBtnBG = $atp_playerBtnBG? 'color:'.$atp_playerBtnBG.' !important;': '';
	$playerMeta = $atp_playerMeta? 'color:'.$atp_playerMeta.' !important;': '';
	$player_icon_color = $atp_player_icon_color? 'color:'.$atp_player_icon_color.' !important;': '';

	// Headings
	$h1font = generate_fontcss($atp_h1);
	$h2font = generate_fontcss($atp_h2);
	$h3font = generate_fontcss($atp_h3);
	$h4font = generate_fontcss($atp_h4);
	$h5font = generate_fontcss($atp_h5);
	$h6font = generate_fontcss($atp_h6);

	// svg  options
	$atp_loaderbgcolor	= $atp_loaderbgcolor ? 'background-color:'.$atp_loaderbgcolor.';': '';
	$atp_gen_preloader_image	= $atp_gen_preloader_image ? 'background-image:url('.THEME_URI.'/images/svg-loaders/'.$atp_gen_preloader_image.'.svg);': '';
	$atp_gen_preloader_icon_color	= $atp_gen_preloader_icon_color ? 'color:'.$atp_gen_preloader_icon_color.';': '';

	$iva_flex_desc_bg_color		= $atp_flex_desc_bg_color ? 'background-color:'.$atp_flex_desc_bg_color.';': '';
	$iva_flex_title_bg_color	= $atp_flex_title_bg_color ? 'background-color:'.$atp_flex_title_bg_color.';': '';
	// search bar labels color
	$quickaccess_link         = $atp_quickaccess_link ? 'color: '.$atp_quickaccess_link.'; ' : '';
	$quickaccess_linkhover    = $atp_quickaccess_linkhover ? 'color: '.$atp_quickaccess_linkhover.'!important; ' : '';
	$cus_search_bgcolor       = $atp_cus_search_bgcolor ? 'background-color: '.$atp_cus_search_bgcolor.'; ' : '';

?>
<style>
<?php if ( $themeColor != '' ) { ?>
a.button,
.play-btn,
#back-top span,
#fap-progress-bar div,
#fap-volume-progress div,
.pagination span.current,
#respond input#submit,
.pagination a:hover,
.progress_bar, .table.fancy_table th,
.status-format, .ac_title.active .arrow, .comment-edit-link, .post-edit-link,
.album-list:hover .album-desc,
.artist-list:hover .artist-desc,
.gallery-list:hover .gallery-desc,
.video-list:hover .video-desc,
.event-list:hover .event-desc,
.hover_type a.hoveraudio:hover,
.hover_type a.hoveralbum:hover,
.hover_type a.hoveralbums:hover,
.hover_type a.hovervideo:hover,
.hover_type a.hovergallery:hover,
.hover_type a.hoverimage:hover,
.hover_type a.hoverdjmix:hover,
.hover_type a.hoverartists:hover,
.hover_type a.hoverartist:hover,
.event-meta .day,
.tagcloud a:hover,
.toggle-title.active .arrow,
.search-nav > li > a,
.search-nav > li:hover > a,
.splitter ul li a,
.testimonial-box:hover .imageborder,
.tabs li.current {
	background-color:<?php echo $themeColor; ?>
}

a,.more-link,
.mp3options a:hover,
.iva-np-pagination a:hover,
.search-nav > li > div a:hover,
.selected .fa-2x.play_icon,
.artist-mdata a,
.album-meta > a,
.album-meta a,
.splitter li a.selected { color:<?php echo $themeColor; ?> }

#footer, #featured_slider, .sf-menu ul.sub-menu,
#header, #header-s3, #header-s4,
.fancyheading span, blockquote.alignright, blockquote.alignleft,
.fancytitle span {
	border-color:<?php echo $themeColor; ?>
}
<?php } ?>
a,.entry-title a { <?php echo $link; ?> }
a:hover,.entry-title a:hover { <?php echo $linkHover; ?> }

<?php if ( $bodyImage != '' || $bodyP != '' ) { ?>
.iva_page_bg { <?php echo $bodyImage; ?> }
body { <?php echo $bodyP; ?>}
<?php } ?>

<?php if ( $atp_overlayimages != '' ) { ?>
.bodyoverlay { <?php echo $overlayimages; ?> }
<?php } ?>


<?php if ( get_option('atp_img_over_effect') == 'on' ) { ?>
.custompost_thumb .imgoverlay { display: none !important; }
<?php } ?>

#main { <?php echo $wrapbg; ?> }
h1, h2, h3, h4, h5, h6, .countdown-amount { <?php echo $headings; ?> }
body { <?php echo $bodyfont; ?> }

.topbar { <?php
echo $topbarBG;
echo $topbarText;?>
}
#header, #header-s2, #header-s3 { <?php echo $headerProperties; ?> }

#featured_slider { <?php echo $sliderBG; ?> }
.homepage_teaser,
.frontpage_teaser
 { <?php echo $teaserBG; ?>
	<?php echo $teasercolor; ?>
}

#subheader {
	<?php echo $subheaderBG; ?>
	<?php echo $subheader_PT; ?>
	<?php echo $subheader_PB; ?>
	<?php echo $subheaderText; ?>
	}
#subheader .page-title { <?php echo $subheaderText; ?> }
.primarymenu { <?php echo $topmenu_bordercolor; ?> }

h1#site-title a{ <?php echo $logoTitle; ?> }
h2#site-description { <?php echo $tagLine;  ?> }
.logo { <?php echo $logo_ML; ?> <?php echo $logo_MT; ?> }
#sticky { <?php echo $stickyBG; echo $stickyfontcolor;?> }
<?php
if($atp_stickybarenable  == 'on') { ?>
#sticky { display:block; }
<?php } ?>
#atp_menu a { <?php echo $topmenufont . $mainmenufont; ?> }
#atp_menu li:hover,
#atp_menu li.sfHover { <?php echo $topmenu_hoverbg; ?> }

#atp_menu li:hover > a,
#atp_menu li.sfHover > a,
#atp_menu a:focus,
#atp_menu a:hover,
#atp_menu a:active {
	<?php echo $topmenu_linkhover; ?>
}

#atp_menu ul { <?php echo $topmenu_sub_bg; ?> }
#atp_menu ul a { <?php echo $topmenu_sub_link; ?> }

#atp_menu li li:hover, #atp_menu li li.sfHover,
#atp_menu li li a:focus, #atp_menu li li a:hover, #atp_menu li li a:active {
	<?php echo $topmenu_sub_linkhover; ?>
	<?php echo $topmenu_sub_hoverbg; ?>
	}

#atp_menu ul li { <?php echo $topmenu_bordercolor; ?> }

#atp_menu li.current-cat > a,
#atp_menu li.current_page_item > a,
#atp_menu li.current-page-ancestor > a { <?php echo $topmenu_active_link; ?> }

h1 { <?php echo $h1font; ?> }
h2 { <?php echo $h2font; ?> }
h3 { <?php echo $h3font; ?> }
h4 { <?php echo $h4font; ?> }
h5 { <?php echo $h5font; ?> }
h6 { <?php echo $h6font; ?> }
.header-area {	<?php echo $headerHeight; ?> }
h2.entry-title a { <?php echo $entryTitleFont; ?> }
h2.entry-title a:hover { <?php echo $entryTitleLinkHover; ?> }
.widget-title { <?php echo $sidebarTitleFont; ?> }
#footer .widget-title { <?php echo $footerTitleFont; ?> }

#subheader a { <?php echo $subheaderLink; ?> }
#subheader a:hover { <?php echo $subheaderLinkHover; ?> }

#footer { <?php echo $footerBg; ?> <?php echo $footerText; ?> }
.copyright { <?php echo $copyrightProperties . $copyrightBG; ?> }
.copyright a { <?php echo $copyLinkColor; ?> }

#footer .widget-title { <?php echo $footerHeadingColor; ?> }
.breadcrumbs { <?php echo $breadcrumbText; ?> }
#footer a { <?php echo $footerLink; ?> }
#footer a:hover { <?php echo $footerLinkHover; ?> }

.quickaccess li a  { <?php echo $quickaccess_link; ?> }
.quickaccess li a:hover  { <?php echo $quickaccess_linkhover; ?> }
.iva-music-bar { <?php echo $cus_search_bgcolor; ?>}

/* Audio Player Dark Skin */

.jp-interface, .jp-close-btn, #fap-wrapper, #fap-current-cover { <?php echo $playerBG; echo $playerBr; ?>}
#fap-main,
.jp-title, .jp-desc, .jp-audio, .jp-radio, #fap-current-title { <?php echo $playerTitle; ?> }

.jp-radio .jp-time-holder:after, .jp-radio .jp-volume-bar:before,
#fap-volume-indicator, #fap-progress-bar { <?php echo $playerBr; ?> }

#fap-previous:hover, #fap-progress-bar, #fap-next:hover, #fap-player-popup:hover,
#fap-playlist-toggle:hover, #fap-playlist-shuffle:hover, #fap-wrapper-switcher,
.fa-volume-up, #fap-player-popup, #fap-playlist-shuffle, #fap-playlist-toggle,
.jp-radio .jp-pause, #fap-play-pause, #fap-previous, #fap-next { <?php echo $playerBtnBG; ?> }

.jp-radio .jp-volume-bar-value, #fap-volume-indicator, #fap-progress-bar { <?php echo $playerVolBG; ?>}

#fap-current-time, #fap-total-time, #fap-wrapper-switcher,
#fap-current-meta, #fap-current-meta a, #fap-current-meta a:visited { <?php echo $playerMeta; ?> }
#fap-wrapper-switcher { <?php echo $playerBG; echo $playerBr; ?> }

.jp-radio .jp-close-btn,
.jp-radio .fa-volume-up,
.jp-radio .jp-play,
.jp-radio .jp-pause,
.jp-audio a:hover { <?php echo $player_icon_color; ?>}

.flex-caption { <?php echo $iva_flex_title_bg_color;?> }
.flex-title h5,
.flex-title h6 { <?php echo $iva_flex_desc_bg_color;?> }
<?php
	if ( $atp_loaderbgcolor != '' ) {
			echo '
			.iva_page_loader,
			.preloader { '.$atp_loaderbgcolor.'}';
	}
if ( $atp_gen_preloader_image != '' ) {
	echo '
		.iva_page_loader,
		.preloader
		{ '.$atp_gen_preloader_image.'}';
	}

if ( $atp_gen_preloader_icon_color != '' ) {
	echo '
		.iva_page_loader,
		.preloader
		{ '.$atp_gen_preloader_icon_color.'}';
	}

?>

<?php if($atp_extracss != '') { ?>
<?php echo $atp_extracss; ?>
<?php } ?>

<?php
if ( ( $atp_fontwoff != '')
		&& ( $atp_fontttf != '')
		&& ( $atp_fontsvg != '' )
		&& ( $atp_fonteot != '' )
	) {
	$fontclass = $atp_fontclass ? $atp_fontclass : 'h1, h2, h3, h4, h5, h6, #atp_menu a, .splitter ul li a, .pagination'; ?>

	@font-face {
		font-family: '<?php echo $atp_fontname; ?>';
		src: url('<?php echo $atp_fontwoff; ?>');
		src: url('<?php echo $atp_fonteot; ?>?#iefix') format('embedded-opentype'),
			url('<?php echo $atp_fontwoff; ?>') format('woff'),
			url('<?php echo $atp_fontttf; ?>') format('truetype'),
			url('<?php echo $atp_fontsvg; ?>#<?php echo $atp_fontname; ?>') format('svg');
		font-weight: normal;
		font-style: normal;
	}
	<?php echo $fontclass; ?> {
		font-family: '<?php echo $atp_fontname; ?>';
	}
	<?php define('CUSTOMFONT',true); ?>
	<?php } ?>



</style>
<?php } ?>
<?php
add_action( 'wp_head', 'atp_style', 100 );

//for font css attributes
function generate_fontcss($arr_var) {
	$size			= $arr_var['size'] 			? 'font-size:'.$arr_var['size'].';': '';
	$color			= $arr_var['color'] 		? 'color:'.$arr_var['color'].';': '';
	$lineheight		= $arr_var['lineheight']	? 'line-height:'.$arr_var['lineheight'].';': '';
	$style			= $arr_var['style'] 		? 'font-style:'.$arr_var['style'].';': '';
	$variant		= $arr_var['fontvariant'] 	? 'font-weight:'.$arr_var['fontvariant'].';': '';

	return "{$size} {$color} {$lineheight} {$style} {$variant}";
}

//for background image css attributes
function generate_imagecss($arr,$include_others) {

	$str='';
	if($arr['image'] != '') {

		$str .='background-image:url('.$arr['image'].');
		background-repeat:'.$arr['style'].';
		background-position:'.$arr['position'].';
		background-attachment:'.$arr['attachment'].';';
	}

	if(is_array($include_others)) {
		foreach($include_others as $key => $val) {
			if($arr[$val] != '')
				$str .= $key.':'.$arr[$val].';';
		}
	}
	return $str;
}

//forkey value css pairs
function  generate_css($arr) {
	$str = '';
	if(is_array($arr)) {
		foreach($arr as $key => $val) {
			$str .= $key.':'.$val.';';
		}
	}
	return $str;
}
?>
