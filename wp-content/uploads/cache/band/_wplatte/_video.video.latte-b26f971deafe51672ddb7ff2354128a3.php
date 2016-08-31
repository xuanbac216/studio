<?php //netteCache[01]000569a:2:{s:4:"time";s:21:"0.84095800 1472270004";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:83:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\video\video.latte";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\video\video.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'uvhalad11p')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
NCoreMacros::includeTemplate($element->common('header'), $template->getParameters(), $_l->templates['uvhalad11p'])->render() ?>

<div id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>" class="<?php echo NTemplateHelpers::escapeHtml($htmlClass, ENT_COMPAT) ?>">
<?php if ($el->option('type') == 'youtube') { ?>
			<iframe
				src="<?php echo AitWpLatteMacros::makeVideoEmbedUrl($el->option('link')) ?>"
				<?php if ($el->option('width') == "") { ?>style="width: 100%"<?php } else { ?>
width="<?php echo NTemplateHelpers::escapeHtml($el->option('width'), ENT_COMPAT) ?>
"<?php } ?> height="<?php echo NTemplateHelpers::escapeHtml($el->option('height'), ENT_COMPAT) ?>"
				allowfullscreen
			>
			</iframe>
<?php } else { ?>
		<iframe
			src="<?php echo AitWpLatteMacros::makeVideoEmbedUrl($el->option('link')) ?>"
			<?php if ($el->option('width') == "") { ?>style="width: 100%"<?php } else { ?>
width="<?php echo NTemplateHelpers::escapeHtml($el->option('width'), ENT_COMPAT) ?>
"<?php } ?> height="<?php echo NTemplateHelpers::escapeHtml($el->option('height'), ENT_COMPAT) ?>"
		>
		</iframe>
<?php } ?>

</div>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("ait-theme/elements/video/javascript", ""), array() + get_defined_vars(), $_l->templates['uvhalad11p'])->render() ;