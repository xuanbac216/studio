<?php //netteCache[01]000559a:2:{s:4:"time";s:21:"0.74573500 1472269983";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:73:"D:\xampp\htdocs\bacnice\wp-content\themes\band\parts\woocommerce-cart.php";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\parts\woocommerce-cart.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'lsnldjfo1z')
;
// prolog NUIMacros

// snippets support
if (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
if (AitWoocommerce::enabled() and !AitWoocommerce::currentPageIs('cart') and !AitWoocommerce::currentPageIs('checkout')) { ?>
	<div class="ait-woocommerce-cart-widget">
		<div id="ait-woocommerce-cart-wrapper"<?php if ($_l->tmp = array_filter(array(AitWoocommerce::cartIsEmpty() ? 'cart-empty':null, 'cart-wrapper'))) echo ' class="' . NTemplateHelpers::escapeHtml(implode(" ", array_unique($_l->tmp)), ENT_COMPAT) . '"' ?>>
			<div id="ait-woocommerce-cart-header" class="cart-header">
				<span id="ait-woocommerce-cart-info" class="cart-header-info">
					<span id="ait-woocomerce-cart-items-count" class="cart-count"><?php echo NTemplateHelpers::escapeHtml(AitWoocommerce::cartGetItemsCount(), ENT_NOQUOTES) ?></span>
				</span>
			</div>
			<div id="ait-woocommerce-cart" class="cart-content" style="display: none">
				<?php echo AitWoocommerce::cartDisplay() ?>

			</div>
			<!--
			<div id="ait-woocommerce-account-links">
				<ul>
<?php if (!$wp->isUserLoggedIn()) { if (AitWoocommerce::isRegistrationEnabled()) { ?>
						<li id="ln"><a href="<?php echo NTemplateHelpers::escapeHtmlComment(AitWoocommerce::accountUrl()) ?>
"><?php echo NTemplateHelpers::escapeHtmlComment(__('Register', 'wplatte')) ?></a></li>
<?php } ?>
					<li><a href="<?php echo NTemplateHelpers::escapeHtmlComment(AitWoocommerce::accountUrl()) ?>
"><?php echo NTemplateHelpers::escapeHtmlComment(__('Login', 'wplatte')) ?></a></li>
<?php } else { ?>
					<li id="my-account"><a href="<?php echo NTemplateHelpers::escapeHtmlComment(AitWoocommerce::accountUrl()) ?>
"><?php echo NTemplateHelpers::escapeHtmlComment(__('My Account', 'wplatte')) ?></a></li>
<?php } ?>
				</ul>
			</div>
			-->
		</div>
	</div>
<?php } 