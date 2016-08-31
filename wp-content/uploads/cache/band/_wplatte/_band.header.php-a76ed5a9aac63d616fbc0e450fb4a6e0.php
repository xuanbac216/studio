<?php //netteCache[01]000543a:2:{s:4:"time";s:21:"0.30411000 1472269981";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:57:"D:\xampp\htdocs\bacnice\wp-content\themes\band\header.php";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\header.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'bd6yyk9mc9')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>
<!doctype html>
<!--[if IE 8]>
<html <?php language_attributes() ?>  class="lang-<?php echo NTemplateHelpers::escapeHtmlComment($currentLang->locale) ?>
 <?php echo NTemplateHelpers::escapeHtmlComment($options->layout->custom->pageHtmlClass) ?> ie ie8">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)]><!-->
<html <?php language_attributes() ?> class="lang-<?php echo NTemplateHelpers::escapeHtml($currentLang->locale, ENT_COMPAT) ?>
 <?php echo NTemplateHelpers::escapeHtml($options->layout->custom->pageHtmlClass, ENT_COMPAT) ?>">
<!--<![endif]-->
<head>
	<meta charset="<?php echo NTemplateHelpers::escapeHtml($wp->charset, ENT_COMPAT) ?>" />
	<meta name="viewport" content="width=device-width, target-densityDpi=device-dpi" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php echo NTemplateHelpers::escapeHtml($wp->pingbackUrl, ENT_COMPAT) ?>" />

<?php if ($options->theme->general->favicon != "") { ?>
		<link href="<?php echo NTemplateHelpers::escapeHtml($options->theme->general->favicon, ENT_COMPAT) ?>" rel="icon" type="image/x-icon" />
<?php } ?>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/seo", ""), array() + get_defined_vars(), $_l->templates['bd6yyk9mc9'])->render() ?>

	<?php echo AitWpLatteMacros::googleAnalytics($options->theme->google->analyticsTrackingId) ?>


<?php wp_head() ?>
</head>
<body <?php echo $wp->bodyHtmlClass ?>>
<?php do_action('ait-html-body-begin') ?>

	<div id="page" class="hfeed page-container">

<?php if ($options->theme->header->headerType == 'header-two') { ?>
			<header id="masthead" class="site-header" role="banner">
				<div class="grid-main">
					<div class="header-container">
						<div class="site-logo">
<?php if ($options->theme->header->logo) { ?>
							<a href="<?php echo NTemplateHelpers::escapeHtml($homeUrl, ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_COMPAT) ?>" rel="home"><img src="<?php echo NTemplateHelpers::escapeHtml($options->theme->header->logo, ENT_COMPAT) ?>" alt="logo" /></a>
<?php } else { ?>
							<div class="site-title"><a href="<?php echo NTemplateHelpers::escapeHtml($homeUrl, ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_COMPAT) ?>" rel="home"><?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_NOQUOTES) ?></a></div>
<?php } ?>
							<p class="site-description"><?php echo NTemplateHelpers::escapeHtml($wp->description, ENT_NOQUOTES) ?></p>
						</div>

						<div class="header-table-wrap">
							<div class="header-row-wrap">
								<div class="menu-container">
									<nav class="main-nav" role="navigation">
																				<div class="main-nav-wrap">
											<h3 class="menu-toggle"><?php echo NTemplateHelpers::escapeHtml(__('Menu', 'wplatte'), ENT_NOQUOTES) ?></h3>
<?php WpLatteMacros::menu("main", array()) ?>
										</div>
									</nav>
								</div>

								<div class="site-tools">

<?php if ($options->theme->social->enableSocialIcons) { ?>
									<div class="social-icons">
										<ul><!--
<?php $iterations = 0; foreach ($options->theme->social->socIcons as $icon) { ?>
												--><li><a href="<?php echo NTemplateHelpers::escapeHtml($icon->url, ENT_COMPAT) ?>
" <?php if ($options->theme->social->socIconsNewWindow) { ?>target="_blank"<?php } ?>
><img src="<?php echo NTemplateHelpers::escapeHtml($icon->icon, ENT_COMPAT) ?>" class="s-icon" alt="icon" /><span class="s-title"><?php echo NTemplateHelpers::escapeHtml($icon->title, ENT_NOQUOTES) ?></span></a></li><!--
<?php $iterations++; } ?>
										--></ul>
									</div>
<?php } ?>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/languages-switcher", ""), array() + get_defined_vars(), $_l->templates['bd6yyk9mc9'])->render() ;NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/woocommerce-cart", ""), array() + get_defined_vars(), $_l->templates['bd6yyk9mc9'])->render() ?>

								</div>
							</div>
						</div>

					</div>
				</div>
			</header><!-- #masthead -->
