<?php //netteCache[01]000583a:2:{s:4:"time";s:21:"0.49502500 1472280028";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:97:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\contact-form\contact-form.latte";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\contact-form\contact-form.latte

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'rn54gezqok')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
NCoreMacros::includeTemplate($element->common('header'), $template->getParameters(), $_l->templates['rn54gezqok'])->render() ?>

<div id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>" class="<?php echo NTemplateHelpers::escapeHtml($htmlClass, ENT_COMPAT) ?>">
	<form method="post">
	<div class="form-container">
<?php $check = rand() ?>
		<input type="hidden" name="response-email-check" value="<?php echo NTemplateHelpers::escapeHtml($check, ENT_COMPAT) ?>" />
		<input type="hidden" name="response-email-address" value="<?php echo NTemplateHelpers::escapeHtml($element->option('address'), ENT_COMPAT) ?>" />
		<input type="hidden" name="response-email-sender" value="<?php echo NTemplateHelpers::escapeHtml($element->option('sender'), ENT_COMPAT) ?>" />
		<input type="hidden" name="response-email-subject" value="<?php echo NTemplateHelpers::escapeHtml($element->option('subject'), ENT_COMPAT) ?>" />
		<input type="hidden" name="response-email-content" value="<?php echo NTemplateHelpers::escapeHtml($element->option('content'), ENT_COMPAT) ?>" />


<?php $inputs = $element->option('inputs');
		if($inputs == '') $inputs = array() ?>

<?php $inputCount = count($inputs)+20 ?>

<?php $isDivOpened = false ;$inputIterator = 0 ?>

<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator($inputs) as $input) { if ($input['size'] == "halftwo") { if ($inputIterator == 0) { ?>
				<div class="halfrow">
<?php $isDivOpened = true ;} } else { if ($inputIterator == 1) { ?>
				</div>
<?php $isDivOpened = false ;$inputIterator = 0 ;} } ?>

<?php if ($input['type'] == "textarea") { ?>
			<p class="input-textarea <?php if ($input['size'] == "halfone") { ?>half-size<?php } elseif ($input['size'] == "halftwo") { ?>
half-size-fl<?php } else { ?>full-size<?php } ?> <?php if ($input['label'] == '') { ?>
nolabel<?php } ?> <?php if ($input['required']) { ?>mark-required<?php } ?>" style="z-index: <?php echo NTemplateHelpers::escapeHtml(NTemplateHelpers::escapeCss($inputCount), ENT_COMPAT) ?>">
				<span class="input-row">
<?php if ($input['label']) { ?>
					<span class="input-label">
						<label for="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>" class="label"><?php echo NTemplateHelpers::escapeHtml($input['label'], ENT_NOQUOTES) ?></label>
					</span>
<?php } ?>
					<span class="input-wrap">
						<textarea <?php if ($input['required']) { ?>class="input-required"<?php } ?>
 name="<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>" id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>" placeholder="<?php echo NTemplateHelpers::escapeHtml($input['placeholder'], ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml($input['value'], ENT_NOQUOTES) ?></textarea>
					</span>
				</span>
			</p>
<?php } elseif ($input['type'] == "select") { $values = array() ?>
			<p class="input-select <?php if ($input['size'] == "halfone") { ?>half-size<?php } elseif ($input['size'] == "halftwo") { ?>
half-size-fl<?php } else { ?>full-size<?php } ?> <?php if ($input['label'] == '') { ?>
nolabel<?php } ?> <?php if ($input['required']) { ?>mark-required<?php } ?>" style="z-index: <?php echo NTemplateHelpers::escapeHtml(NTemplateHelpers::escapeCss($inputCount), ENT_COMPAT) ?>">
				<span class="input-row">
<?php if ($input['label']) { ?>
					<span class="input-label">
						<label for="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>" class="label"><?php echo NTemplateHelpers::escapeHtml($input['label'], ENT_NOQUOTES) ?></label>
					</span>
<?php } ?>
					<span class="input-wrap">
						<select <?php if ($input['required']) { ?>class="input-required"<?php } ?>
 name="<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>" id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>">
<?php $iterations = 0; foreach (explode(";",$input['value']) as $option) { if ($el->option('escapeFormInputs')) { $value = AitUtils::webalize($option) ;} else { $value = $option ;} if (in_array($value, $values)) { $counts = array_count_values($values) ?>
								<option value="<?php echo NTemplateHelpers::escapeHtml($value, ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($counts[$value], ENT_COMPAT) ?>"><?php echo NTemplateHelpers::escapeHtml(trim($option), ENT_NOQUOTES) ?></option>
<?php array_push($values, $value) ;} else { ?>
								<option value="<?php echo NTemplateHelpers::escapeHtml($value, ENT_COMPAT) ?>
"><?php echo NTemplateHelpers::escapeHtml(trim($option), ENT_NOQUOTES) ?></option>
<?php array_push($values, $value) ;} $iterations++; } ?>
						</select>
					</span>
				</span>
			</p>
<?php } elseif ($input['type'] == "checkbox-horizontal") { $values = array() ?>
			<p class="input-chbox-horizontal <?php if ($input['size'] == "halfone") { ?>half-size<?php } elseif ($input['size'] == "halftwo") { ?>
half-size-fl<?php } else { ?>full-size<?php } ?> <?php if ($input['label'] == '') { ?>
nolabel<?php } ?> <?php if ($input['required']) { ?>mark-required<?php } ?>" style="z-index: <?php echo NTemplateHelpers::escapeHtml(NTemplateHelpers::escapeCss($inputCount), ENT_COMPAT) ?>">
				<span class="input-row">
