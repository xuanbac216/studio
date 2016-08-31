<?php //netteCache[01]000581a:2:{s:4:"time";s:21:"0.62620600 1472270002";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:95:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\easy-slider\easy-slider.latte";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\easy-slider\easy-slider.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '3oe43bn88g')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
NCoreMacros::includeTemplate($element->common('header'), $template->getParameters(), $_l->templates['3oe43bn88g'])->render() ?>

<div id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>" class="<?php echo NTemplateHelpers::escapeHtml($htmlClass, ENT_COMPAT) ?>
 easy-pager-<?php echo NTemplateHelpers::escapeHtml($el->option('pagerType'), ENT_COMPAT) ?>
 pager-pos-<?php echo NTemplateHelpers::escapeHtml($el->option('pagerPosition'), ENT_COMPAT) ?>">

	<div class="loading"><span class="ait-preloader"><?php echo __('Loading&hellip;', 'wplatte') ?></span></div>

<?php $OffsetClass = '' ?>
	<?php if ($el->option->descVoffset == "") { ?>	<?php $el->option->descVoffset = 0 ?>
	<?php } ?>

	<?php if ($el->option->descHoffset == "") { ?>	<?php $el->option->descHoffset = 0 ?>
	<?php } ?>


	<?php if ($el->option->descVoffset != 0) { ?>	<?php $OffsetClass = 'V-Offset' ?>
		<?php } ?>

	<?php if ($el->option->descHoffset != 0) { ?>	<?php $OffsetClass = 'H-Offset' ?>
		<?php } ?>


<?php if ($el->option->descVoffset != 0 and $el->option->descHoffset != 0) { $OffsetClass = 'VH-Offset' ;} ?>

<?php if ($el->option('slides')) { ?>
	<ul class="easy-slider <?php echo NTemplateHelpers::escapeHtml($OffsetClass, ENT_COMPAT) ?>
 descanimation-<?php echo NTemplateHelpers::escapeHtml($el->option('descriptionAnimation'), ENT_COMPAT) ?>">
<?php $iterations = 0; foreach ($el->option('slides') as $slide) { $ratio = explode(":", $element->option('imageFormat')) ;if ($el->option("contentSize") == "fullsize") { $iWidth = 1920 ;} else { $iWidth = $options->theme->general->websiteWidth ;} ?>

<?php $iHeight = ($iWidth / $ratio[0]) * $ratio[1] ?>
		<li class="<?php echo NTemplateHelpers::escapeHtml($slide['descriptionPosition'], ENT_COMPAT) ?>">
			<?php if ($slide['link']) { ?><a href="<?php echo NTemplateHelpers::escapeHtml($slide['link'], ENT_COMPAT) ?>
" <?php if ($el->option->linkTarget) { ?>target="_blank"<?php } ?>><?php } ?>

				<img src="<?php echo aitResizeImage($slide['image'], array('width' => $iWidth, 'height' => $iHeight, 'crop' => 1)) ?>
" alt="<?php echo NTemplateHelpers::escapeHtml($slide['title'], ENT_COMPAT) ?>" />
<?php if ($slide['title'] != "" || $slide['description'] != "") { ?>
				<div class="bx-caption">
					<div class="bx-caption-wrap">
						<div class="bx-cap-table"><div class="bx-cap-row"><div class="bx-cap-cell">

							<div class="bx-caption-desc" style="<?php if ($slide['descWidth'] != "") { ?>
width: <?php echo NTemplateHelpers::escapeHtml(NTemplateHelpers::escapeCss($slide['descWidth']), ENT_COMPAT) ?>
px;<?php } ?>">
								<div class="bx-caption-desc-wrap <?php echo NTemplateHelpers::escapeHtml($slide['descriptionAlign'], ENT_COMPAT) ?>">
									<?php if ($slide['title'] != "") { ?><h3 class="bx-title"><?php echo $slide['title'] ?>
</h3><?php } ?>

									<?php if ($slide['description'] != "") { ?><p><?php echo $slide['description'] ?>
</p><?php } ?>

									<?php if ($slide['button'] != "") { ?><span class="bx-link-button"><?php echo NTemplateHelpers::escapeHtml($slide['button'], ENT_NOQUOTES) ?>
</span><?php } ?>

								</div>
							</div>

						</div></div></div>
					</div>
				</div>
<?php } ?>
			<?php if ($slide['link']) { ?></a><?php } ?>

		</li>
<?php $iterations++; } ?>
	</ul>
<?php } ?>


<?php if ($el->option('pagerType') == "thumbnails") { ?>
	<div class="easy-slider-pager">
	<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($el->option('slides')) as $slide) { ?><!--
		--><a data-slide-index="<?php echo NTemplateHelpers::escapeHtml($iterator->getCounter()-1, ENT_COMPAT) ?>
" href="#"><img src="<?php echo aitResizeImage($slide['image'], array('width' => 100, 'height' => 70, 'crop' => 1)) ?>
" alt="<?php echo $slide['title'] ?>" /></a><!--
	--><?php $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>

	</div>
<?php } ?>

</div>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("ait-theme/elements/easy-slider/javascript", ""), array() + get_defined_vars(), $_l->templates['3oe43bn88g'])->render() ;