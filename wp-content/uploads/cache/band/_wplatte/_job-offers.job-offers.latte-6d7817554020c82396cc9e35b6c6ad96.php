<?php //netteCache[01]000579a:2:{s:4:"time";s:21:"0.04322500 1472280028";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:93:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\job-offers\job-offers.latte";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\job-offers\job-offers.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'pvypsx9xkw')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
NCoreMacros::includeTemplate($el->common('header'), $template->getParameters(), $_l->templates['pvypsx9xkw'])->render() ?>

<div id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>" class="elm-item-organizer <?php echo NTemplateHelpers::escapeHtml($htmlClass, ENT_COMPAT) ?>">

<?php $query = WpLatteMacros::prepareCustomWpQuery(array('type'    => 'job-offer',
		'tax'     => 'offers',
		'cat'     => $el->option('category'),
		'limit'   => $el->option('count'),
		'orderby' => $el->option('orderby'),
		'order' 	=> $el->option('order'))) ?>

<?php $itemsCount = 0 ;if ($query->havePosts) { foreach ($iterator = new WpLatteLoopIterator($query) as $item): if (time() <= strtotime($item->meta('offer-data')->validTo)) { $itemsCount++ ;} endforeach; wp_reset_postdata(); } if ($itemsCount != 0) { $layout = $el->option->layout ;$addInfo = $el->option->addInfo ;if ($layout == 'box') { $enableCarousel  = $el->option->boxEnableCarousel ;$boxAlign 		  = $el->option->boxAlign ;$numOfRows       = $el->option->boxRows ;$numOfColumns    = $el->option->boxColumns ;$imgWidth = 640 ;} else { $enableCarousel  = $el->option->listEnableCarousel ;$numOfRows       = $el->option->listRows ;$numOfColumns    = $el->option->listColumns ;$imageHeight     = $el->option->listImageHeight ;$imgWidth = 220 ;} ?>

<?php if ($enableCarousel) { ?>
			<div class="loading"><span class="ait-preloader"><?php echo __('Loading&hellip;', 'wplatte') ?></span></div>
<?php } ?>

<?php if ($layout == 'box') { ?>
			<div data-cols="<?php echo NTemplateHelpers::escapeHtml($numOfColumns, ENT_COMPAT) ?>
" data-first="1" data-last="<?php echo NTemplateHelpers::escapeHtml(ceil($query->postCount / $numOfRows), ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('elm-item-organizer-container', "column-{$numOfColumns}", "layout-{$layout}", $enableCarousel ? 'carousel-container' : 'carousel-disabled',))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php foreach ($iterator = new WpLatteLoopIterator($query) as $item): $meta = $item->meta('offer-data') ;if (time() <= strtotime($meta->validTo)) { if ($enableCarousel and $iterator->isFirst($numOfRows)) { ?>
						<div<?php if ($_l->tmp = array_filter(array('item-box', $enableCarousel ? 'carousel-item':null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php } ?>
					<div data-id="<?php echo NTemplateHelpers::escapeHtml($iterator->counter, ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('item', "item{$iterator->counter}", $enableCarousel ? 'carousel-item':null, $iterator->isFirst($numOfColumns) ? 'item-first':null, $iterator->isLast($numOfColumns) ? 'item-last':null, $item->hasImage ? 'image-present':null, $boxAlign ? $boxAlign:null,))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
						<a href="<?php echo NTemplateHelpers::escapeHtml($item->permalink, ENT_COMPAT) ?>">

<?php if ($item->hasImage) { ?>
							<div class="item-thumbnail">
								<img src="<?php echo aitResizeImage($item->imageUrl, array('width' => 100, 'height' => 100, 'crop' => 1)) ?>
" alt="<?php echo $item->title ?>" />
							</div>
<?php } ?>

							<div class="item-title"><h3><?php echo $item->title ?></h3></div>
						</a>

						<div class="item-text">
<?php if ($addInfo) { if ($meta->validTo != '') { ?>
								<div class="item-duration">
									<span class="item-dur-title"><strong><?php echo NTemplateHelpers::escapeHtml(__('Validity:', 'wplatte'), ENT_NOQUOTES) ?></strong></span>
									<time class="item-to" datetime="<?php echo NTemplateHelpers::escapeHtml($template->date($meta->validFrom, 'c'), ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->validFrom), ENT_NOQUOTES) ?></time>
									<span class="item-sep">-</span>
									<time class="item-to" datetime="<?php echo NTemplateHelpers::escapeHtml($template->date($meta->validTo, 'c'), ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->validTo), ENT_NOQUOTES) ?></time>
								</div>
<?php } } ?>
							<div class="item-excerpt"><?php echo $item->excerpt(200) ?></div>
						</div>

<?php if ($addInfo) { ?>
						<div class="item-info">
							<div class="job-contact">
								<span class="job-contact-title"><strong><?php echo NTemplateHelpers::escapeHtml(__('Contact:', 'wplatte'), ENT_NOQUOTES) ?></strong></span>
								<?php if ($meta->contactName) { ?><span class="job-contact-name"><?php echo NTemplateHelpers::escapeHtml($meta->contactName, ENT_NOQUOTES) ?>
</span><?php } ?>

								<?php if ($meta->contactMail) { ?><span class="job-contact-mail"><a href="mailto:<?php echo NTemplateHelpers::escapeHtml($meta->contactMail, ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml($meta->contactMail, ENT_NOQUOTES) ?></a></span><?php } ?>

								<?php if ($meta->contactPhone) { ?><span class="job-contact-phone"><?php echo NTemplateHelpers::escapeHtml($meta->contactPhone, ENT_NOQUOTES) ?>
</span><?php } ?>

							</div>
						</div>
<?php } ?>
					</div>

<?php if ($enableCarousel and $iterator->isLast($numOfRows)) { ?>
						</div>
<?php } } endforeach; wp_reset_postdata() ?>
			</div>
<?php } else { ?>
			<div data-cols="<?php echo NTemplateHelpers::escapeHtml($numOfColumns, ENT_COMPAT) ?>
" data-first="1" data-last="<?php echo NTemplateHelpers::escapeHtml(ceil($query->postCount / $numOfRows), ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('elm-item-organizer-container', "column-{$numOfColumns}", "layout-{$layout}", $enableCarousel ? 'carousel-container' : 'carousel-disabled',))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php foreach ($iterator = new WpLatteLoopIterator($query) as $item): $meta = $item->meta('offer-data') ;if (time() <= strtotime($meta->validTo)) { if ($enableCarousel and $iterator->isFirst($numOfRows)) { ?>
						<div<?php if ($_l->tmp = array_filter(array('item-box', $enableCarousel ? 'carousel-item':null))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
<?php } ?>

					<div	data-id="<?php echo NTemplateHelpers::escapeHtml($iterator->counter, ENT_COMPAT) ?>
"<?php if ($_l->tmp = array_filter(array('item', "item{$iterator->counter}", $enableCarousel ? 'carousel-item':null, $iterator->isFirst($numOfColumns) ? 'item-first':null, $item->hasImage ? 'image-present':null, $iterator->isLast($numOfColumns) ? 'item-last':null, ))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
						<a href="<?php echo NTemplateHelpers::escapeHtml($item->permalink, ENT_COMPAT) ?>">

<?php if ($item->hasImage) { ?>
								<div class="item-thumbnail">
										<img src="<?php echo aitResizeImage($item->imageUrl, array('width' => 100, 'height' => 100, 'crop' => 1)) ?>
" alt="<?php echo $item->title ?>" />
								</div>
<?php } ?>

							<div class="item-title">

								<div class="item-header">
									<h3><?php echo $item->title ?></h3>
<?php if ($addInfo) { if ($meta->validTo != '') { ?>
										<div class="item-duration">
											<span class="item-dur-title"><strong><?php echo NTemplateHelpers::escapeHtml(__('Validity:', 'wplatte'), ENT_NOQUOTES) ?></strong></span>
											<time class="item-to" datetime="<?php echo NTemplateHelpers::escapeHtml($template->date($meta->validFrom, 'c'), ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->validFrom), ENT_NOQUOTES) ?></time>
											<span class="item-sep">-</span>
											<time class="item-to" datetime="<?php echo NTemplateHelpers::escapeHtml($template->date($meta->validTo, 'c'), ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->validTo), ENT_NOQUOTES) ?></time>
										</div>
<?php } } ?>
								</div>

							</div>
						</a>

						<div class="item-text">
							<div class="item-excerpt"><?php echo $item->excerpt(200) ?></div>
						</div>

<?php if ($addInfo) { ?>
						<div class="item-info">
							<div class="job-contact">
								<span class="job-contact-title"><strong><?php echo NTemplateHelpers::escapeHtml(__('Contact:', 'wplatte'), ENT_NOQUOTES) ?></strong></span>
								<?php if ($meta->contactName) { ?><span class="job-contact-name"><?php echo NTemplateHelpers::escapeHtml($meta->contactName, ENT_NOQUOTES) ?>
</span><?php } ?>

								<?php if ($meta->contactMail) { ?><span class="job-contact-mail"><a href="mailto:<?php echo NTemplateHelpers::escapeHtml($meta->contactMail, ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml($meta->contactMail, ENT_NOQUOTES) ?></a></span><?php } ?>

								<?php if ($meta->contactPhone) { ?><span class="job-contact-phone"><?php echo NTemplateHelpers::escapeHtml($meta->contactPhone, ENT_NOQUOTES) ?>
</span><?php } ?>

							</div>
						</div>
<?php } ?>
					</div>

<?php if ($enableCarousel and $iterator->isLast($numOfRows)) { ?>
						</div>
<?php } } endforeach; wp_reset_postdata() ?>
			</div>
<?php } } else { ?>
		<div class="elm-item-organizer-container">
			<div class="alert alert-info">
				<?php echo NTemplateHelpers::escapeHtml(_x('Job Offers', 'name of element', 'wplatte'), ENT_NOQUOTES) ?>
&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo NTemplateHelpers::escapeHtml(__('Info: There are no items created, add some please.', 'wplatte'), ENT_NOQUOTES) ?>

			</div>
		</div>
<?php } ?>

</div>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("ait-theme/elements/job-offers/javascript", ""), array() + get_defined_vars(), $_l->templates['pvypsx9xkw'])->render() ;