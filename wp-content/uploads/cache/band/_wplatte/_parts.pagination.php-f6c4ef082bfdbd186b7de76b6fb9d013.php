<?php //netteCache[01]000553a:2:{s:4:"time";s:21:"0.76081500 1472280813";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:67:"D:\xampp\htdocs\bacnice\wp-content\themes\band\parts\pagination.php";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\parts\pagination.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'jlog98z166')
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
	<?php ob_start() ;echo $template->printf(_x('%s Prev', 'previous', 'wplatte'), '<span class="meta-nav">&larr;</span>') ;$navPrevText = ob_get_clean() ?>

	<?php ob_start() ;echo $template->printf(_x('Next %s', 'next', 'wplatte'), '<span class="meta-nav">&rarr;</span>') ;$navNextText = ob_get_clean() ?>



	<?php ob_start() ;echo $template->printf(_x('%s Prev', 'previous', 'wplatte'), '<span class="meta-nav">&larr;</span>') ;$navPrevText = ob_get_clean() ?>

	<?php ob_start() ;echo $template->printf(_x('Next %s', 'next', 'wplatte'), '<span class="meta-nav">&rarr;</span>') ;$navNextText = ob_get_clean() ?>


	<?php if (!isset($location)) { ?> <?php $location = '' ?> <?php } ?>

	<?php if (!isset($arrow)) { ?> <?php $arrow = '' ?> <?php } ?>


<?php $arrowLeft = '' ;$arrowRight = '' ?>

<?php if ($wp->isAttachment) { $arrowLeft = 'yes' ;$arrowRight = 'yes' ?>
	<?php ob_start() ?><span class="nav-previous"><?php previous_image_link(false, $navPrevText) ?>
</span><?php $navPrevLink = ob_get_clean() ?>

	<?php ob_start() ?><span class="nav-next"><?php next_image_link(false, $navNextText) ?>
</span><?php $navNextLink = ob_get_clean() ?>

<?php } elseif ($wp->isSingle) { if ($wp->hasPreviousPost or $wp->hasNextPost) { if ($wp->hasPreviousPost) { $arrowLeft = 'yes' ?>
			<?php ob_start() ?><span class="nav-previous"><?php previous_post_link("%link", $navPrevText) ?>
</span><?php $navPrevLink = ob_get_clean() ?>

<?php } if ($wp->hasNextPost) { $arrowRight = 'yes' ?>
			<?php ob_start() ?><span class="nav-next"><?php next_post_link("%link", $navNextText) ?>
</span><?php $navNextLink = ob_get_clean() ?>

<?php } } } else { if ($wp->willPaginate) { if ($wp->hasPreviousPosts) { $arrowLeft = 'yes' ?>
			<?php ob_start() ?><span class="nav-previous"><?php previous_posts_link($navPrevText) ?>
</span><?php $navPrevLink = ob_get_clean() ?>

<?php } if ($wp->hasNextPosts) { $arrowRight = 'yes' ?>
			<?php ob_start() ?><span class="nav-next"><?php next_post_link("%link", $navNextText) ?>
</span><?php $navNextLink = ob_get_clean() ?>

<?php } } } ?>

<?php if ($arrow != '') { if ($arrow == 'left') { ?>
		<?php if ($arrowLeft == 'yes') { echo $navPrevLink ;} ?>

<?php } else { ?>
		<?php if ($arrowRight == 'yes') { echo $navNextLink ;} ?>

<?php } } else { ?>
	<nav class="nav-single <?php echo NTemplateHelpers::escapeHtml($location, ENT_COMPAT) ?>" role="navigation">
	<?php if ($arrowLeft == 'yes') { echo $navPrevLink ;} ?>

	<?php if ($wp->willPaginate) { if (!$wp->isSingular) { echo WpLatteMacros::pagination(array()); } } ?>

	<?php if ($arrowRight == 'yes') { echo $navNextLink ;} ?>

	</nav>
<?php } 