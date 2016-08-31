<?php //netteCache[01]000555a:2:{s:4:"time";s:21:"0.79760400 1472280812";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:69:"D:\xampp\htdocs\bacnice\wp-content\themes\band\parts\post-content.php";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\parts\post-content.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'azj39gh41c')
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

<?php if (!$wp->isSingular) { ?>

<?php if ($wp->isSearch) { ?>

						<article <?php echo $post->htmlId ?> <?php echo $post->htmlClass ?>>
				<header class="entry-header">

					<div class="entry-title">
						<div class="entry-title-wrap">

							<h2><a href="<?php echo NTemplateHelpers::escapeHtml($post->permalink, ENT_COMPAT) ?>
"><?php echo $post->title ?></a></h2>

							<div class="entry-data">
<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/entry-date", ""), array() + get_defined_vars(), $_l->templates['azj39gh41c'])->render() ;if ($post->isInAnyCategory) { NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/entry-categories", ""), array() + get_defined_vars(), $_l->templates['azj39gh41c'])->render() ;} ?>
							</div>

						</div><!-- /.entry-title-wrap -->
					</div><!-- /.entry-title -->
				</header><!-- /.entry-header -->

				<div class="entry-content loop">
					<?php echo $post->excerpt ?>

				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<a href="<?php echo NTemplateHelpers::escapeHtml($post->permalink, ENT_COMPAT) ?>
" class="more"><?php echo $template->printf(__('%s Continue reading ...', 'wplatte'), '<span class="meta-nav">&rarr;</span>') ?></a>
				</footer><!-- /.entry-footer -->
			</article>

<?php } else { ?>

						<article <?php echo $post->htmlId ;if ($_l->tmp = array_filter(array($post->imageUrl ? $post->htmlClass('', false) : $post->htmlClass('no-post-thumbnail',false)))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>

				<div class="entry-thumbnail">
<?php if ($post->hasImage) { ?>
						<div class="entry-thumbnail-wrap entry-content">
							<a href="<?php echo NTemplateHelpers::escapeHtml($post->permalink, ENT_COMPAT) ?>" class="thumb-link">
								<span class="entry-thumbnail-icon">
									<img src="<?php echo aitResizeImage($post->imageUrl, array('width' => 640, 'height' => 420, 'crop' => 1)) ?>" />
								</span>
							</a>
						</div>
<?php } ?>

				</div>

				<header class="entry-header <?php if (!$post->hasImage) { ?>nothumbnail<?php } ?>">

					<div class="entry-title">
						<div class="entry-title-wrap">

							<h2><a href="<?php echo NTemplateHelpers::escapeHtml($post->permalink, ENT_COMPAT) ?>
"><?php echo $post->title ?></a></h2>

							<div class="entry-data">
<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/entry-date", ""), array() + get_defined_vars(), $_l->templates['azj39gh41c'])->render() ;if ($post->type == 'post') { NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/entry-author", ""), array() + get_defined_vars(), $_l->templates['azj39gh41c'])->render() ;} NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/comments-link", ""), array() + get_defined_vars(), $_l->templates['azj39gh41c'])->render() ?>
							</div>

						</div><!-- /.entry-title-wrap -->
					</div><!-- /.entry-title -->


				</header><!-- /.entry-header -->

				<div class="entry-content loop">
<?php if ($post->hasContent) { ?>
						<?php echo $post->excerpt ?>

<?php } else { ?>
						<?php echo $post->content ?>

<?php } ?>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<a href="<?php echo NTemplateHelpers::escapeHtml($post->permalink, ENT_COMPAT) ?>
" class="more"><?php echo $template->printf(__('%s Continue reading ...', 'wplatte'), '<span class="meta-nav">&rarr;</span>') ?></a>

					<div class="entry-meta">
<?php if ($post->isSticky and !$wp->isPaged and $wp->isHome) { ?>
							<span class="featured-post"><?php echo NTemplateHelpers::escapeHtml(__('Featured post', 'wplatte'), ENT_NOQUOTES) ?></span>
<?php } ?>

						<?php ob_start() ?><span class="edit-link"><?php echo __('Edit', 'wplatte') ?>
</span><?php $editLinkLabel = ob_get_clean() ?>

						<?php echo $post->editLink($editLinkLabel) ?>

					</div><!-- /.entry-meta -->

<?php if ($post->isInAnyCategory) { NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/entry-categories", ""), array() + get_defined_vars(), $_l->templates['azj39gh41c'])->render() ;} ?>

				</footer><!-- .entry-footer -->
			</article>
<?php } ?>

<?php } else { ?>

				<article <?php echo $post->htmlId ?> class="content-block">

<?php if ($post->imageUrl) { ?>
				<div class="entry-thumbnail">
					<div class="entry-thumbnail-wrap">
						<a href="<?php echo NTemplateHelpers::escapeHtml($post->imageUrl, ENT_COMPAT) ?>" class="thumb-link">
							<span class="entry-thumbnail-icon">
								<img src="<?php echo aitResizeImage($post->imageUrl, array('width' => 1000, 'height' => 500, 'crop' => 1)) ?>
" alt="<?php echo NTemplateHelpers::escapeHtml($titleName, ENT_COMPAT) ?>" />
							</span>
						</a>
					</div>
				</div>
<?php } ?>

			<div class="entry-data">
				<div class="entry-data-left">
<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/entry-date", ""), array() + get_defined_vars(), $_l->templates['azj39gh41c'])->render() ;NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/entry-author", ""), array() + get_defined_vars(), $_l->templates['azj39gh41c'])->render() ;NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/comments-link", ""), array() + get_defined_vars(), $_l->templates['azj39gh41c'])->render() ?>
				</div>
				<div class="entry-data-right">
<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/entry-categories", ""), array() + get_defined_vars(), $_l->templates['azj39gh41c'])->render() ?>
				</div>
			</div>

			<div class="entry-content">
				<?php echo $post->content ?>

				<?php echo $post->linkPages ?>

			</div><!-- .entry-content -->

			<footer class="entry-footer">
<?php if ($wp->isSingle and $post->author->bio and $post->author->isMulti) { NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/author-bio", ""), array() + get_defined_vars(), $_l->templates['azj39gh41c'])->render() ;} ?>
			</footer><!-- .entry-footer -->
		</article>

<?php } 