<?php if ($input['label']) { ?>
					<span class="input-label">
						<span class="label"><?php echo NTemplateHelpers::escapeHtml($input['label'], ENT_NOQUOTES) ?></span>
					</span>
<?php } ?>
					<span class="input-wrap">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator(explode(";",$input['value'])) as $option) { if ($el->option('escapeFormInputs')) { $value = AitUtils::webalize($option) ;} else { $value = $option ;} if (in_array($value, $values)) { $counts = array_count_values($values) ?>
							<span>
								<label>
								<input <?php if ($input['required']) { ?>class="input-required"<?php } ?>
 type="checkbox" name="<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
" id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($iterator->getCounter(), ENT_COMPAT) ?>
" value="<?php echo NTemplateHelpers::escapeHtml($value, ENT_COMPAT) ?>-<?php echo NTemplateHelpers::escapeHtml($counts[$value], ENT_COMPAT) ?>
" /><?php echo NTemplateHelpers::escapeHtml(trim($option), ENT_NOQUOTES) ?>

<?php array_push($values, $value) ?>
								</label>
							</span>
<?php } else { ?>
							<span>
								<label>
								<input <?php if ($input['required']) { ?>class="input-required"<?php } ?>
 type="checkbox" name="<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
" id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($iterator->getCounter(), ENT_COMPAT) ?>
" value="<?php echo NTemplateHelpers::escapeHtml($value, ENT_COMPAT) ?>" /><?php echo NTemplateHelpers::escapeHtml(trim($option), ENT_NOQUOTES) ?>

<?php array_push($values, $value) ?>
								</label>
							</span>
<?php } $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
					</span>
				</span>
			</p>
<?php } elseif ($input['type'] == "checkbox-vertical") { $values = array() ?>
			<p class="input-chbox-vertical <?php if ($input['size'] == "halfone") { ?>half-size<?php } elseif ($input['size'] == "halftwo") { ?>
half-size-fl<?php } else { ?>full-size<?php } ?> <?php if ($input['label'] == '') { ?>
nolabel<?php } ?> <?php if ($input['required']) { ?>mark-required<?php } ?>" style="z-index: <?php echo NTemplateHelpers::escapeHtml(NTemplateHelpers::escapeCss($inputCount), ENT_COMPAT) ?>">
				<span class="input-row">
