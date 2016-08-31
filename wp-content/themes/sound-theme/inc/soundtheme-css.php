<?php
	$soundtheme_fontone = esc_attr(get_field('soundtheme_fontone' , 'option'));
	$soundtheme_fontone_family = esc_attr(get_field('soundtheme_fontone_family' , 'option'));
	$soundtheme_fonttwo = esc_attr(get_field('soundtheme_fonttwo' , 'option'));
	$soundtheme_fonttwo_family = esc_attr(get_field('soundtheme_fonttwo_family' , 'option'));
	$soundtheme_color_body = esc_attr(get_field('soundtheme_color_body' , 'option'));
	$soundtheme_color_bodyfont = esc_attr(get_field('soundtheme_color_bodyfont' , 'option'));
	$soundtheme_color_a = esc_attr(get_field('soundtheme_color_a' , 'option'));
	$soundtheme_color_ahover = esc_attr(get_field('soundtheme_color_ahover' , 'option'));
	$soundtheme_color_dark = esc_attr(get_field('soundtheme_color_dark' , 'option'));
	$soundtheme_color_darktwo = esc_attr(get_field('soundtheme_color_darktwo' , 'option'));
	$soundtheme_whiteone = esc_attr(get_field('soundtheme_whiteone' , 'option'));
	$soundtheme_whitetwo = esc_attr(get_field('soundtheme_whitetwo' , 'option'));
	$soundtheme_whitethree = esc_attr(get_field('soundtheme_whitethree' , 'option'));
	$soundtheme_whitefour = esc_attr(get_field('soundtheme_whitefour' , 'option'));
	$soundtheme_whitefive = esc_attr(get_field('soundtheme_whitefive' , 'option'));
	$soundtheme_whitesix = esc_attr(get_field('soundtheme_whitesix' , 'option'));
	$soundtheme_whiteseven = esc_attr(get_field('soundtheme_whiteseven' , 'option'));
	$soundtheme_whiteeight = esc_attr(get_field('soundtheme_whiteeight' , 'option'));
	$soundtheme_whitenine = esc_attr(get_field('soundtheme_whitenine' , 'option'));
	$soundtheme_pl_auto = esc_attr(get_field('soundtheme_pl_auto' , 'option'));
	$soundtheme_pl_twitter = esc_attr(get_field('soundtheme_pl_twitter' , 'option'));
	$soundtheme_pl_facebook = esc_attr(get_field('soundtheme_pl_facebook' , 'option'));
	$soundtheme_pl_open = esc_attr(get_field('soundtheme_pl_open' , 'option'));
	$soundtheme_pl_playshow = esc_attr(get_field('soundtheme_pl_playshow' , 'option'));

?>

<style type="text/css">

<?php if ($soundtheme_fontone) : ?>
<?php echo esc_attr($soundtheme_fontone); ?>
<?php endif; ?>

<?php if ($soundtheme_fonttwo) : ?>
<?php echo esc_attr($soundtheme_fonttwo); ?>
<?php endif; ?>

<?php if ($soundtheme_fontone_family) : ?>
h1, h2, h3, h4, h5, h6, .soundtheme-menu-icon .soundtheme-btn-sidebar, .soundtheme-top-search-form input, #fap-current-title, #fap-social-links a, .soundtheme-sidebar-tab ul li a,
.soundtheme-loading-image p, .soundtheme-post-detail blockquote p {
	<?php echo $soundtheme_fontone_family; ?>
}
<?php endif; ?>

<?php if ($soundtheme_fonttwo_family) : ?>
html, body, p, .soundtheme-big-title h1, .soundtheme-big-title h2, .soundtheme-single-titles h1, .soundtheme-comment-bigtitle h3, .soundtheme-comments-list .media-body h6,
.soundtheme-loop-list h1, .soundtheme-blog-list h2, .soundtheme-filter-posting h1, .soundtheme-filter-posting h2, .soundtheme-slidertitle h1, .soundtheme-mod-detail h1, .soundtheme-mod-detail h2,
.soundtheme-mod-dates h1, .soundtheme-mod-dates h2, .soundtheme-billboard ul li h1 {
	<?php echo $soundtheme_fonttwo_family; ?>
}
<?php endif; ?>


<?php if ($soundtheme_color_body) : ?>
html, body {
	background-color: <?php echo esc_attr($soundtheme_color_body); ?>;
}
<?php endif; ?>


<?php if ($soundtheme_color_bodyfont) : ?>
html, body, p {
	color: <?php echo esc_attr($soundtheme_color_bodyfont); ?>;
}
<?php endif; ?>

<?php if ($soundtheme_color_a) : ?>
a {
	color:<?php echo esc_attr($soundtheme_color_a); ?>;
}
<?php endif; ?>

