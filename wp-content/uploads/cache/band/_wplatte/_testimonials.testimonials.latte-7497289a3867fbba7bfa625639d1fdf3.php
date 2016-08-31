<?php //netteCache[01]000583a:2:{s:4:"time";s:21:"0.91974700 1472280028";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:97:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\testimonials\testimonials.latte";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\testimonials\testimonials.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'lz9ms1x8cy')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
NCoreMacros::includeTemplate($element->common('header'), $template->getParameters(), $_l->templates['lz9ms1x8cy'])->render() ?>

<div id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>" class="elm-item-organizer <?php echo NTemplateHelpers::escapeHtml($htmlClass, ENT_COMPAT) ?>">

<?php $query = WpLatteMacros::prepareCustomWpQuery(array('type'    => 'testimonial',
		'tax'     => 'testimonials',
		'cat'     => $el->option('category'),
		'limit'   => $el->option('count'),
		'orderby' => $el->option('orderby'),
		'order' 	=> $el->option('order'))) ?>

<?php if ($query->havePosts) { $layout = $el->option->layout ;$addInfo = $el->option->addInfo ;if ($layout == 'box') { $enableCarousel  = $el->option->boxEnableCarousel ;$boxAlign 		  = $el->option->boxAlign ;$numOfRows       = $el->option->boxRows ;$numOfColumns    = $el->option->boxColumns ;$imageHeight     = '1:1' ;$imgWidth = 640 ;} else { $enableCarousel  = $el->option->listEnableCarousel ;$numOfRows       = $el->option->listRows ;$numOfColumns    = $el->option->listColumns ;$imageHeight     = '1:1' ;$imgWidth = 220 ;} ?>

<?php if ($enableCarousel) { ?>
			<div class="loading"><span class="ait-preloader"><?php echo __('Loading&hellip;', 'wplatte') ?></span></div>
<?php } ?>

<?php if ($layout == 'box') { ?>
			<div data-cols="<?php echo NTemplateHelpers::escapeHtml($numOfColumns, ENT_COMPAT) ?>
" data-first="1" data-last="<?php echo NTemplateHelpers::escapeHtml(ceil($query->postCount / $numOfRows), ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('elm-item-organizer-container', "column-{$numOfColumns}", "layout-{$layout}", $enableCarousel ? 'carousel-container' : 'carousel-disabled',))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php foreach ($iterator = new WpLatteLoopIterator($query) as $item): $meta = $item->meta('testimonial-options') ;if ($enableCarousel and $iterator->isFirst($numOfRows)) { ?>
					<div<?php if ($_l->tmp = array_filter(array('item-box', $enableCarousel ? 'carousel-item':null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php } ?>
				<div data-id="<?php echo NTemplateHelpers::escapeHtml($iterator->counter, ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('item', "item{$iterator->counter}", $enableCarousel ? 'carousel-item':null, $iterator->isFirst($numOfColumns) ? 'item-first':null, $iterator->isLast($numOfColumns) ? 'item-last':null, $item->hasImage ? 'image-present':null, $boxAlign ? $boxAlign:null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>

<?php if ($item->hasImage) { $ratio = explode(":", $imageHeight) ;$imgHeight = ($imgWidth / $ratio[0]) * $ratio[1] ?>
						<div class="item-thumbnail"><img src="<?php echo aitResizeImage($item->imageUrl, array('width' => $imgWidth, 'height' => $imgHeight, 'crop' => 1)) ?>
" alt="<?php echo $item->title ?>" /></div>
<?php } ?>

					<div class="item-text">
						<div class="item-excerpt"><p><?php echo $template->striptags($item->content) ?></p></div>
					</div>

<?php if ($addInfo) { ?>
					<div class="item-info">
						<div class="item-author"><?php echo NTemplateHelpers::escapeHtml($meta->author, ENT_NOQUOTES) ?></div>
						<div class="item-rating" data-rating="<?php echo NTemplateHelpers::escapeHtml($meta->rating, ENT_COMPAT) ?>"></div>
					</div>
<?php } ?>
				</div>

<?php if ($enableCarousel and $iterator->isLast($numOfRows)) { ?>
					</div>
<?php } endforeach; wp_reset_postdata() ?>
			</div>
<?php } else { ?>
			<div data-cols="<?php echo NTemplateHelpers::escapeHtml($numOfColumns, ENT_COMPAT) ?>
" data-first="1" data-last="<?php echo NTemplateHelpers::escapeHtml(ceil($query->postCount / $numOfRows), ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('elm-item-organizer-container', "column-{$numOfColumns}", "layout-{$layout}", $enableCarousel ? 'carousel-container' : 'carousel-disabled',))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php foreach ($iterator = new WpLatteLoopIterator($query) as $item): $meta = $item->meta('testimonial-options') ;if ($enableCarousel and $iterator->isFirst($numOfRows)) { ?>
					<div<?php if ($_l->tmp = array_filter(array('item-box', $enableCarousel ? 'carousel-item':null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php } ?>

				<div	data-id="<?php echo NTemplateHelpers::escapeHtml($iterator->counter, ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('item', "item{$iterator->counter}", $enableCarousel ? 'carousel-item':null, $iterator->isFirst($numOfColumns) ? 'item-first':null, $iterator->isLast($numOfColumns) ? 'item-last':null, $item->hasImage ? 'image-present':null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>

<?php if ($item->hasImage) { $ratio = explode(":", $imageHeight) ;$imgHeight = ($imgWidth / $ratio[0]) * $ratio[1] ?>
						<div class="item-thumbnail"><img src="<?php echo aitResizeImage($item->imageUrl, array('width' => $imgWidth, 'height' => $imgHeight, 'crop' => 1)) ?>
" alt="<?php echo $item->title ?>" /></div>
<?php } ?>

					<div class="item-text">
						<div class="item-excerpt"><p><?php echo $template->striptags($item->content) ?></p></div>
					</div>

<?php if ($addInfo) { ?>
					<div class="item-info">
						<div class="item-author"><?php echo NTemplateHelpers::escapeHtml($meta->author, ENT_NOQUOTES) ?></div>
						<div class="item-rating" data-rating="<?php echo NTemplateHelpers::escapeHtml($meta->rating, ENT_COMPAT) ?>"></div>
					</div>
<?php } ?>
				</div>

<?php if ($enableCarousel and $iterator->isLast($numOfRows)) { ?>
					</div>
<?php } endforeach; wp_reset_postdata() ?>
			</div>
<?php } } else { ?>
		<div class="elm-item-organizer-container">
			<div class="alert alert-info">
				<?php echo NTemplateHelpers::escapeHtml(_x('Testimonials', 'name of element', 'wplatte'), ENT_NOQUOTES) ?>
&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo NTemplateHelpers::escapeHtml(__('Info: There are no items created, add some please.', 'wplatte'), ENT_NOQUOTES) ?>

			</div>
		</div>
<?php } ?>

</div>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("ait-theme/elements/testimonials/javascript", ""), array() + get_defined_vars(), $_l->templates['lz9ms1x8cy'])->render() ;