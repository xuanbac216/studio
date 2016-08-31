<?php //netteCache[01]000553a:2:{s:4:"time";s:21:"0.99899800 1472280812";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:67:"D:\xampp\htdocs\bacnice\wp-content\themes\band\parts\entry-date.php";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\parts\entry-date.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '30nbh61vmq')
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
<span class="entry-date">
<?php if ($wp->isSingular('event') || $wp->isSingular('job-offer')) { ?>

<?php if ($wp->isSingular('event')) { $meta = $post->meta('event-data') ?>

				<time class="date" datetime="<?php echo NTemplateHelpers::escapeHtml($template->date($meta->dateFrom, 'c'), ENT_COMPAT) ?>">
					<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('j', 'day date format', 'wplatte'), ENT_NOQUOTES) ;$dayFormat = ob_get_clean() ?>

					<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('S', 'english ordinal suffix for the day', 'wplatte'), ENT_NOQUOTES) ;$dayFormatSuffix = ob_get_clean() ?>

					<span class="link-day">
						<?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateFrom, $dayFormat), ENT_NOQUOTES) ;if (!empty($dayFormatSuffix)) { ?>
<small><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateFrom, $dayFormatSuffix), ENT_NOQUOTES) ?>
</small><?php } ?>

					</span>

					<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('F', 'month date format', 'wplatte'), ENT_NOQUOTES) ;$monthFormat = ob_get_clean() ?>

					<span class="link-month">
						<?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateFrom, $monthFormat), ENT_NOQUOTES) ?>

					</span>

					<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('Y',  'year date format', 'wplatte'), ENT_NOQUOTES) ;$yearFormat = ob_get_clean() ?>

					<span class="link-year">
						<?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->dateFrom, $yearFormat), ENT_NOQUOTES) ?>

					</span>
				</time>
<?php } ?>

<?php if ($wp->isSingular('job-offer')) { $meta = $post->meta('offer-data') ?>

				<time class="date" datetime="<?php echo NTemplateHelpers::escapeHtml($template->date($meta->validFrom, 'c'), ENT_COMPAT) ?>">
		 			<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('j', 'day date format', 'wplatte'), ENT_NOQUOTES) ;$dayFormat = ob_get_clean() ?>

		 			<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('S', 'english ordinal suffix for the day', 'wplatte'), ENT_NOQUOTES) ;$dayFormatSuffix = ob_get_clean() ?>

					<span class="link-day">
						<?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->validFrom, $dayFormat), ENT_NOQUOTES) ;if (!empty($dayFormatSuffix)) { ?>
<small><?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->validFrom, $dayFormatSuffix), ENT_NOQUOTES) ?>
</small><?php } ?>

					</span>

					<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('F', 'month date format', 'wplatte'), ENT_NOQUOTES) ;$monthFormat = ob_get_clean() ?>

					<span class="link-month">
						<?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->validFrom, $monthFormat), ENT_NOQUOTES) ?>

					</span>

					<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('Y',  'year date format', 'wplatte'), ENT_NOQUOTES) ;$yearFormat = ob_get_clean() ?>

					<span class="link-year">
						<?php echo NTemplateHelpers::escapeHtml($template->dateI18n($meta->validFrom, $yearFormat), ENT_NOQUOTES) ?>

					</span>
				</time>
<?php } ?>

<?php } else { ?>

		<time class="date" datetime="<?php echo NTemplateHelpers::escapeHtml($post->date('c'), ENT_COMPAT) ?>">
			<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('F', 'month date format', 'wplatte'), ENT_NOQUOTES) ;$monthFormat = ob_get_clean() ?>

			<a class="link-month" href="<?php echo NTemplateHelpers::escapeHtml($post->monthArchiveUrl, ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($template->printf(__('Link to monthly archives: %s', 'wplatte'), $post->dateI18n($monthFormat)), ENT_COMPAT) ?>">
				<?php echo NTemplateHelpers::escapeHtml($post->dateI18n($monthFormat), ENT_NOQUOTES) ?>

			</a>

			<a class="link-day" href="<?php echo NTemplateHelpers::escapeHtml($post->dayArchiveUrl, ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($template->printf(__('Link to daily archives: %s', 'wplatte'), $post->dateI18n), ENT_COMPAT) ?>">
				<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('j', 'day date format', 'wplatte'), ENT_NOQUOTES) ;$dayFormat = ob_get_clean() ?>

				<?php echo NTemplateHelpers::escapeHtml($post->dateI18n($dayFormat), ENT_NOQUOTES) ;if (!empty($dayFormatSuffix)) { } ?>,
			</a>

			<?php ob_start() ;echo NTemplateHelpers::escapeHtml(_x('Y',  'year date format', 'wplatte'), ENT_NOQUOTES) ;$yearFormat = ob_get_clean() ?>

			<a class="link-year" href="<?php echo NTemplateHelpers::escapeHtml($post->yearArchiveUrl, ENT_COMPAT) ?>
" title="<?php echo NTemplateHelpers::escapeHtml($template->printf(__('Link to yearly archives: %s', 'wplatte'), $post->dateI18n($yearFormat)), ENT_COMPAT) ?>">
				<?php echo NTemplateHelpers::escapeHtml($post->dateI18n($yearFormat), ENT_NOQUOTES) ?>

			</a>
		</time>


<?php } ?>
</span>
