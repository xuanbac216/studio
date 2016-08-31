<?php //netteCache[01]000544a:2:{s:4:"time";s:21:"0.19991400 1472269981";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:58:"D:\xampp\htdocs\bacnice\wp-content\themes\band\@layout.php";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\@layout.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '50fvr1nfwl')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
get_header("" ? "" : null) ?>

<?php if ($elements->unsortable['revolution-slider']->display) { NCoreMacros::includeTemplate($elements->unsortable['revolution-slider']->getTemplate(), array('el' => $elements->unsortable['revolution-slider'], 'element' => $elements->unsortable['revolution-slider'], 'htmlId' => $elements->unsortable['revolution-slider']->getHtmlId(), 'htmlClass' => $elements->unsortable['revolution-slider']->getHtmlClass()) + $template->getParameters(), $_l->templates['50fvr1nfwl'])->render() ;} ?>

<div id="main" class="elements">

<?php if ($elements->unsortable['page-title']->display) { NCoreMacros::includeTemplate($elements->unsortable['page-title']->getTemplate(), array('el' => $elements->unsortable['page-title'], 'element' => $elements->unsortable['page-title'], 'htmlId' => $elements->unsortable['page-title']->getHtmlId(), 'htmlClass' => $elements->unsortable['page-title']->getHtmlClass()) + $template->getParameters(), $_l->templates['50fvr1nfwl'])->render() ;} ?>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/breadcrumbs", ""), array() + get_defined_vars(), $_l->templates['50fvr1nfwl'])->render() ?>


	<div class="main-sections">
<?php $iterations = 0; foreach ($elements->sortable as $element) { ?>

<?php if ($element->id == 'sidebars-boundary-start') { ?>

		<div class="elements-with-sidebar">
			<div class="elements-sidebar-wrap">
<?php if ($wp->hasSidebar('left')) { get_sidebar("left" ? "left" : null) ;} ?>
				<div class="elements-area">

<?php } elseif ($element->id == 'sidebars-boundary-end') { ?>

				</div><!-- .elements-area -->
<?php if ($wp->hasSidebar('right')) { get_sidebar("" ? "" : null) ;} ?>
				</div><!-- .elements-sidebar-wrap -->
			</div><!-- .elements-with-sidebar -->

<?php } else { global $post ;if ($element->id == 'comments' && $post == null) { ?>
				<!-- COMMENTS DISABLED - IS NOT SINGLE PAGE -->
<?php } elseif ($element->id == 'comments' && !comments_open($post->ID) && get_comments_number($post->ID) == 0) { ?>
				<!-- COMMENTS DISABLED -->
<?php } else { if ($element->display) { ?>				<section id="<?php echo NTemplateHelpers::escapeHtml($element->htmlId, ENT_COMPAT) ?>
-main" class="<?php echo NTemplateHelpers::escapeHtml($element->htmlClasses, ENT_COMPAT) ?>">

					<div class="elm-wrapper <?php echo NTemplateHelpers::escapeHtml($element->htmlClass, ENT_COMPAT) ?>-wrapper">

<?php NCoreMacros::includeTemplate($element->getTemplate(), array('el' => $element, 'element' => $element, 'htmlId' => $element->getHtmlId(), 'htmlClass' => $element->getHtmlClass()) + $template->getParameters(), $_l->templates['50fvr1nfwl'])->render() ?>

					</div><!-- .elm-wrapper -->

				</section>
<?php } } } $iterations++; } ?>
	</div><!-- .main-sections -->
</div><!-- #main .elements -->

<?php get_footer("" ? "" : null) ;