<?php if ($soundtheme_color_ahover) : ?>
a:hover, a:focus {
	color:<?php echo esc_attr($soundtheme_color_ahover); ?>;
}
<?php endif; ?>


<?php if ($soundtheme_color_a) : ?>
.soundtheme-big-title h1, .soundtheme-mini-share ul li a:hover, .soundtheme-mini-share-two ul li a:hover, .soundtheme-btn-search:hover, .soundtheme-btn-sidebar:hover, .soundtheme-single-tracklist ol li a:hover, .soundtheme-related-title h1,
.soundtheme-comments-list .media-body small a:hover, .soundtheme-blog-list h1 a:hover, .widget ul li a:hover, .soundtheme-filter-posting h1 a:hover, .soundtheme-mod-detail h1 a:hover, .soundtheme-mod-detail-dark h1 a:hover,
.soundtheme-mod-title-dark h2, .soundtheme-billboard ul li h1 a:hover, .soundtheme-top-search, .soundtheme-top-search-form input:focus {
	color:<?php echo esc_attr($soundtheme_color_a); ?>;
}
.soundtheme-thumb-image .util-theme-default .util-prev, .soundtheme-thumb-image .util-theme-default .util-next, .soundtheme-mini-popup ul li button:hover, .btn-primary:hover, .btn-success,
.soundtheme-post-tags a:hover, .soundtheme-related-fa .fa, .soundtheme-contact-form input[type="submit"], .soundtheme-logo-footer ul li a:hover, .soundtheme-gallery-hover, .soundtheme-biography-hover, .soundtheme-navi ul li a:hover,
.soundtheme-navi ul li.current, .widget_search input[type=submit], .tagcloud a:hover, .soundtheme-filter-menu ul li.active, .soundtheme-filter-menu ul li:hover, .soundtheme-filter-random ul li.active,
.soundtheme-content-none .soundtheme-content-block h1, .parent-expanded  {
	background-color:<?php echo esc_attr($soundtheme_color_a); ?>;
}

.soundtheme-sidebar-tab ul li.active a {
	border-color: <?php echo esc_attr($soundtheme_color_a); ?>;
}
<?php endif; ?>

<?php if ($soundtheme_color_ahover) : ?>
.soundtheme-main-color-dark {
	color:<?php echo esc_attr($soundtheme_color_ahover); ?>;
}
.soundtheme-main-color-light {
	color:<?php echo esc_attr($soundtheme_color_ahover); ?>;
}
.soundtheme-main-background-dark, .soundtheme-contact-form input[type="submit"]:hover {
	background-color:<?php echo esc_attr($soundtheme_color_ahover); ?>;
}
.soundtheme-main-background-light {
	background-color:<?php echo esc_attr($soundtheme_color_ahover); ?>;
}
<?php endif; ?>

<?php if ($soundtheme_color_dark) : ?>
/* FONT COLOR */
.soundtheme-mini-share ul li, .soundtheme-mini-share ul li a, .soundtheme-mini-share-two ul li, .soundtheme-mini-share-two ul li a, .soundtheme-blog-list h1 a, .widget_search input[type=text],
.widget ul li a, .tagcloud a, .soundtheme-filter-posting h1 a, .soundtheme-mod-detail h1 a, .soundtheme-billboard ul li h1 a, .soundtheme-contact-form input[type="text"], .soundtheme-contact-form input[type="email"], .soundtheme-contact-form textarea, 
.soundtheme-contact-form input[type="submit"] {
	color:<?php echo esc_attr($soundtheme_color_dark); ?>;
}
.soundtheme-sidebar-tab ul li.active, .main-nav li > ul a, .soundtheme-mini-popup ul li button, .input-group-addon, .soundtheme-darkback-two, .soundtheme-navi ul li a, .soundtheme-navi ul li.page_nums,
.soundtheme-filter-menu ul li, .soundtheme-filter-random ul li, #fap-player-wrapper {
	background-color:<?php echo esc_attr($soundtheme_color_dark); ?>;
}
<?php endif; ?>

<?php if ($soundtheme_color_darktwo) : ?>
.soundtheme-single-tracklist ol li a, .soundtheme-post-tags a {
	color:<?php echo esc_attr($soundtheme_color_darktwo); ?>;
}
.soundtheme-sidebar-tab ul li, .soundtheme-sidebar-menu, .soundtheme-nav-fixed, .soundtheme-header-back, .btn-primary, .btn-success:hover, 
.btn-success:focus, .btn-primary:focus, .soundtheme-darkback-one, .soundtheme-logo-footer ul li a, .component-fullwidth, .soundtheme-mod-dark {
	background-color:<?php echo esc_attr($soundtheme_color_darktwo); ?>;
}
<?php endif; ?>


