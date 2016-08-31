<?php //netteCache[01]000577a:2:{s:4:"time";s:21:"0.85120600 1472269984";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:91:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\portfolio\portfolio.latte";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\portfolio\portfolio.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '24bnhyiwm3')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
NCoreMacros::includeTemplate($el->common('header'), $template->getParameters(), $_l->templates['24bnhyiwm3'])->render() ?>

<div id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>" class="<?php echo NTemplateHelpers::escapeHtml($htmlClass, ENT_COMPAT) ?>">

<?php $portfolios = $wp->categories('portfolios') ?>

<?php if (!$portfolios) { ?>
		<div class="alert alert-info">
			<?php echo NTemplateHelpers::escapeHtml(_x('Portfolio', 'name of element', 'wplatte'), ENT_NOQUOTES) ?>
&nbsp;&nbsp;|&nbsp;&nbsp;<?php echo NTemplateHelpers::escapeHtml(__('Info: There are no items created, add some please.', 'wplatte'), ENT_NOQUOTES) ?>

		</div>
<?php } else { ?>

		<div class="loading"><span class="ait-preloader"><?php echo __('Loading&hellip;', 'wplatte') ?></span></div>

<?php if ($el->option->showFilter) { ?>
		<div class="filters-wrapper">
			<div class="filter-wrapper category-wrap">

<?php if ($el->option->category == 0) { ?>
					<div class="selected"><?php echo NTemplateHelpers::escapeHtml(__('Category:', 'wplatte'), ENT_NOQUOTES) ?>
 <span><?php echo NTemplateHelpers::escapeHtml(__('All', 'wplatte'), ENT_NOQUOTES) ?></span></div>
<?php $children = get_categories(array('taxonomy' => 'ait-portfolios', 'hide_empty' => 1, 'parent' => $el->option->category)) ;if ($el->option('subcategoryItems')) { ?>
						<ul class="category">
							<li><a href="#" data-ait-portfolio-filter="all" data-ait-portfolio-title="<?php echo NTemplateHelpers::escapeHtml(__('All', 'wplatte'), ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml(__('All', 'wplatte'), ENT_NOQUOTES) ?></a></li>
							<?php echo AitPortfolioElement::recursiveCategory($children, "portfolio-category-", "") ?>

						</ul>
<?php } else { ?>
						<ul class="category">
							<li><a href="#" data-ait-portfolio-filter="all" data-ait-portfolio-title="<?php echo NTemplateHelpers::escapeHtml(__('All', 'wplatte'), ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml(__('All', 'wplatte'), ENT_NOQUOTES) ?></a></li>
<?php $iterations = 0; foreach ($children as $child) { ?>
							<li><a href="#" data-ait-portfolio-filter="portfolio-category-<?php echo NTemplateHelpers::escapeHtml($child->slug, ENT_COMPAT) ?>
" data-ait-portfolio-title="<?php echo NTemplateHelpers::escapeHtml($child->name, ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml($child->name, ENT_NOQUOTES) ?></a></li>
<?php $iterations++; } ?>
						</ul>
<?php } } else { ?>
					<div class="selected"><?php echo NTemplateHelpers::escapeHtml(__('Category:', 'wplatte'), ENT_NOQUOTES) ?>
 <span><?php echo NTemplateHelpers::escapeHtml($portfolios[$el->option->category]->title, ENT_NOQUOTES) ?></span></div>
<?php if ($el->option('subcategoryItems')) { $children = get_categories(array('taxonomy' => 'ait-portfolios', 'hide_empty' => 1, 'parent' => $el->option->category)) ;if (is_array($children) && count($children) > 0) { ?>
						<ul class="category">
							<li><a href="#" data-ait-portfolio-filter="all" data-ait-portfolio-title="<?php echo NTemplateHelpers::escapeHtml($portfolios[$el->option->category]->title, ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml($portfolios[$el->option->category]->title, ENT_NOQUOTES) ?></a></li>
							<?php echo AitPortfolioElement::recursiveCategory($children, "portfolio-category-", "&nbsp;&nbsp;") ?>

						</ul>
<?php } } } ?>

			</div><!--
			--><div class="filter-wrapper sort-by-wrap">
<?php if ($el->option('orderby') == 'date') { ?>
				<div class="selected" data-ait-portfolio-sort="date"><?php echo NTemplateHelpers::escapeHtml(__('Sort by:', 'wplatte'), ENT_NOQUOTES) ?>
 <span><?php echo NTemplateHelpers::escapeHtml(__('Creation Date', 'wplatte'), ENT_NOQUOTES) ?></span></div>
<?php } elseif ($el->option('orderby') == 'rand') { ?>
				<div class="selected" data-ait-portfolio-sort="random"><?php echo NTemplateHelpers::escapeHtml(__('Sort by:', 'wplatte'), ENT_NOQUOTES) ?>
 <span><?php echo NTemplateHelpers::escapeHtml(__('Random', 'wplatte'), ENT_NOQUOTES) ?></span></div>
<?php } else { ?>
				<div class="selected" data-ait-portfolio-sort="numeric"><?php echo NTemplateHelpers::escapeHtml(__('Sort by:', 'wplatte'), ENT_NOQUOTES) ?>
 <span><?php echo NTemplateHelpers::escapeHtml(__('Item Order', 'wplatte'), ENT_NOQUOTES) ?></span></div>
<?php } ?>

				<ul class="sort-by">
					<!--<li><a href="#" data-ait-portfolio-sort="alphabetical"><?php echo NTemplateHelpers::escapeHtmlComment(__('Alphabetical', 'wplatte')) ?></a></li>-->
					<li><a href="#" data-ait-portfolio-sort="date"><?php echo NTemplateHelpers::escapeHtml(__('Creation Date', 'wplatte'), ENT_NOQUOTES) ?></a></li>
					<li><a href="#" data-ait-portfolio-sort="numeric"><?php echo NTemplateHelpers::escapeHtml(__('Item Order', 'wplatte'), ENT_NOQUOTES) ?></a></li>
					<li><a href="#" data-ait-portfolio-sort="random"><?php echo NTemplateHelpers::escapeHtml(__('Random', 'wplatte'), ENT_NOQUOTES) ?></a></li>
				</ul>
			</div><!--
			--><div class="filter-wrapper order-wrap">
<?php if ($el->option('order') == "ASC") { ?>
				<div class="selected" data-ait-portfolio-order="ascending"><?php echo NTemplateHelpers::escapeHtml(__('Order:', 'wplatte'), ENT_NOQUOTES) ?>
 <span><?php echo NTemplateHelpers::escapeHtml(__('Ascending', 'wplatte'), ENT_NOQUOTES) ?></span></div>
<?php } else { ?>
				<div class="selected" data-ait-portfolio-order="descending"><?php echo NTemplateHelpers::escapeHtml(__('Order:', 'wplatte'), ENT_NOQUOTES) ?>
 <span><?php echo NTemplateHelpers::escapeHtml(__('Descending', 'wplatte'), ENT_NOQUOTES) ?></span></div>
<?php } ?>
				<ul class="order">
					<li><a href="#" data-ait-portfolio-order="ascending"><?php echo NTemplateHelpers::escapeHtml(__('Ascending', 'wplatte'), ENT_NOQUOTES) ?></a></li>
					<li><a href="#" data-ait-portfolio-order="descending"><?php echo NTemplateHelpers::escapeHtml(__('Descending', 'wplatte'), ENT_NOQUOTES) ?></a></li>
				</ul>
			</div>
		</div>
<?php } ?>

<?php $websiteMaxWidth = $options->theme->general->websiteWidth + $el->option->imageOffset ;if ($el->betweenSidebars == true) { $lSidebar = $wp->hasSidebar('left') ? ($options->theme->general->leftSidebarWidth + $options->theme->general->sidebarGap) : 0 ;$rSidebar = $wp->hasSidebar('right') ? ($options->theme->general->rightSidebarWidth + $options->theme->general->sidebarGap) : 0 ;$sidebarsWidth = (($options->theme->general->websiteWidth + $el->option->imageOffset) * ($lSidebar + $rSidebar)) / 100 ;} else { $sidebarsWidth = 0 ;} $maxW = $websiteMaxWidth - $sidebarsWidth ?>

<?php $grOpt = $el->option('@bg') ;$elemCol = $grOpt['color'] ;$elemImg = $grOpt['image'] ?>

<?php if ($elemCol != "" and $el->betweenSidebars == true) { $maxW = $maxW - 40 ;} ?>
				<ul class="portfolio-items-wrapper"><!--

<?php if ($el->option->category == 0) { if ($el->option('subcategoryItems')) { $query = WpLatteMacros::prepareCustomWpQuery(array('type'    => 'portfolio-item',
				'tax'     => 'portfolios',
				'cat'     => $el->option->category,
				'limit'   => $el->option->count,
				'orderby' => $el->option->orderby,
				'order'	=> $el->option->order,)); } else { $cats = get_categories(array('taxonomy' => 'ait-portfolios', 'hide_empty' => 1, 'parent' => $el->option->category)) ;$terms = array() ;$iterations = 0; foreach ($cats as $cat) { array_push($terms, $cat->term_id) ;$iterations++; } $querydata = array(
				'post_type' => 'ait-portfolio-item',
				'tax_query' => array(
					array(
						'taxonomy' => 'ait-portfolios',
						'field' => 'term_id',
						'terms' => $terms,
						'include_children' => false,
					),
				),
				'posts_per_page'   => $el->option->count,
				'orderby' => $el->option->orderby,
				'order'	=> $el->option->order,
			) ;$query = WpLatteMacros::prepareCustomWpQuery(array($querydata)); } } else { if ($el->option('subcategoryItems')) { $query = WpLatteMacros::prepareCustomWpQuery(array('type'    => 'portfolio-item',
				'tax'     => 'portfolios',
				'cat'     => $el->option->category,
				'limit'   => $el->option->count,
				'orderby' => $el->option->orderby,
				'order'	=> $el->option->order,)); } else { $querydata = array(
				'post_type' => 'ait-portfolio-item',
				'tax_query' => array(
					array(
						'taxonomy' => 'ait-portfolios',
						'field' => 'term_id',
						'terms' => $el->option->category,
						'include_children' => false
					),
				),
				'posts_per_page'   => $el->option->count,
				'orderby' => $el->option->orderby,
				'order'	=> $el->option->order,
			) ;$query = WpLatteMacros::prepareCustomWpQuery(array($querydata)); } } ?>

<?php if ($query->havePosts) { foreach ($iterator = new WpLatteLoopIterator($query) as $item): ?>

<?php $meta = $item->meta('portfolio-item') ;$width = $height = round(($maxW - (($el->option->columns) * $el->option->imageOffset)) / $el->option->columns) ?>

<?php if ($el->option('orderby') == 'rand') { if ($el->option('order') == "ASC") { $rand = $iterator->getCounter() ;} else { $rand = $el->option->count-$iterator->getCounter() ;} } else { $rand = rand() ;} ?>

<?php if ($el->option('subcategoryItems')) { ?>
		--><li data-id="id-<?php echo NTemplateHelpers::escapeHtml($iterator->counter, ENT_COMPAT) ?>
" class="portfolio-item <?php echo NTemplateHelpers::escapeHtml($item->catSlugs('ait-portfolios', ' ', 'portfolio-category-'), ENT_COMPAT) ?>
" <?php echo aitDataAttr('portfolio-sort-params', array('numeric' => $item->menuOrder, 'alphabetical' => $item->title, 'date' => $item->date('Y-m-d h:i:s'), 'random' => $rand)) ?>>
<?php } else { ?>
		--><li data-id="id-<?php echo NTemplateHelpers::escapeHtml($iterator->counter, ENT_COMPAT) ?>
" class="portfolio-item <?php echo NTemplateHelpers::escapeHtml($item->categoriesSlugs('portfolio-category'), ENT_COMPAT) ?>
" <?php echo aitDataAttr('portfolio-sort-params', array('numeric' => $item->menuOrder, 'alphabetical' => $item->title, 'date' => $item->date('Y-m-d h:i:s'), 'random' => $rand)) ?>>
<?php } ?>
				<div class="portfolio-item-img portfolio-item-type-<?php echo NTemplateHelpers::escapeHtml($meta->type, ENT_COMPAT) ?>">

<?php if ($meta->type == 'image' and $el->option->display == 'colorbox' and $item->hasImage) { $url = $item->imageUrl ;} elseif ($meta->type == 'video' and $el->option->display == 'colorbox' and $meta->videoUrl) { $url = $meta->videoUrl ;} elseif ($meta->type == 'website' and $el->option->display == 'colorbox') { $url = $meta->websiteUrl ;} else { $url = $item->permalink ;} ?>

					<a href="<?php echo NTemplateHelpers::escapeHtml($url, ENT_COMPAT) ?>" class="disable-default-colorbox" <?php if ($meta->type == 'website' and $el->option->display == 'colorbox') { ?>
target="_blank"<?php } ?> data-rel="portfolio-item-<?php echo NTemplateHelpers::escapeHtml($el->getHtmlId(), ENT_COMPAT) ?>">

<?php if ($item->hasImage) { ?>
						<div class="portfolio-item-img-wrap item-image-small item-visible">

<?php if ($el->option->imageHeight != 0) { $height = (int) $el->option->imageHeight ;} ?>

							<img src="<?php echo aitResizeImage($item->imageUrl, array('width' => $width, 'height' => $height, 'crop' => 1, 'crop_from_position' => $meta->cropFromPosition)) ?>
" data-width="<?php echo NTemplateHelpers::escapeHtml($width, ENT_COMPAT) ?>" alt="<?php echo $item->title ?>" />

						</div>
<?php } ?>

						<div class="portfolio-item-icon"></div>
					</a>
				</div>

<?php if ($el->option->imageDescription) { ?>
					<div class="portfolio-item-desc">
						<h3><?php echo $item->title ?></h3>
						<p><?php echo $template->striptags($item->excerpt(55)) ?></p>
					</div>
<?php } ?>

			</li><!--
<?php endforeach; wp_reset_postdata(); } ?>
		--></ul>
<?php } ?>

<?php if ($el->option('butText')) { ?>
	<div class="elm-wrapper portfolio-button">
		<a href="<?php echo NTemplateHelpers::escapeHtml($el->option('butUrl'), ENT_COMPAT) ?>" class="ait-sc-button">
			<span class="container">
				<span class="wrap">
					<span class="text">
						<span class="title">
							<?php echo $el->option('butText') ?>

						</span>
					</span>
				</span>
			</span>
		</a>
	</div>
<?php } ?>
	</div>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("ait-theme/elements/portfolio/javascript", ""), array() + get_defined_vars(), $_l->templates['24bnhyiwm3'])->render() ?>