<?php if ($input['label']) { ?>
					<span class="input-label">
						<span class="label"><?php echo NTemplateHelpers::escapeHtml($input['label'], ENT_NOQUOTES) ?></span>
					</span>
<?php } ?>
					<span class="input-wrap">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator(explode(";",$input['value'])) as $option) { if ($el->option('escapeFormInputs')) { $value = AitUtils::webalize($option) ;} else { $value = $option ;} if (in_array($value, $values)) { $counts = array_count_values($values) ?>
							<span>
								<label>
								<input <?php if ($input['required']) { ?>class="input-required"<?php } ?>
 type="checkbox" name="<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
" id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($iterator->getCounter(), ENT_COMPAT) ?>
" value="<?php echo NTemplateHelpers::escapeHtml($value, ENT_COMPAT) ?>-<?php echo NTemplateHelpers::escapeHtml($counts[$value], ENT_COMPAT) ?>
" /><?php echo NTemplateHelpers::escapeHtml(trim($option), ENT_NOQUOTES) ?>

<?php array_push($values, $value) ?>
								</label>
							</span>
<?php } else { ?>
							<span>
								<label>
								<input <?php if ($input['required']) { ?>class="input-required"<?php } ?>
 type="checkbox" name="<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
" id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($iterator->getCounter(), ENT_COMPAT) ?>
" value="<?php echo NTemplateHelpers::escapeHtml($value, ENT_COMPAT) ?>" /><?php echo NTemplateHelpers::escapeHtml(trim($option), ENT_NOQUOTES) ?>

<?php array_push($values, $value) ?>
								</label>
							</span>
<?php } $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
					</span>
				</span>
			</p>
<?php } elseif ($input['type'] == "radio-horizontal") { $values = array() ?>
			<p class="input-rbutt-horizontal <?php if ($input['size'] == "halfone") { ?>half-size<?php } elseif ($input['size'] == "halftwo") { ?>
half-size-fl<?php } else { ?>full-size<?php } ?> <?php if ($input['label'] == '') { ?>
nolabel<?php } ?> <?php if ($input['required']) { ?>mark-required<?php } ?>" style="z-index: <?php echo NTemplateHelpers::escapeHtml(NTemplateHelpers::escapeCss($inputCount), ENT_COMPAT) ?>">
				<span class="input-row">
<?php if ($input['label']) { ?>
					<span class="input-label">
						<span class="label"><?php echo NTemplateHelpers::escapeHtml($input['label'], ENT_NOQUOTES) ?></span>
					</span>
<?php } ?>
					<span class="input-wrap">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator(explode(";",$input['value'])) as $option) { if ($el->option('escapeFormInputs')) { $value = AitUtils::webalize($option) ;} else { $value = $option ;} if (in_array($value, $values)) { $counts = array_count_values($values) ?>
							<span>
								<label>
								<input <?php if ($input['required']) { ?>class="input-required"<?php } ?>
 type="radio" name="<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
" id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($iterator->getCounter(), ENT_COMPAT) ?>
" value="<?php echo NTemplateHelpers::escapeHtml($value, ENT_COMPAT) ?>-<?php echo NTemplateHelpers::escapeHtml($counts[$value], ENT_COMPAT) ?>
" /><?php echo NTemplateHelpers::escapeHtml(trim($option), ENT_NOQUOTES) ?>

<?php array_push($values, $value) ?>
								</label>
							</span>
<?php } else { ?>
							<span>
								<label>
								<input <?php if ($input['required']) { ?>class="input-required"<?php } ?>
 type="radio" name="<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
" id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($iterator->getCounter(), ENT_COMPAT) ?>
" value="<?php echo NTemplateHelpers::escapeHtml($value, ENT_COMPAT) ?>" /><?php echo NTemplateHelpers::escapeHtml(trim($option), ENT_NOQUOTES) ?>

<?php array_push($values, $value) ?>
								</label>
							</span>
<?php } $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
					</span>
				</span>
			</p>
<?php } elseif ($input['type'] == "radio-vertical") { $values = array() ?>
			<p class="input-rbutt-vertical <?php if ($input['size'] == "halfone") { ?>half-size<?php } elseif ($input['size'] == "halftwo") { ?>
half-size-fl<?php } else { ?>full-size<?php } ?> <?php if ($input['label'] == '') { ?>
nolabel<?php } ?> <?php if ($input['required']) { ?>mark-required<?php } ?>" style="z-index: <?php echo NTemplateHelpers::escapeHtml(NTemplateHelpers::escapeCss($inputCount), ENT_COMPAT) ?>">
				<span class="input-row">