<?php if ($soundtheme_whiteone) : ?>
.soundtheme-sidebar-tab ul li.active a, .soundtheme-sidebar-tab ul li a:hover, .main-nav a:hover, .soundtheme-big-title h2, .soundtheme-mini-popup ul li button, .soundtheme-post-tags a:hover,
.soundtheme-related-fa .fa, .input-group-addon, .soundtheme-logo-footer ul li a:hover, .soundtheme-gallery-hover, .soundtheme-biography-hover, .soundtheme-navi ul li a, .soundtheme-navi ul li.current,
.soundtheme-navi ul li.page_nums, .widget_search input[type=submit], .tagcloud a:hover, .soundtheme-filter-menu ul li, .soundtheme-filter-random ul li, .soundtheme-slidertitle,
.soundtheme-slider-nav, .soundtheme-mod-detail-dark h1, .soundtheme-mod-detail-dark h1 a, .soundtheme-mod-title-dark h1, .soundtheme-content-none h1  {
	color: <?php echo esc_attr($soundtheme_whiteone); ?>;
}
.soundtheme-loading, .soundtheme-mini-popup, .soundtheme-post-tags a {
	background-color: <?php echo esc_attr($soundtheme_whiteone); ?>;
}
<?php endif; ?>

<?php if ($soundtheme_whitetwo) : ?>
.main-nav a, .soundtheme-menu-icon ul li button, .soundtheme-related-title h6, .soundtheme-logo-footer ul li a, .soundtheme-mod-detail-dark h2, .soundtheme-mod-detail-dark p {
	color: <?php echo esc_attr($soundtheme_whitetwo); ?>;
}
.soundtheme-single-tracklist ol li:before {
	background-color: <?php echo esc_attr($soundtheme_whitetwo); ?>;
}
<?php endif; ?>

<?php if ($soundtheme_whitethree) : ?>
.main-nav li > ul li a {
	color: <?php echo esc_attr($soundtheme_whitethree); ?>;
}
<?php endif; ?>

<?php if ($soundtheme_whitefour) : ?>
.main-nav li > ul li > ul a, .soundtheme-single-count {
	color: <?php echo esc_attr($soundtheme_whitefour); ?>;
}
<?php endif; ?>

<?php if ($soundtheme_whitefive) : ?>
.soundtheme-sidebar-tab ul li a, .soundtheme-comments-list .media-body small a {
	color: <?php echo esc_attr($soundtheme_whitefive); ?>;
}
<?php endif; ?>

<?php if ($soundtheme_whitesix) : ?>
.soundtheme-white-backone, .soundtheme-mod-light, .soundtheme-top-search, .soundtheme-contact-form input[type="text"], .soundtheme-contact-form input[type="email"], .soundtheme-contact-form textarea {
	background-color: <?php echo esc_attr($soundtheme_whitesix); ?>;
}
<?php endif; ?>

<?php if ($soundtheme_whiteseven) : ?>
.soundtheme-white-backtwo, .soundtheme-mod-grey {
	background-color: <?php echo esc_attr($soundtheme_whiteseven); ?>;
}
.soundtheme-header-bottomback, .soundtheme-single-tracklist ol li:nth-child(odd), .btn-default:hover {
	background-color:  <?php echo esc_attr($soundtheme_whiteseven); ?>;
}
<?php endif; ?>

<?php if ($soundtheme_whiteeight) : ?>
.soundtheme-single-tracklist ol li:nth-child(even), .btn-default, .soundtheme-comments-list .media-body, .form-control, 
.widget_search input[type=text], .tagcloud a, div#calendar_wrap, .soundtheme-content-none p {
	background-color:  <?php echo esc_attr($soundtheme_whiteeight); ?>;
}
.soundtheme-single-titles h1, .soundtheme-single-mininfo ul li, .soundtheme-comment-bigtitle h3, .soundtheme-blog-list h2, .widget-title, .widget ul li, .soundtheme-event-ul li,
.soundtheme-mod-playlist .soundtheme-mod-detail, .soundtheme-mod-others li, .soundtheme-billboard ul li {
	border-color:  <?php echo esc_attr($soundtheme_whiteeight); ?>;
}
<?php endif; ?>

<?php if ($soundtheme_whitenine) : ?>
.soundtheme-mod-dark .soundtheme-single-titles h1, .soundtheme-mod-dark .soundtheme-single-mininfo ul li, .soundtheme-mod-dark .soundtheme-comment-bigtitle h3,
.soundtheme-mod-dark .soundtheme-blog-list h2, .soundtheme-mod-dark .widget-title, .soundtheme-mod-dark .widget ul li, .soundtheme-mod-dark .soundtheme-event-ul li,
.soundtheme-mod-dark .soundtheme-mod-playlist .soundtheme-mod-detail, .soundtheme-mod-dark .soundtheme-mod-others li {
	border-color: <?php echo esc_attr($soundtheme_whitenine); ?>;
}
<?php endif; ?>
</style>