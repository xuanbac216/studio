<?php //netteCache[01]000571a:2:{s:4:"time";s:21:"0.67121000 1472270004";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:85:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\member\member.latte";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\member\member.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'yeeyydbl3y')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
NCoreMacros::includeTemplate($element->common('header'), $template->getParameters(), $_l->templates['yeeyydbl3y'])->render() ?>

<div id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>" class="<?php echo NTemplateHelpers::escapeHtml($htmlClass, ENT_COMPAT) ?>">

<?php $query = WpLatteMacros::prepareCustomWpQuery(array('id' => $el->option('member'),
		'type' => 'member')) ?>

<?php if ($query->havePosts) { foreach ($iterator = new WpLatteLoopIterator($query) as $member): $meta = $member->meta('member') ;$target = $el->option('linksInNewWindow') ? 'target="_blank"':null ?>

			<div<?php if ($_l->tmp = array_filter(array('member-container', !$member->hasImage ? 'noimage':null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
				<h3><?php echo NTemplateHelpers::escapeHtml($member->title, ENT_NOQUOTES) ?></h3>

<?php if ($member->hasImage) { $ratio = explode(":", $element->option('imageHeight')) ;$iWidth = 300 ;$iHeight = ($iWidth / $ratio[0]) * $ratio[1] ?>
					<div class="photo-wrap">
						<img src="<?php echo aitResizeImage($member->imageUrl, array('width' => $iWidth, 'height' => $iHeight, 'crop' => 1)) ?>" alt="photo" />
					</div>
<?php } ?>
				<div class="desc-wrap">
					<div class="member-title">
<?php if ($meta->position) { ?>
														<div class="member-position"><?php echo $template->printf(_x('%1$sPosition:%2$s %3$s', 'job position', 'wplatte'), '<span class="member-position-title">', '</span>', esc_html($meta->position)) ?></div>
<?php } ?>
					</div>

					<div class="entry-content"><?php echo $meta->about ?></div>

					<div class="social-wrap">
						<ul class="member-icons"><!--
<?php $iterations = 0; foreach ($meta->icons as $icon) { ?>
							--><li><a href="<?php echo NTemplateHelpers::escapeHtml($icon['url'], ENT_COMPAT) ?>
" <?php echo 'target' ?> title="<?php echo $icon['title'] ?>"><img src="<?php echo NTemplateHelpers::escapeHtml($icon['image'], ENT_COMPAT) ?>" alt="icon" /></a></li><!--
<?php $iterations++; } ?>
						--></ul>
					</div>
				</div>
			</div>
<?php endforeach; wp_reset_postdata() ?>

<?php } else { ?>
		<div class="member-container">
			<div class="alert alert-info">
				<?php echo NTemplateHelpers::escapeHtml(_x('Member', 'name of element', 'wplatte'), ENT_NOQUOTES) ?>
&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo NTemplateHelpers::escapeHtml(__('Info: Select some member in the Member element, please.', 'wplatte'), ENT_NOQUOTES) ?>

			</div>
		</div>
<?php } ?>
</div>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("ait-theme/elements/member/javascript", ""), array() + get_defined_vars(), $_l->templates['yeeyydbl3y'])->render() ;