<?php if ($input['label']) { ?>
					<span class="input-label">
						<span class="label"><?php echo NTemplateHelpers::escapeHtml($input['label'], ENT_NOQUOTES) ?></span>
					</span>
<?php } ?>
					<span class="input-wrap">
<?php $iterations = 0; foreach ($iterator = $_l->its[] = new NSmartCachingIterator(explode(";",$input['value'])) as $option) { if ($el->option('escapeFormInputs')) { $value = AitUtils::webalize($option) ;} else { $value = $option ;} if (in_array($value, $values)) { $counts = array_count_values($values) ?>
							<span>
								<label>
								<input <?php if ($input['required']) { ?>class="input-required"<?php } ?>
 type="radio" name="<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
" id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($iterator->getCounter(), ENT_COMPAT) ?>
" value="<?php echo NTemplateHelpers::escapeHtml($value, ENT_COMPAT) ?>-<?php echo NTemplateHelpers::escapeHtml($counts[$value], ENT_COMPAT) ?>
" /><?php echo NTemplateHelpers::escapeHtml(trim($option), ENT_NOQUOTES) ?>

<?php array_push($values, $value) ?>
								</label>
							</span>
<?php } else { ?>
							<span>
								<label>
								<input <?php if ($input['required']) { ?>class="input-required"<?php } ?>
 type="radio" name="<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
" id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($iterator->getCounter(), ENT_COMPAT) ?>
" value="<?php echo NTemplateHelpers::escapeHtml($value, ENT_COMPAT) ?>" /><?php echo NTemplateHelpers::escapeHtml(trim($option), ENT_NOQUOTES) ?>

<?php array_push($values, $value) ?>
								</label>
							</span>
<?php } $iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>
					</span>
				</span>
			</p>
<?php } elseif ($input['type'] == "date") { ?>
			<p class="input-date <?php if ($input['size'] == "halfone") { ?>half-size<?php } elseif ($input['size'] == "halftwo") { ?>
half-size-fl<?php } else { ?>full-size<?php } ?> <?php if ($input['label'] == '') { ?>
nolabel<?php } ?> <?php if ($input['required']) { ?>mark-required<?php } ?>" style="z-index: <?php echo NTemplateHelpers::escapeHtml(NTemplateHelpers::escapeCss($inputCount), ENT_COMPAT) ?>">
				<span class="input-row">
<?php if ($input['label']) { ?>
					<span class="input-label">
						<label for="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>" class="label"><?php echo NTemplateHelpers::escapeHtml($input['label'], ENT_NOQUOTES) ?></label>
					</span>
<?php } ?>
					<span class="input-wrap">
						<input class="input-datepicker <?php if ($input['required']) { ?>input-required<?php } ?>
" type="text" name="<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
" id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>
" value="<?php echo NTemplateHelpers::escapeHtml($input['value'], ENT_COMPAT) ?>
" placeholder="<?php echo NTemplateHelpers::escapeHtml($input['placeholder'], ENT_COMPAT) ?>" />
					</span>
				</span>
			</p>
<?php } else { ?>
			<p class="input-text <?php if ($input['size'] == "halfone") { ?>half-size<?php } elseif ($input['size'] == "halftwo") { ?>
half-size-fl<?php } else { ?>full-size<?php } ?> <?php if ($input['label'] == '') { ?>
nolabel<?php } ?> <?php if ($input['required']) { ?>mark-required<?php } ?>" style="z-index: <?php echo NTemplateHelpers::escapeHtml(NTemplateHelpers::escapeCss($inputCount), ENT_COMPAT) ?>">
				<span class="input-row">