<?php } elseif ($options->theme->header->headerType == 'header-three') { ?>
			<header id="masthead" class="site-header" role="banner">

				<div class="header-separator">

					<div class="grid-main">
						<div class="header-table-wrap">
							<div class="header-container">

								<div class="header-cell-wrap">
									<div class="site-logo">
<?php if ($options->theme->header->logo) { ?>
										<a href="<?php echo NTemplateHelpers::escapeHtml($homeUrl, ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_COMPAT) ?>" rel="home"><img src="<?php echo NTemplateHelpers::escapeHtml($options->theme->header->logo, ENT_COMPAT) ?>" alt="logo" /></a>
<?php } else { ?>
										<div class="site-title"><a href="<?php echo NTemplateHelpers::escapeHtml($homeUrl, ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_COMPAT) ?>" rel="home"><?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_NOQUOTES) ?></a></div>
<?php } ?>
										<p class="site-description"><?php echo NTemplateHelpers::escapeHtml($wp->description, ENT_NOQUOTES) ?></p>
									</div>

								</div>
								<div class="header-cell-wrap">
									<div class="site-tools">

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/languages-switcher", ""), array() + get_defined_vars(), $_l->templates['bd6yyk9mc9'])->render() ;NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/woocommerce-cart", ""), array() + get_defined_vars(), $_l->templates['bd6yyk9mc9'])->render() ?>

<?php if ($options->theme->social->enableSocialIcons) { ?>
										<div class="social-icons">
											<ul><!--
<?php $iterations = 0; foreach ($options->theme->social->socIcons as $icon) { ?>
													--><li><a href="<?php echo NTemplateHelpers::escapeHtml($icon->url, ENT_COMPAT) ?>
" <?php if ($options->theme->social->socIconsNewWindow) { ?>target="_blank"<?php } ?>
><img src="<?php echo NTemplateHelpers::escapeHtml($icon->icon, ENT_COMPAT) ?>" class="s-icon" alt="icon" /><span class="s-title"><?php echo NTemplateHelpers::escapeHtml($icon->title, ENT_NOQUOTES) ?></span></a></li><!--
<?php $iterations++; } ?>
											--></ul>
										</div>
<?php } ?>

										<div class="site-search">
<?php get_search_form() ?>
										</div>

									</div>
								</div>

							</div>
						</div> <!-- .header-table-wrap */ -->

					</div>

				</div>

				<div class="grid-main">

					<div class="menu-container">
						<nav class="main-nav" role="navigation">
														<div class="main-nav-wrap">
								<h3 class="menu-toggle"><?php echo NTemplateHelpers::escapeHtml(__('Menu', 'wplatte'), ENT_NOQUOTES) ?></h3>
<?php WpLatteMacros::menu("main", array()) ?>
							</div>
						</nav>
					</div>

				</div>
			</header><!-- #masthead -->
<?php } elseif ($options->theme->header->headerType == 'header-four') { ?>
			<header id="masthead" class="site-header" role="banner">
				<div class="grid-main">
					<div class="header-table-wrap">
						<div class="header-container">
							<div class="header-cell-wrap">

								<div class="site-logo">
<?php if ($options->theme->header->logo) { ?>
									<a href="<?php echo NTemplateHelpers::escapeHtml($homeUrl, ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_COMPAT) ?>" rel="home"><img src="<?php echo NTemplateHelpers::escapeHtml($options->theme->header->logo, ENT_COMPAT) ?>" alt="logo" /></a>
<?php } else { ?>
									<div class="site-title"><a href="<?php echo NTemplateHelpers::escapeHtml($homeUrl, ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_COMPAT) ?>" rel="home"><?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_NOQUOTES) ?></a></div>
<?php } ?>
									<p class="site-description"><?php echo NTemplateHelpers::escapeHtml($wp->description, ENT_NOQUOTES) ?></p>
								</div>

							</div>

							<div class="header-cell-wrap">
								<div class="site-tools">
