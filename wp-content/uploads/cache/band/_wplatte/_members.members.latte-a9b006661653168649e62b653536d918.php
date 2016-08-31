<?php //netteCache[01]000573a:2:{s:4:"time";s:21:"0.71484000 1472269985";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:87:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\members\members.latte";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\members\members.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '68bccoxbjc')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
NCoreMacros::includeTemplate($el->common('header'), $template->getParameters(), $_l->templates['68bccoxbjc'])->render() ?>

<div id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>" class="elm-item-organizer <?php echo NTemplateHelpers::escapeHtml($htmlClass, ENT_COMPAT) ?>">

<?php $query = WpLatteMacros::prepareCustomWpQuery(array('type'    => 'member',
		'tax'     => 'members',
		'cat'     => $el->option->category,
		'limit'   => $el->option->count,
		'orderby' => $el->option->orderby,
		'order' 	=> $el->option->order)) ?>

<?php if ($query->havePosts) { $layout = $el->option->layout ;$target = $el->option('linksInNewWindow') ? 'target="_blank"':null ;if ($layout == 'box') { $enableCarousel  = $el->option->boxEnableCarousel ;$boxAlign 		  = $el->option->boxAlign ;$numOfRows       = $el->option->boxRows ;$numOfColumns    = $el->option->boxColumns ;$imageHeight     = $el->option->boxImageHeight ;$imgWidth = 640 ;} else { $enableCarousel  = $el->option->listEnableCarousel ;$numOfRows       = $el->option->listRows ;$numOfColumns    = $el->option->listColumns ;$imageHeight     = $el->option->listImageHeight ;$imgWidth = 220 ;} ?>

<?php if ($enableCarousel) { ?>
			<div class="loading"><span class="ait-preloader"><?php echo __('Loading&hellip;', 'wplatte') ?></span></div>
<?php } ?>

<?php if ($layout == 'box') { ?>
			<div data-cols="<?php echo NTemplateHelpers::escapeHtml($numOfColumns, ENT_COMPAT) ?>
" data-first="1" data-last="<?php echo NTemplateHelpers::escapeHtml(ceil($query->postCount / $numOfRows), ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('elm-item-organizer-container', "column-{$numOfColumns}", "layout-{$layout}", $enableCarousel ? 'carousel-container' : 'carousel-disabled',))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php foreach ($iterator = new WpLatteLoopIterator($query) as $item): $meta = $item->meta('member') ?>

<?php if ($enableCarousel and $iterator->isFirst($numOfRows)) { ?>
					<div<?php if ($_l->tmp = array_filter(array('item-box', $enableCarousel ? 'carousel-item':null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php } ?>
				<div	data-id="<?php echo NTemplateHelpers::escapeHtml($iterator->counter, ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('item', "item{$iterator->counter}",	$enableCarousel ? 'carousel-item':null, $iterator->isFirst($numOfColumns) ? 'item-first':null, $iterator->isLast($numOfColumns) ? 'item-last':null, $item->hasImage ? 'image-present':null, $boxAlign ? $boxAlign:null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
					<div class="item-title">
						<h3><?php echo NTemplateHelpers::escapeHtml($item->title, ENT_NOQUOTES) ?></h3>
					</div>

<?php if ($item->hasImage) { $ratio = explode(":", $imageHeight) ;$imgHeight = ($imgWidth / $ratio[0]) * $ratio[1] ?>
						<div class="item-thumbnail">
							<img src="<?php echo aitResizeImage($item->imageUrl, array('width' => $imgWidth, 'height' => $imgHeight, 'crop' => 1)) ?>
" alt="<?php echo $item->title ?>" />
						</div>
<?php } ?>

					<div class="item-text">
<?php if ($meta->position) { ?>
														<div class="member-position"><?php echo $template->printf(_x('%1$sPosition:%2$s %3$s', 'job position', 'wplatte'), '<span class="member-position-title">', '</span>', esc_html($meta->position)) ?></div>
<?php } ?>

<?php if ($meta->about) { ?>
							<div class="item-excerpt"><p><?php echo $template->trimWords($template->striptags($meta->about), 100) ?></p></div>
<?php } ?>

<?php if ($meta->icons) { ?>
							<div class="item-icons">
								<ul class="member-icons">
<?php $iterations = 0; foreach ($meta->icons as $icon) { ?>
									<li><a href="<?php echo NTemplateHelpers::escapeHtml($icon['url'], ENT_COMPAT) ?>
" <?php echo $target ?>><img src="<?php echo NTemplateHelpers::escapeHtml($icon['image'], ENT_COMPAT) ?>
" alt="<?php echo $icon['title'] ?>" /></a></li>
<?php $iterations++; } ?>
								</ul>
							</div>
<?php } ?>
					</div>
				</div>

<?php if ($enableCarousel and $iterator->isLast($numOfRows)) { ?>
					</div>
<?php } endforeach; wp_reset_postdata() ?>
			</div>
<?php } else { ?>
			<div data-cols="<?php echo NTemplateHelpers::escapeHtml($numOfColumns, ENT_COMPAT) ?>
" data-first="1" data-last="<?php echo NTemplateHelpers::escapeHtml(ceil($query->postCount / $numOfRows), ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('elm-item-organizer-container', "column-{$numOfColumns}", "layout-{$layout}", $enableCarousel ? 'carousel-container' : 'carousel-disabled',))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php foreach ($iterator = new WpLatteLoopIterator($query) as $item): $meta = $item->meta('member') ?>

<?php if ($enableCarousel and $iterator->isFirst($numOfRows)) { ?>
					<div<?php if ($_l->tmp = array_filter(array('item-box', $enableCarousel ? 'carousel-item':null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php } ?>
				<div	data-id="<?php echo NTemplateHelpers::escapeHtml($iterator->counter, ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('item', "item{$iterator->counter}",	$enableCarousel ? 'carousel-item':null, $iterator->isFirst($numOfColumns) ? 'item-first':null, $iterator->isLast($numOfColumns) ? 'item-last':null, $item->hasImage ? 'image-present':null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php if ($item->hasImage) { $ratio = explode(":", $imageHeight) ;$imgHeight = ($imgWidth / $ratio[0]) * $ratio[1] ?>
						<div class="item-thumbnail">
							<img src="<?php echo aitResizeImage($item->imageUrl, array('width' => $imgWidth, 'height' => $imgHeight, 'crop' => 1)) ?>
" alt="<?php echo $item->title ?>" />
						</div>
<?php } ?>

					<div class="item-title">
						<h3><?php echo NTemplateHelpers::escapeHtml($item->title, ENT_NOQUOTES) ?></h3>
					</div>

					<div class="item-text">
<?php if ($meta->position) { ?>
														<div class="member-position"><?php echo $template->printf(_x('%1$sPosition:%2$s %3$s', 'job position', 'wplatte'), '<span class="member-position-title">', '</span>', esc_html($meta->position)) ?></div>
<?php } ?>

<?php if ($meta->about) { ?>
							<div class="item-excerpt"><p><?php echo $template->trimWords($template->striptags($meta->about), 100) ?></p></div>
<?php } ?>

<?php if ($meta->icons) { ?>
							<div class="item-icons">
								<ul class="member-icons">
<?php $iterations = 0; foreach ($meta->icons as $icon) { ?>
									<li><a href="<?php echo NTemplateHelpers::escapeHtml($icon['url'], ENT_COMPAT) ?>
" <?php echo $target ?>><img src="<?php echo NTemplateHelpers::escapeHtml($icon['image'], ENT_COMPAT) ?>
" alt="<?php echo $icon['title'] ?>" /></a></li>
<?php $iterations++; } ?>
								</ul>
							</div>
<?php } ?>
					</div>
				</div>

<?php if ($enableCarousel and $iterator->isLast($numOfRows)) { ?>
					</div>
<?php } endforeach; wp_reset_postdata() ?>
			</div>
<?php } } else { ?>
		<div class="elm-item-organizer-container">
			<div class="alert alert-info">
				<?php echo NTemplateHelpers::escapeHtml(_x('Members', 'name of element', 'wplatte'), ENT_NOQUOTES) ?>
&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo NTemplateHelpers::escapeHtml(__('Info: There are no items created, add some please.', 'wplatte'), ENT_NOQUOTES) ?>

			</div>
		</div>
<?php } ?>
</div>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("ait-theme/elements/members/javascript", ""), array('enableCarousel' => $enableCarousel) + get_defined_vars(), $_l->templates['68bccoxbjc'])->render() ;