<?php if ($input['label']) { ?>
					<span class="input-label">
						<label for="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>" class="label"><?php echo NTemplateHelpers::escapeHtml($input['label'], ENT_NOQUOTES) ?></label>
					</span>
<?php } ?>
					<span class="input-wrap">
						<input <?php if ($input['required']) { ?>class="input-required"<?php } ?> type="<?php echo NTemplateHelpers::escapeHtml($input['type'], ENT_COMPAT) ?>
" name="<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>" id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>
-<?php echo NTemplateHelpers::escapeHtml($input['name'], ENT_COMPAT) ?>" value="<?php echo NTemplateHelpers::escapeHtml($input['value'], ENT_COMPAT) ?>
" placeholder="<?php echo NTemplateHelpers::escapeHtml($input['placeholder'], ENT_COMPAT) ?>" />
					</span>
				</span>
			</p>
<?php } ?>

<?php if ($input['size'] == "halftwo") { if ($inputIterator == 1) { ?>
				</div>
<?php $isDivOpened = false ;$inputIterator = 0 ;} else { $inputIterator = $inputIterator + 1 ;} } ?>

<?php $inputCount = $inputCount -1 ;$iterations++; } array_pop($_l->its); $iterator = end($_l->its) ?>

<?php if ($isDivOpened) { ?>
	</div>
<?php } ?>

<?php if ($element->option('inputs') != null) { if ($element->option('captchaInclude')) { ?>
			<p class="input-captcha full-size <?php if ($element->option('captchaLabel') == '') { ?>
nolabel<?php } ?> mark-required">
				<span class="input-row">
<?php if ($element->option('captchaLabel') != '') { ?>
					<span class="input-label">
						<label for="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>
-captcha-check" class="label"><?php echo NTemplateHelpers::escapeHtml($element->option('captchaLabel'), ENT_NOQUOTES) ?></label>
					</span>
<?php } ?>
					<span class="input-wrap">
						<img src="<?php echo NTemplateHelpers::escapeHtml($element->captchaImageUrl($check), ENT_COMPAT) ?>" alt="captcha" />
						<input class="input-required" type="text" name="captcha-check" id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>-captcha-check" value="" />
<?php if ($element->option('captchaText') != '') { ?>
							<span class="captcha-text"><?php echo NTemplateHelpers::escapeHtml($element->option('captchaText'), ENT_NOQUOTES) ?></span>
<?php } ?>
					</span>
				</span>
			</p>
<?php } ?>
		<p class="input-submit full-size">
			<span class="input-row">
				<span class="submit-wrap">
					<input class="input-required" type="submit" name="form-submit" value="<?php echo NTemplateHelpers::escapeHtml(__('Submit', 'wplatte'), ENT_COMPAT) ?>" />

<?php if ($element->option('resetButtonDisplay')) { ?>
					<input class="input-required" type="reset" name="form-reset" value="<?php echo NTemplateHelpers::escapeHtml(__('Reset', 'wplatte'), ENT_COMPAT) ?>" />
<?php } ?>
				</span>
			</span>
		</p>
<?php } ?>

	</div>
	</form>
	<div class="loading" style="display: none"><span class="ait-preloader">Loading ...</span></div>
	<div class="notifications">
		<div class="ait-sc-notification success" style="display: none">
			<div class="notify-wrap">
				<p><?php echo $element->option('msgsuccess') ?></p>
			</div>
		</div>
		<div class="ait-sc-notification attention" style="display: none">
			<div class="notify-wrap">
				<p><?php echo $element->option('msgwarning') ?></p>
			</div>
		</div>
		<div class="ait-sc-notification error" style="display: none">
			<div class="notify-wrap">
				<p><?php echo $element->option('msgerror') ?></p>
			</div>
		</div>
	</div>
</div>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("ait-theme/elements/contact-form/javascript", ""), array() + get_defined_vars(), $_l->templates['rn54gezqok'])->render() ;