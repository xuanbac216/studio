<?php //netteCache[01]000579a:2:{s:4:"time";s:21:"0.97809400 1472269985";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:93:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\google-map\google-map.latte";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\google-map\google-map.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '4tma8m8p2p')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
NCoreMacros::includeTemplate($element->common('header'), $template->getParameters(), $_l->templates['4tma8m8p2p'])->render() ?>

<div id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>" class="<?php echo NTemplateHelpers::escapeHtml($htmlClass, ENT_COMPAT) ?>">

	<div id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>-container" class="google-map-container" style="height: <?php echo NTemplateHelpers::escapeHtml(NTemplateHelpers::escapeCss($el->option('height')), ENT_COMPAT) ?>px;">

	</div>

<?php $address = $el->option('address') ;if (isset($address['address']) == false) { $address = AitLangs::getCurrentLocaleText($address) ;} $scrollWheel = $el->option('mousewheelZoom') ? "true" : "false" ?>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("ait-theme/elements/google-map/javascript", ""), array() + get_defined_vars(), $_l->templates['4tma8m8p2p'])->render() ?>

</div>