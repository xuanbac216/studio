<?php //netteCache[01]000546a:2:{s:4:"time";s:21:"0.49973000 1472269981";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:60:"D:\xampp\htdocs\bacnice\wp-content\themes\band\parts\seo.php";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\parts\seo.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'eyu9cqxq8r')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if (defined('WPSEO_VERSION')) { ?>
	<title><?php wp_title('|', true, 'right') ?></title>
<?php } elseif (isset($elements->unsortable['seo']) && $wp->isPage) { if ($elements->unsortable['seo']->display) { if ($elements->unsortable['seo']->option->keywords != "") { ?>
			<meta name="keywords" content="<?php echo NTemplateHelpers::escapeHtml($elements->unsortable['seo']->option->keywords, ENT_COMPAT) ?>" />
<?php } if ($elements->unsortable['seo']->option->description != "") { ?>
			<meta name="description" content="<?php echo NTemplateHelpers::escapeHtml($elements->unsortable['seo']->option->description, ENT_COMPAT) ?>" />
<?php } if ($elements->unsortable['seo']->option->title != "") { ?>
			<title><?php echo NTemplateHelpers::escapeHtml($elements->unsortable['seo']->option->title, ENT_NOQUOTES) ?></title>
<?php } else { ?>
			<title><?php wp_title('|', true, 'right') ?></title>
<?php } } else { ?>
		<title><?php wp_title('|', true, 'right') ?></title>
<?php } } else { ?>
	<title><?php wp_title('|', true, 'right') ?></title>
<?php if ($wp->isTax('items') or $wp->isTax('locations')) { $category = get_queried_object() ;$cOptions = get_option($category->taxonomy."_category_".$category->term_id) ?>
		<?php if ($category->description) { ?><meta name="description" content="<?php echo NTemplateHelpers::escapeHtml($template->truncate($category->description, 150), ENT_COMPAT) ?>
" /><?php } ?>

		<?php if (isset($cOptions['keywords']) && $cOptions['keywords']) { ?><meta name="keywords" content="<?php echo NTemplateHelpers::escapeHtml($cOptions['keywords'], ENT_COMPAT) ?>
" /><?php } ?>

<?php } } 