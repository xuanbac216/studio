<?php //netteCache[01]000573a:2:{s:4:"time";s:21:"0.80393100 1472270004";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:87:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\member\javascript.php";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\member\javascript.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '4dk8wjjou3')
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
<script id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>-script" type="text/javascript">
jQuery(window).load(function(){
<?php if ($options->theme->general->progressivePageLoading) { ?>
		if(!isResponsive(1024)){
			jQuery("#<?php echo $htmlId ?>-main").waypoint(function(){
				jQuery("#<?php echo $htmlId ?>-main").addClass('load-finished');
			}, { triggerOnce: true, offset: "95%" });
		} else {
			jQuery("#<?php echo $htmlId ?>-main").addClass('load-finished');
		}
<?php } else { ?>
		jQuery("#<?php echo $htmlId ?>-main").addClass('load-finished');
<?php } ?>
	
<?php if ($el->option("hideRows")) { ?>
		var container = jQuery("#<?php echo $htmlId ?>").find('.desc-wrap .entry-content');
		
		container.css({'height': 'auto', 'visibility' : 'hidden'});
		var maxHeight = container.height();
		var minHeight = parseInt(container.css('line-height'))*parseInt(<?php echo NTemplateHelpers::escapeJs($el->option("textRows")) ?>);
		container.css({'height': minHeight, 'visibility' : ''});
		container.attr('data-maxheight', maxHeight);
		container.attr('data-minheight', minHeight);
		
		var hiderMore = container.parent().find('.entry-content-hider.state-more');
		var hiderLess = container.parent().find('.entry-content-hider.state-less');
		container.parent().find('.entry-content-hider').hide();
		if(maxHeight >= minHeight){
			container.css({"height" : container.data("minheight"), "overflow" : "hidden"});
			hiderMore.show();
			hiderMore.click(function(){
				container.animate({ height: container.data('maxheight') }, 500, function(){
					hiderMore.hide();
					hiderLess.show();
				});
			});

			hiderLess.click(function(){
				container.animate({ height: container.data('minheight') }, 500, function(){
					hiderLess.hide();
					hiderMore.show();
				});
			});
		}

<?php } ?>
});
</script>
