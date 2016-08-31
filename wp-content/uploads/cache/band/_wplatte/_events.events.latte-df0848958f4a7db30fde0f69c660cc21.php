<?php //netteCache[01]000571a:2:{s:4:"time";s:21:"0.24226800 1472269984";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:85:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\events\events.latte";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\events\events.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'zwo2vat4jv')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
NCoreMacros::includeTemplate($el->common('header'), $template->getParameters(), $_l->templates['zwo2vat4jv'])->render() ?>

<div id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>" class="elm-item-organizer <?php echo NTemplateHelpers::escapeHtml($htmlClass, ENT_COMPAT) ?>">

<?php $query = WpLatteMacros::prepareCustomWpQuery(array('type'    => 'event',
		'tax'     => 'events',
		'cat'     => $el->option('category'),
		'limit'   => $el->option('count'),
		'orderby' => $el->option('orderby'),
		'order' 	=> $el->option('order'))) ?>

<?php if ($query->havePosts) { $layout = $el->option->layout ;$addInfo = $el->option->addInfo ;if ($layout == 'box') { $enableCarousel  = $el->option->boxEnableCarousel ;$boxAlign 		  = $el->option->boxAlign ;$numOfRows       = $el->option->boxRows ;$numOfColumns    = $el->option->boxColumns ;$imageHeight     = $el->option->boxImageHeight ;$imgWidth = 640 ;} else { $enableCarousel  = $el->option->listEnableCarousel ;$numOfRows       = $el->option->listRows ;$numOfColumns    = $el->option->listColumns ;$imageHeight     = $el->option->listImageHeight ;$imgWidth = 300 ;} ?>

<?php if ($enableCarousel) { ?>
			<div class="loading"><span class="ait-preloader"><?php echo __('Loading&hellip;', 'wplatte') ?></span></div>
<?php } ?>

<?php if ($layout == 'box') { ?>
			<div data-cols="<?php echo NTemplateHelpers::escapeHtml($numOfColumns, ENT_COMPAT) ?>
" data-first="1" data-last="<?php echo NTemplateHelpers::escapeHtml(ceil($query->postCount / $numOfRows), ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('elm-item-organizer-container', "column-{$numOfColumns}", "layout-{$layout}", $enableCarousel ? 'carousel-container' : 'carousel-disabled',))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php foreach ($iterator = new WpLatteLoopIterator($query) as $item): $meta = $item->meta('event-data') ?>

<?php if ($enableCarousel and $iterator->isFirst($numOfRows)) { ?>
					<div<?php if ($_l->tmp = array_filter(array('item-box', $enableCarousel ? 'carousel-item':null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php } ?>

				<div data-id="<?php echo NTemplateHelpers::escapeHtml($iterator->counter, ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('item', "item{$iterator->counter}", $enableCarousel ? 'carousel-item':null, $iterator->isFirst($numOfColumns) ? 'item-first':null, $iterator->isLast($numOfColumns) ? 'item-last':null, $item->hasImage ? 'image-present':null, $boxAlign ? $boxAlign:null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
					<a href="<?php echo NTemplateHelpers::escapeHtml($item->permalink, ENT_COMPAT) ?>">
						<div class="item-title"><h3><?php echo $item->title ?></h3></div>

						<div class="item-thumbnail">
<?php if ($item->hasImage) { $ratio = explode(":", $imageHeight) ;$imgHeight = ($imgWidth / $ratio[0]) * $ratio[1] ?>
							<div class="item-thumbnail-wrap">
								<img src="<?php echo aitResizeImage($item->imageUrl, array('width' => $imgWidth, 'height' => $imgHeight, 'crop' => 1)) ?>
" alt="<?php echo $item->title ?>" />
							</div>
<?php } if ($meta->dateFrom != '') { ?>
							<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('S', 'english ordinal suffix for the day', 'wplatte'), ENT_NOQUOTES) ;$dayFormatSuffix = ob_get_clean() ?>

							<div class="event-date">
								<div class="entry-date event-date-from">
									<time class="date" datetime="<?php echo NTemplateHelpers::escapeHtml($template->date($meta->dateFrom, 'c'), ENT_COMPAT) ?>">
										<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('j', 'day date format', 'wplatte'), ENT_NOQUOTES) ;$dayFormat = ob_get_clean() ?>

										<span class="link-day"><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateFrom, $dayFormat), ENT_NOQUOTES) ;if (!empty($dayFormatSuffix)) { ?>
<small><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateFrom, $dayFormatSuffix), ENT_NOQUOTES) ?>
</small><?php } ?></span>
										<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('F', 'month date format', 'wplatte'), ENT_NOQUOTES) ;$monthFormat = ob_get_clean() ?>

										<span class="link-month"><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateFrom, $monthFormat), ENT_NOQUOTES) ?></span>
										<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('Y',  'year date format', 'wplatte'), ENT_NOQUOTES) ;$yearFormat = ob_get_clean() ?>

										<span class="link-year"><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateFrom, $yearFormat), ENT_NOQUOTES) ?></span>
									</time>
								</div>
							</div>
