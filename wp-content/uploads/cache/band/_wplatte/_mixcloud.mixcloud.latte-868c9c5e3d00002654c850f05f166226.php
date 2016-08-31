<?php //netteCache[01]000575a:2:{s:4:"time";s:21:"0.93269500 1472269983";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:89:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\mixcloud\mixcloud.latte";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\mixcloud\mixcloud.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'qvhmb70yfk')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
NCoreMacros::includeTemplate($element->common('header'), $template->getParameters(), $_l->templates['qvhmb70yfk'])->render() ?>

<div id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>" class="<?php echo NTemplateHelpers::escapeHtml($htmlClass, ENT_COMPAT) ?>">

	<iframe height="<?php echo NTemplateHelpers::escapeHtml($el->option('height'), ENT_COMPAT) ?>
" src="http://www.mixcloud.com/widget/iframe/?feed=<?php echo NTemplateHelpers::escapeHtml($el->option('url'), ENT_COMPAT) ?>
&amp;stylecolor=<?php echo str_replace('#', '', $el->option('color')) ?>&amp;embed_type=widget_standard&amp;hide_cover=<?php if ($el->option('showArtwork')) { ?>
0<?php } else { ?>1<?php } ?>"></iframe>

</div>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("ait-theme/elements/mixcloud/javascript", ""), array() + get_defined_vars(), $_l->templates['qvhmb70yfk'])->render() ;