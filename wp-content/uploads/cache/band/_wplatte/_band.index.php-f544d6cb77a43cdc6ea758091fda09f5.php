<?php //netteCache[01]000542a:2:{s:4:"time";s:21:"0.35018000 1472280812";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:56:"D:\xampp\htdocs\bacnice\wp-content\themes\band\index.php";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\index.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'x2h5b4ln9p')
;
// prolog NUIMacros
//
// block content
//
if (!function_exists($_l->blocks['content'][] = '_lba3f443be49_content')) { function _lba3f443be49_content($_l, $_args) { foreach ($_args as $__k => $__v) $$__k = $__v
;if ($wp->isBlog and $blog and $blog->content) { ?>
		<div class="entry-content blog-content">
			<?php echo $blog->content ?>

		</div>
<?php } ?>

<?php if ($wp->havePosts) { ?>

<?php foreach($iterator = new WpLatteLoopIterator() as $post): NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/post-content", ""), array() + get_defined_vars(), $_l->templates['x2h5b4ln9p'])->render() ;endforeach ?>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/pagination", ""), array('location' => 'nav-below') + get_defined_vars(), $_l->templates['x2h5b4ln9p'])->render() ?>

<?php } else { ?>

<?php NCoreMacros::includeTemplate(WpLatteMacros::getTemplatePart("parts/none", ""), array('message' => 'empty-site') + get_defined_vars(), $_l->templates['x2h5b4ln9p'])->render() ?>

<?php } 
}}

//
// end of blocks
//

// template extending and snippets support

$_l->extends = empty($template->_extended) && isset($_control) && $_control instanceof NPresenter ? $_control->findLayoutTemplateFile() : NULL; $template->_extended = $_extended = TRUE;


if ($_l->extends) {
	ob_start();

} elseif (!empty($_control->snippetMode)) {
	return NUIMacros::renderSnippets($_control, $_l, get_defined_vars());
}

//
// main template
//
?>

<?php if ($_l->extends) { ob_end_clean(); return NCoreMacros::includeTemplate($_l->extends, get_defined_vars(), $template)->render(); }
call_user_func(reset($_l->blocks['content']), $_l, get_defined_vars()) ; 