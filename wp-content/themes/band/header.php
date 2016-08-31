<!doctype html>
<!--[if IE 8]>
<html {languageAttributes}  class="lang-{$currentLang->locale} {$options->layout->custom->pageHtmlClass} ie ie8">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)]><!-->
<html {languageAttributes} class="lang-{$currentLang->locale} {$options->layout->custom->pageHtmlClass}">
<!--<![endif]-->
<head>
	<meta charset="{$wp->charset}">
	<meta name="viewport" content="width=device-width, target-densityDpi=device-dpi">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="{$wp->pingbackUrl}">

	{if $options->theme->general->favicon != ""}
		<link href="{$options->theme->general->favicon}" rel="icon" type="image/x-icon" />
	{/if}

	{includePart parts/seo}

	{googleAnalytics $options->theme->google->analyticsTrackingId}

	{wpHead}
</head>
<body {!$wp->bodyHtmlClass}>
	{* usefull for inline scripts like facebook social plugins scripts, etc... *}
	{doAction ait-html-body-begin}

	<div id="page" class="hfeed page-container">

		{if $options->theme->header->headerType == 'header-two'}
			<header id="masthead" class="site-header" role="banner">
				<div class="grid-main">
					<div class="header-container">
						<div class="site-logo">
							{if $options->theme->header->logo}
							<a href="{$homeUrl}" title="{$wp->name}" rel="home"><img src="{$options->theme->header->logo}" alt="logo"></a>
							{else}
							<div class="site-title"><a href="{$homeUrl}" title="{$wp->name}" rel="home">{$wp->name}</a></div>
							{/if}
							<p class="site-description">{$wp->description}</p>
						</div>

						<div class="header-table-wrap">
							<div class="header-row-wrap">
								<div class="menu-container">
									<nav class="main-nav" role="navigation">
										{* <a class="assistive-text" href="#content" title="{__ 'Skip to content'}">{__ 'Skip to content'}</a> *}
										<div class="main-nav-wrap">
											<h3 class="menu-toggle">{__ 'Menu'}</h3>
											{menu main}
										</div>
									</nav>
								</div>

								<div class="site-tools">

									{if $options->theme->social->enableSocialIcons}
									<div class="social-icons">
										<ul><!--
											{foreach $options->theme->social->socIcons as $icon}
												--><li><a href="{$icon->url}" {if $options->theme->social->socIconsNewWindow}target="_blank"{/if}><img src="{$icon->icon}" class="s-icon" alt="icon"><span class="s-title">{$icon->title}</span></a></li><!--
											{/foreach}
										--></ul>
									</div>
									{/if}

									{includePart parts/languages-switcher}
									{includePart parts/woocommerce-cart}

								</div>
							</div>
						</div>

					</div>
				</div>
			</header><!-- #masthead -->
		{elseif $options->theme->header->headerType == 'header-three'}
			<header id="masthead" class="site-header" role="banner">

				<div class="header-separator">

					<div class="grid-main">
						<div class="header-table-wrap">
							<div class="header-container">

								<div class="header-cell-wrap">
									<div class="site-logo">
										{if $options->theme->header->logo}
										<a href="{$homeUrl}" title="{$wp->name}" rel="home"><img src="{$options->theme->header->logo}" alt="logo"></a>
										{else}
										<div class="site-title"><a href="{$homeUrl}" title="{$wp->name}" rel="home">{$wp->name}</a></div>
										{/if}
										<p class="site-description">{$wp->description}</p>
									</div>

								</div>
								<div class="header-cell-wrap">
									<div class="site-tools">

										{includePart parts/languages-switcher}
										{includePart parts/woocommerce-cart}

										{if $options->theme->social->enableSocialIcons}
										<div class="social-icons">
											<ul><!--
												{foreach $options->theme->social->socIcons as $icon}
													--><li><a href="{$icon->url}" {if $options->theme->social->socIconsNewWindow}target="_blank"{/if}><img src="{$icon->icon}" class="s-icon" alt="icon"><span class="s-title">{$icon->title}</span></a></li><!--
												{/foreach}
											--></ul>
										</div>
										{/if}

										<div class="site-search">
											{searchForm}
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
							{* <a class="assistive-text" href="#content" title="{__ 'Skip to content'}">{__ 'Skip to content'}</a> *}
							<div class="main-nav-wrap">
								<h3 class="menu-toggle">{__ 'Menu'}</h3>
								{menu main}
							</div>
						</nav>
					</div>

				</div>
			</header><!-- #masthead -->
		{elseif $options->theme->header->headerType == 'header-four'}
			<header id="masthead" class="site-header" role="banner">
				<div class="grid-main">
					<div class="header-table-wrap">
						<div class="header-container">
							<div class="header-cell-wrap">

								<div class="site-logo">
									{if $options->theme->header->logo}
									<a href="{$homeUrl}" title="{$wp->name}" rel="home"><img src="{$options->theme->header->logo}" alt="logo"></a>
									{else}
									<div class="site-title"><a href="{$homeUrl}" title="{$wp->name}" rel="home">{$wp->name}</a></div>
									{/if}
									<p class="site-description">{$wp->description}</p>
								</div>

							</div>

							<div class="header-cell-wrap">
								<div class="site-tools">
									{includePart parts/languages-switcher}
									{includePart parts/woocommerce-cart}

									{if $options->theme->social->enableSocialIcons}
									<div class="social-icons">
										<ul><!--
											{foreach $options->theme->social->socIcons as $icon}
												--><li><a href="{$icon->url}" {if $options->theme->social->socIconsNewWindow}target="_blank"{/if}><img src="{$icon->icon}" class="s-icon" alt="icon"><span class="s-title">{$icon->title}</span></a></li><!--
											{/foreach}
										--></ul>
									</div>
									{/if}

								</div>

								<div class="menu-container">
									<nav class="main-nav" role="navigation">
										{* <a class="assistive-text" href="#content" title="{__ 'Skip to content'}">{__ 'Skip to content'}</a> *}
										<div class="main-nav-wrap">
											<h3 class="menu-toggle">{__ 'Menu'}</h3>
											{menu main}
										</div>
									</nav>
								</div>
							</div>

						</div>
					</div>
				</div>
			</header><!-- #masthead -->
		{else}
			<header id="masthead" class="site-header" role="banner">
				<div class="grid-main">
					<div class="header-table-wrap">
						<div class="header-container">
							<div class="site-logo">
								{if $options->theme->header->logo}
								<a href="{$homeUrl}" title="{$wp->name}" rel="home"><img src="{$options->theme->header->logo}" alt="logo"></a>
								{else}
								<div class="site-title"><a href="{$homeUrl}" title="{$wp->name}" rel="home">{$wp->name}</a></div>
								{/if}
								<p class="site-description">{$wp->description}</p>
							</div>

							<div class="menu-container">
								<nav class="main-nav" role="navigation">
									{* <a class="assistive-text" href="#content" title="{__ 'Skip to content'}">{__ 'Skip to content'}</a> *}
									<div class="main-nav-wrap">
										<h3 class="menu-toggle">{__ 'Menu'}</h3>
										{menu main}
									</div>
								</nav>
							</div>

							<div class="site-tools">
								{includePart parts/languages-switcher}
								{includePart parts/woocommerce-cart}
							</div>

						</div>
					</div>
				</div>
			</header><!-- #masthead -->
		{/if}

		<div class="sticky-menu">
			<div class="grid-main">
				<div class="site-logo">
					{if $options->theme->header->logo}
					<a href="{$homeUrl}" title="{$wp->name}" rel="home"><img src="{$options->theme->header->logo}" alt="logo"></a>
					{else}
					<div class="site-title"><a href="{$homeUrl}" title="{$wp->name}" rel="home">{$wp->name}</a></div>
					{/if}
				</div>
				<nav class="main-nav">
					<!-- wp menu here -->
				</nav>
			</div>
		</div>