<?php } ?>
						</div>
					</a>

					<div class="item-text">
						<div class="item-excerpt"><?php echo $item->excerpt(200) ?></div>
					</div>

<?php if ($addInfo) { ?>
					<div class="item-info">
<?php if ($meta->dateTo != '') { ?>
							<div class="item-duration">
								<span class="item-dur-title"><strong><?php echo NTemplateHelpers::escapeHtml(__('Duration:', 'wplatte'), ENT_NOQUOTES) ?></strong></span>
								<time class="item-from" datetime="<?php echo NTemplateHelpers::escapeHtml($template->date($meta->dateFrom, 'c'), ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateFrom), ENT_NOQUOTES) ?></time>
								<span class="item-sep">-</span>
								<time class="item-to" datetime="<?php echo NTemplateHelpers::escapeHtml($template->date($meta->dateTo, 'c'), ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateTo), ENT_NOQUOTES) ?></time>
							</div>
<?php } ?>
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
<?php foreach ($iterator = new WpLatteLoopIterator($query) as $item): $meta = $item->meta('event-data') ?>

<?php if ($enableCarousel and $iterator->isFirst($numOfRows)) { ?>
					<div<?php if ($_l->tmp = array_filter(array('item-box', $enableCarousel ? 'carousel-item':null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php } ?>

				<div	data-id="<?php echo NTemplateHelpers::escapeHtml($iterator->counter, ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('item', "item{$iterator->counter}", $enableCarousel ? 'carousel-item':null, $iterator->isFirst($numOfColumns) ? 'item-first':null, $iterator->isLast($numOfColumns) ? 'item-last':null, $item->hasImage ? 'image-present':null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
					<a href="<?php echo NTemplateHelpers::escapeHtml($item->permalink, ENT_COMPAT) ?>">
						<div class="item-thumbnail">
<?php if ($item->hasImage) { $ratio = explode(":", $imageHeight) ;$imgHeight = ($imgWidth / $ratio[0]) * $ratio[1] ?>
							<div class="item-thumbnail-wrap">
								<img src="<?php echo aitResizeImage($item->imageUrl, array('width' => $imgWidth, 'height' => $imgHeight, 'crop' => 1)) ?>
" alt="<?php echo $item->title ?>" />
							</div>
<?php } if ($meta->dateFrom != '') { ?>
							<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('S', 'english ordinal suffix for the day', 'wplatte'), ENT_NOQUOTES) ;$dayFormatSuffix = ob_get_clean() ?>

							<div class="event-date">
								<div class="entry-date event-date-from">
									<time class="date" datetime="<?php echo NTemplateHelpers::escapeHtml($template->date($meta->dateFrom, 'c'), ENT_COMPAT) ?>">
										<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('j', 'day date format', 'wplatte'), ENT_NOQUOTES) ;$dayFormat = ob_get_clean() ?>

										<span class="link-day"><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateFrom, $dayFormat), ENT_NOQUOTES) ;if (!empty($dayFormatSuffix)) { ?>
<small><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateFrom, $dayFormatSuffix), ENT_NOQUOTES) ?>
</small><?php } ?></span>
										<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('M', 'month date format', 'wplatte'), ENT_NOQUOTES) ;$monthFormat = ob_get_clean() ?>

										<span class="link-month"><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateFrom, $monthFormat), ENT_NOQUOTES) ?></span>
										<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('Y',  'year date format', 'wplatte'), ENT_NOQUOTES) ;$yearFormat = ob_get_clean() ?>

										<span class="link-year"><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateFrom, $yearFormat), ENT_NOQUOTES) ?></span>
									</time>
								</div>
							</div>
<?php } ?>
						</div>

						<div class="item-title"><h3><?php echo $item->title ?></h3></div>
					</a>

					<div class="item-text">
						<div class="item-excerpt"><?php echo $item->excerpt(200) ?></div>
					</div>

<?php if ($addInfo) { ?>
					<div class="item-info">
<?php if ($meta->dateTo != '') { ?>
							<div class="item-duration">
								<span class="item-dur-title"><strong><?php echo NTemplateHelpers::escapeHtml(__('Duration:', 'wplatte'), ENT_NOQUOTES) ?></strong></span>
								<time class="item-from" datetime="<?php echo NTemplateHelpers::escapeHtml($template->date($meta->dateFrom, 'c'), ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateFrom), ENT_NOQUOTES) ?></time>
								<span class="item-sep">-</span>
								<time class="item-to" datetime="<?php echo NTemplateHelpers::escapeHtml($template->date($meta->dateTo, 'c'), ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateTo), ENT_NOQUOTES) ?></time>
							</div>
<?php } ?>
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
				<?php echo NTemplateHelpers::escapeHtml(_x('Events', 'name of element', 'wplatte'), ENT_NOQUOTES) ?>
&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo NTemplateHelpers::escapeHtml(__('Info: There are no items created, add some please.', 'wplatte'), ENT_NOQUOTES) ?>

			</div>
		</div>
<?php } ?>
</div>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("ait-theme/elements/events/javascript", ""), array() + get_defined_vars(), $_l->templates['zwo2vat4jv'])->render() ;