<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/languages-switcher", ""), array() + get_defined_vars(), $_l->templates['bd6yyk9mc9'])->render() ;NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/woocommerce-cart", ""), array() + get_defined_vars(), $_l->templates['bd6yyk9mc9'])->render() ?>

<?php if ($options->theme->social->enableSocialIcons) { ?>
									<div class="social-icons">
										<ul><!--
<?php $iterations = 0; foreach ($options->theme->social->socIcons as $icon) { ?>
												--><li><a href="<?php echo NTemplateHelpers::escapeHtml($icon->url, ENT_COMPAT) ?>
" <?php if ($options->theme->social->socIconsNewWindow) { ?>target="_blank"<?php } ?>
><img src="<?php echo NTemplateHelpers::escapeHtml($icon->icon, ENT_COMPAT) ?>" class="s-icon" alt="icon" /><span class="s-title"><?php echo NTemplateHelpers::escapeHtml($icon->title, ENT_NOQUOTES) ?></span></a></li><!--
<?php $iterations++; } ?>
										--></ul>
									</div>
<?php } ?>

								</div>

								<div class="menu-container">
									<nav class="main-nav" role="navigation">
																				<div class="main-nav-wrap">
											<h3 class="menu-toggle"><?php echo NTemplateHelpers::escapeHtml(__('Menu', 'wplatte'), ENT_NOQUOTES) ?></h3>
<?php WpLatteMacros::menu("main", array()) ?>
										</div>
									</nav>
								</div>
							</div>

						</div>
					</div>
				</div>
			</header><!-- #masthead -->
<?php } else { ?>
			<header id="masthead" class="site-header" role="banner">
				<div class="grid-main">
					<div class="header-table-wrap">
						<div class="header-container">
							<div class="site-logo">
<?php if ($options->theme->header->logo) { ?>
								<a href="<?php echo NTemplateHelpers::escapeHtml($homeUrl, ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_COMPAT) ?>" rel="home"><img src="<?php echo NTemplateHelpers::escapeHtml($options->theme->header->logo, ENT_COMPAT) ?>" alt="logo" /></a>
<?php } else { ?>
								<div class="site-title"><a href="<?php echo NTemplateHelpers::escapeHtml($homeUrl, ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_COMPAT) ?>" rel="home"><?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_NOQUOTES) ?></a></div>
<?php } ?>
								<p class="site-description"><?php echo NTemplateHelpers::escapeHtml($wp->description, ENT_NOQUOTES) ?></p>
							</div>

							<div class="menu-container">
								<nav class="main-nav" role="navigation">
																		<div class="main-nav-wrap">
										<h3 class="menu-toggle"><?php echo NTemplateHelpers::escapeHtml(__('Menu', 'wplatte'), ENT_NOQUOTES) ?></h3>
<?php WpLatteMacros::menu("main", array()) ?>
									</div>
								</nav>
							</div>

							<div class="site-tools">
<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/languages-switcher", ""), array() + get_defined_vars(), $_l->templates['bd6yyk9mc9'])->render() ;NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/woocommerce-cart", ""), array() + get_defined_vars(), $_l->templates['bd6yyk9mc9'])->render() ?>
							</div>

						</div>
					</div>
				</div>
			</header><!-- #masthead -->
<?php } ?>

		<div class="sticky-menu">
			<div class="grid-main">
				<div class="site-logo">
<?php if ($options->theme->header->logo) { ?>
					<a href="<?php echo NTemplateHelpers::escapeHtml($homeUrl, ENT_COMPAT) ?>" title="<?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_COMPAT) ?>
" rel="home"><img src="<?php echo NTemplateHelpers::escapeHtml($options->theme->header->logo, ENT_COMPAT) ?>" alt="logo" /></a>
<?php } else { ?>
					<div class="site-title"><a href="<?php echo NTemplateHelpers::escapeHtml($homeUrl, ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_COMPAT) ?>" rel="home"><?php echo NTemplateHelpers::escapeHtml($wp->name, ENT_NOQUOTES) ?></a></div>
<?php } ?>
				</div>
				<nav class="main-nav">
					<!-- wp menu here -->
				</nav>
			</div>
		</div>
