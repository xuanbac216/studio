<?php //netteCache[01]000578a:2:{s:4:"time";s:21:"0.35937000 1472270003";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:92:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\easy-slider\javascript.php";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\easy-slider\javascript.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'z4fgf5l9xk')
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
	<?php echo $el->jsObject ?>

<?php if ($options->theme->general->progressivePageLoading) { ?>
		if(!isResponsive(1024)){
			jQuery("#<?php echo $htmlId ?>-main").waypoint(function(){
				jQuery("#<?php echo $htmlId ?>-main").addClass('load-finished');
				initEasySlider("#<?php echo $htmlId ?>");
			}, { triggerOnce: true, offset: "95%" });
		} else {
			jQuery("#<?php echo $htmlId ?>-main").addClass('load-finished');
			initEasySlider("#<?php echo $htmlId ?>");
		}
<?php } else { ?>
		jQuery("#<?php echo $htmlId ?>-main").addClass('load-finished');
		initEasySlider("#<?php echo $htmlId ?>");
<?php } ?>

	function initEasySlider(selector){
		// selector - "#<?php echo $htmlId ?> ul.easy-slider"
		jQuery(selector).find('ul.easy-slider').css({'opacity':0});
		jQuery(selector).find('ul.easy-slider').bxSlider({
			mode: <?php echo NTemplateHelpers::escapeJs($el->option("sliderMode")) ?>,
<?php if ($el->option("pagerType") == "thumbnails") { ?>
			pagerCustom: selector +" .easy-slider-pager",
<?php } ?>
			adaptiveHeight: true,
			useCSS: false,
			auto: <?php if ($el->option("sliderAutoplay") == "1") { ?>true<?php } else { ?>
false<?php } ?>,
			autoStart: <?php if ($el->option("sliderAutoplay") == "1") { ?>true<?php } else { ?>
false<?php } ?>,
			pause: <?php echo NTemplateHelpers::escapeJs($el->option("sliderAutoplayPause")*1000) ?>,
			autoHover: true,
			autoDelay: 500,
			onSliderLoad: function(currentIndex){
				// count the heights of the
				computeDescriptionHeight(selector);
<?php if ($el->option("sliderMode") == "horizontal") { ?>
				//jQuery(selector).find('ul.easy-slider li:not(.bx-clone):first div.bx-caption').addClass('animation-start');
				jQuery(selector).find('ul.easy-slider li:not(.bx-clone):first div.bx-caption').delay(500).queue(function(next){
					jQuery(this).addClass('animation-start');
					next();
				});
				jQuery(selector).find('ul.easy-slider li:not(.bx-clone):first').show();
<?php } else { ?>
				//jQuery(selector).find('ul.easy-slider li:first div.bx-caption').addClass('animation-start');
				jQuery(selector).find('ul.easy-slider li:first div.bx-caption').delay(500).queue(function(next){
					jQuery(this).addClass('animation-start');
					next();
				});
				jQuery(selector).find('ul.easy-slider li:first').show();
<?php } ?>
				jQuery(selector).find('ul.easy-slider').delay(500).animate({'opacity':1}, 500, function(){
					jQuery(selector).find('.loading').fadeOut('fast');
					jQuery.waypoints('refresh');
				});
			},
			onSlideBefore: function($slideElement, oldIndex, newIndex){
				jQuery(selector).find("ul.easy-slider").children().each(function(){
					jQuery(this).find('div.bx-caption').removeClass('animation-start');
				});
			},
			onSlideAfter: function($slideElement, oldIndex, newIndex){
				if(!jQuery(selector).find("ul.easy-slider").hasClass('has-big-descriptions')){
					$slideElement.find('div.bx-caption').addClass('animation-start');
				}
			}
		});

		jQuery(window).resize(function(){
			if(!isMobile) {
				resizeSliderCaptions(selector);
			}
		});
	}

	function resizeSliderCaptions(selector){
		var container = jQuery(selector).find("ul.easy-slider");
		var sliderHeight = container.children('li.big-description:first').find('img').height();
		var biggestCaption = 0;
		var biggestCaptionGap = 0;
		// reset caption heights
		container.children('li.big-description').each(function(){
			var caption = jQuery(this).find('.bx-cap-table');
			caption.css({'height':''});
		});
		// find new biggest caption
		container.children('li.big-description').each(function(){
			var caption = jQuery(this).find('.bx-caption-desc');
			jQuery(this).css({"visibility":'hidden', 'display' : 'block'});
			var captionHeight = caption.height();
			var captionGap = caption.outerHeight(true)-caption.height();
<?php if ($el->option('sliderMode') == "horizontal") { ?>
			jQuery(this).css({"visibility":'', 'display' : ''});
<?php } else { ?>
			jQuery(this).css({"visibility":'', 'display' : 'none'});
<?php } ?>
			if(captionHeight > biggestCaption){
				biggestCaption = captionHeight;
				biggestCaptionGap = captionGap;
			}
		});

		container.children('li.big-description').each(function(){
			jQuery(this).find('.bx-caption-desc').height(biggestCaption);
		});

		if(biggestCaption != 0){
			container.parent().height(sliderHeight+biggestCaption+biggestCaptionGap);
		}
	}

	function computeDescriptionHeight(selector){
		var container = jQuery(selector).find("ul.easy-slider");
		var sliderHeight = container.children('li:not(.bx-clone):first').find('img').height();
		var biggestCaption = 0;
		var biggestCaptionGap = 0;
		var isABigDescThere = false;
		container.children('li:not(.bx-clone)').each(function(){
			var caption = jQuery(this).find('.bx-cap-table');
			jQuery(this).css({"visibility":'hidden', 'display' : 'block'});
			var captionHeight = caption.outerHeight(true);
<?php if ($el->option('sliderMode') == "horizontal") { ?>
			jQuery(this).css({"visibility":'', 'display' : ''});
<?php } else { ?>
			jQuery(this).css({"visibility":'', 'display' : 'none'});
<?php } ?>
			if(captionHeight > sliderHeight){
				jQuery(this).addClass('big-description');
				isABigDescThere = true;
			}
		});

		if(isABigDescThere){
			jQuery(selector).addClass('has-big-descriptions');
			container.children().each(function(){
				jQuery(this).addClass('big-description');
			});
		}

		// parse the new height
		container.children('li.big-description:not(.bx-clone)').each(function(){
			var caption = jQuery(this).find('.bx-caption-desc');
			jQuery(this).css({"visibility":'hidden', 'display' : 'block'});
			var captionHeight = caption.height();
			var captionGap = caption.outerHeight(true)-caption.height();
<?php if ($el->option('sliderMode') == "horizontal") { ?>
			jQuery(this).css({"visibility":'', 'display' : ''});
<?php } else { ?>
			jQuery(this).css({"visibility":'', 'display' : 'none'});
<?php } ?>
			if(captionHeight > biggestCaption){
				biggestCaption = captionHeight;
				biggestCaptionGap = captionGap;
			}
		});

		container.children('li.big-description').each(function(){
			jQuery(this).find('.bx-caption-desc').height(biggestCaption);
		});

		if(biggestCaption != 0){
			container.parent().height(sliderHeight+biggestCaption+biggestCaptionGap);
		}
	}
});
</script>
