<?php //netteCache[01]000579a:2:{s:4:"time";s:21:"0.81491700 1472280028";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:93:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\contact-form\javascript.php";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\contact-form\javascript.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, 'xlmer68h1s')
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
<script type="text/javascript">
;(function($, undefined){
	//$(function(){
	jQuery(window).load(function(){

		var langCode = <?php echo NTemplateHelpers::escapeJs($currentLang->slug) ?>;

		if(langCode === 'br'){
			langCode = 'pt-BR';
		}else if(langCode === 'cn'){
			langCode = 'zh-CN';
		}else if(langCode === 'tw'){
			langCode = 'zh-TW';
		}

		// set the center of the messages
		var datepickerOptions = {
			firstDay: <?php echo get_option('start_of_week') ?>

		};
		if(langCode != 'en' && $.datepicker.regional[langCode]){
			$.extend(datepickerOptions, $.datepicker.regional[langCode]);
		}
		$('#<?php echo $htmlId ?> form .input-datepicker').datepicker(datepickerOptions);

		$('#<?php echo $htmlId ?> form select').selectbox();

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
	});

	$("#<?php echo $htmlId ?> form input[type=reset]").click(function(){
		$("#<?php echo $htmlId ?> form")[0].reset();
		$('#<?php echo $htmlId ?> form select option').each(function(){
			$(this).removeAttr('selected');
		});
		$('#<?php echo $htmlId ?> form select option:first-child').attr("selected", "selected");
		$('#<?php echo $htmlId ?> form .input-select .sbSelector').html($('#<?php echo $htmlId ?> form .input-select .sbOptions li:first-child').text())
		$("#<?php echo $htmlId ?> form .input-warning").removeClass("input-warning");

	});

	$("#<?php echo $htmlId ?> form").submit(function(){
		$("#<?php echo $htmlId ?> .ait-sc-notification").fadeOut('fast');
		// disable submit button
		$("#<?php echo $htmlId ?> form input[type=submit]").attr('disabled', true);

		var ignored = new Array("submit", "reset", 'button', 'file');	// ignored from validation
		var data = {};
		var sendTheForm = true;
		var checkdata = {};
		// do the validation process for text inputs
		$('#<?php echo $htmlId ?> form input[type=text], #<?php echo $htmlId ?> form textarea, #<?php echo $htmlId ?>
 form input[type=email], #<?php echo $htmlId ?> form input[type=url]').each(function(){
			var type = $(this).attr('type');
			if($.inArray(type, ignored) == -1 && $(this).hasClass('input-required')){
				if(!$(this).val() && $(this).val() == "" || $(this).val() == "http://"){
					$(this).addClass('input-warning');
					$(this).parent().parent().parent().addClass('input-warning');
					checkdata["'"+$(this).attr('name')+"'"] = false;
				} else {
					$(this).removeClass('input-warning');
					$(this).parent().parent().parent().removeClass('input-warning');
					checkdata["'"+$(this).attr('name')+"'"] = true;
				}
			}
		});

		// do the validation process for the rest (radios, checkboxes)
		$('#<?php echo $htmlId ?> form input[type=radio], #<?php echo $htmlId ?> form input[type=checkbox]').each(function(){
			if($(this).hasClass('input-required')){
				checkdata["'"+$(this).attr('name')+"'"] = false;
			}
		});
		$('#<?php echo $htmlId ?> form input[type=radio], #<?php echo $htmlId ?> form input[type=checkbox]').each(function(){
			if($(this).hasClass('input-required')){
				if($(this).is(':checked')){
					checkdata["'"+$(this).attr('name')+"'"] = true;
				}
			}
		});

		var counter = 0;
		$.each(checkdata, function(k, v){ if(v == true){ counter++; } else {
			var elem = jQuery("#<?php echo $htmlId ?> form input[name="+k+"]");
			elem.parent().parent().parent().parent().parent().addClass('input-warning');
		} });
		var mCheckArray = $.map(checkdata, function(k, v) { return [k]; });
		if(counter != mCheckArray.length){ sendTheForm = false; }

		// check the multiinputs
		if(sendTheForm){
			// build the data
			var multiinputs = {};
			$('#<?php echo $htmlId ?> form :input').each(function(){
				var type = $(this).attr('type');
				if($.inArray(type, ignored) == -1){
					var name = $(this).attr('name');
					var value = $(this).attr('value');
					switch(type){
						case "checkbox":
							if($(this).is(":checked")){
								multiinputs[name] += ", " + value;
							}
						break;
						case "radio":
							if($(this).is(":checked")){
								data[name] = value;
							}
						break;
						default:
							data[name] = value;
						break;
					}
				}
			});

			$.each(multiinputs, function(index, value){
				value = value.replace("undefined, ", "");
				data[index] = value;
			});

			// animation
			$('#<?php echo $htmlId ?> form').fadeTo(500, 0.5, function(){
				$("#<?php echo $htmlId ?> .loading").fadeIn("fast");
			});

			// after validation send the form througth ajax
			ait.ajax.post('send-email:send', data).done(function(data){
				if(data.success == true){
					$("#<?php echo $htmlId ?> .loading").fadeOut("fast", function(){
						$("#<?php echo $htmlId ?> .success").fadeIn('fast').hover(function(){
							$(this).fadeOut('slow');
							// display form
							$("#<?php echo $htmlId ?> form").each(function(){
								this.reset();
							});
							$('#<?php echo $htmlId ?> form').fadeTo(500, 1, function(){
								$("#<?php echo $htmlId ?> form input[type=submit]").removeAttr('disabled');
							});
						});
					});
				} else {
					$("#<?php echo $htmlId ?> .loading").fadeOut("fast", function(){
						$("#<?php echo $htmlId ?> .error").fadeIn('fast').hover(function(){
							$(this).fadeOut('slow');
							$('#<?php echo $htmlId ?> form').fadeTo(500, 1, function(){
								$("#<?php echo $htmlId ?> form input[type=submit]").removeAttr('disabled');
							});
						});
					});
				}
			}).fail(function(){
				$("#<?php echo $htmlId ?> .loading").fadeOut("fast", function(){
					$("#<?php echo $htmlId ?> .error").fadeIn('fast').hover(function(){
						$(this).fadeOut('slow');
						$('#<?php echo $htmlId ?> form').fadeTo(500, 1, function(){
							$("#<?php echo $htmlId ?> form input[type=submit]").removeAttr('disabled');
						});
					});
				});
			});
		} else {
			// show the warning message // validation was not sucessful
			$("#<?php echo $htmlId ?> .loading").hide();
			$("#<?php echo $htmlId ?> form input[type=submit]").removeAttr('disabled');
			$("#<?php echo $htmlId ?> .attention").fadeIn('fast').hover(function(){
				$(this).fadeOut('slow');
			});
		}

		return false;	// prevent the page from refreshing
	});
})(jQuery);
</script>
