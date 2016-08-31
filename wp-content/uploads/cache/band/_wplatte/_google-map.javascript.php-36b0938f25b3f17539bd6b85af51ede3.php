<?php //netteCache[01]000577a:2:{s:4:"time";s:21:"0.02363400 1472269986";s:9:"callbacks";a:4:{i:0;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:9:"checkFile";}i:1;s:91:"D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\google-map\javascript.php";i:2;i:1449672792;}i:1;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:20:"NFramework::REVISION";i:2;s:22:"released on 2014-08-28";}i:2;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:15:"WPLATTE_VERSION";i:2;s:5:"2.9.0";}i:3;a:3:{i:0;a:2:{i:0;s:6:"NCache";i:1;s:10:"checkConst";}i:1;s:17:"AIT_THEME_VERSION";i:2;s:4:"1.45";}}}?><?php

// source file: D:\xampp\htdocs\bacnice\wp-content\themes\band\ait-theme\elements\google-map\javascript.php

?><?php
// prolog NCoreMacros
list($_l, $_g) = NCoreMacros::initRuntime($template, '79a2crx7xe')
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
<script id="<?php echo NTemplateHelpers::escapeHtml($htmlId, ENT_COMPAT) ?>-container-script">

	jQuery(window).load(function(){
		var map;
		var mapDiv = jQuery("#<?php echo $htmlId ?>-container");

		var styles = [
			{
				stylers: [
					{ hue: "<?php echo $el->option('mapHue') ?>" },
					{ saturation: "<?php echo $el->option('mapSaturation') ?>" },
					{ lightness: "<?php echo $el->option('mapBrightness') ?>" },
				]
			},
			{ featureType: "landscape", stylers: [
					{ hue: "<?php echo $el->option('landscapeColor') ?>"},
					{ saturation: "<?php if ($el->option('landscapeColor') != '') { ?> <?php echo $el->option('objSaturation') ?>
 <?php } ?>"},
					{ lightness: "<?php if ($el->option('landscapeColor') != '') { ?> <?php echo $el->option('objBrightness') ?>
 <?php } ?>"},
				]
			},
			{ featureType: "administrative", stylers: [
					{ hue: "<?php echo $el->option('administrativeColor') ?>"},
					{ saturation: "<?php if ($el->option('administrativeColor') != '') { ?> <?php echo $el->option('objSaturation') ?>
 <?php } ?>"},
					{ lightness: "<?php if ($el->option('administrativeColor') != '') { ?> <?php echo $el->option('objBrightness') ?>
 <?php } ?>"},
				]
			},
			{ featureType: "road", stylers: [
					{ hue: "<?php echo $el->option('roadsColor') ?>"},
					{ saturation: "<?php if ($el->option('roadsColor') != '') { ?> <?php echo $el->option('objSaturation') ?>
 <?php } ?>"},
					{ lightness: "<?php if ($el->option('roadsColor') != '') { ?> <?php echo $el->option('objBrightness') ?>
 <?php } ?>"},
				]
			},
			{ featureType: "water", stylers: [
					{ hue: "<?php echo $el->option('waterColor') ?>"},
					{ saturation: "<?php if ($el->option('waterColor') != '') { ?> <?php echo $el->option('objSaturation') ?>
 <?php } ?>"},
					{ lightness: "<?php if ($el->option('waterColor') != '') { ?> <?php echo $el->option('objBrightness') ?>
 <?php } ?>"},
				]
			},
			{ featureType: "poi", stylers: [
					{ hue: "<?php echo $el->option('poiColor') ?>"},
					{ saturation: "<?php if ($el->option('poiColor') != '') { ?> <?php echo $el->option('objSaturation') ?>
 <?php } ?>"},
					{ lightness: "<?php if ($el->option('poiColor') != '') { ?> <?php echo $el->option('objBrightness') ?>
 <?php } ?>"},
				]
			},
		];

		mapDiv.gmap3({
			map:{
				<?php if (is_array($address) == false) { ?>address: "<?php echo $address ?>",<?php } ?>

				options:{
<?php if (is_array($address)) { ?>
					center: [<?php echo $address['latitude'] ?>,<?php echo $address['longitude'] ?>],
<?php } ?>
					mapTypeId: google.maps.MapTypeId.<?php echo $el->option('type') ?>,
					zoom: <?php echo $el->option('zoom') ?>,
					scrollwheel: <?php echo $scrollWheel ?>,
					styles: styles,
				}
			},
			marker:{
				values:[
<?php $markers = $el->option('markers') ?>
					<?php if (empty($markers)) { $markers = array() ;} $iterations = 0; foreach ($markers as $mark) { $mark['address'] = str_replace("\xe2\x80\xa8", '', $mark['address']) ;$mark['address'] = str_replace("\xe2\x80\xa9", '', $mark['address']) ;$mark['title'] = str_replace("\xe2\x80\xa8", '', $mark['title']) ;$mark['title'] = str_replace("\xe2\x80\xa9", '', $mark['title']) ;$mark['description'] = str_replace("\xe2\x80\xa8", '', $mark['description']) ;$mark['description'] = str_replace("\xe2\x80\xa9", '', $mark['description']) ?>
												{
							address: "<?php echo $mark['address'] ?>",
							data: <?php if ($mark['url'] != "") { ?>"<div class=\"gmap-infowindow-content\"><a href=\"<?php echo $mark['url'] ?>
\"><h3><?php echo $mark['title'] ?></h3><p><?php echo $mark['description'] ?></p></a></div>"<?php } else { ?>
"<div class=\"gmap-infowindow-content\"><h3><?php echo $mark['title'] ?></h3><p><?php echo $mark['description'] ?>
</p></div>"<?php } ?>,
<?php if ($mark['icon'] != "") { ?>
							options:
							{
								icon: "<?php echo $mark['icon'] ?>"
							}
<?php } ?>
						},
<?php $iterations++; } ?>
				],
				options:{
					draggable: false
				},
				events:{
					click: function(marker, event, context){
						map = jQuery(this).gmap3("get"),
						infowindow = jQuery(this).gmap3({ get:{ name:"infowindow" } });
						if (infowindow){
							infowindow.open(map, marker);
							infowindow.setContent(context.data);
						} else {
							jQuery(this).gmap3({
								infowindow:{
									anchor:marker,
									options:{ content: context.data }
								}
							});
						}
					},
				},
			}
<?php if (is_array($address) and isset($address['streetview'])) { if ($address['streetview']) { ?>
			,streetviewpanorama:{
				options:{
					container: jQuery("#<?php echo $htmlId ?>-container"),
					opts:{
						position: new google.maps.LatLng(<?php echo $address['latitude'] ?>,<?php echo $address['longitude'] ?>),
						pov: {
							heading: parseInt(<?php echo $address['swheading'] ?>),
							pitch: parseInt(<?php echo $address['swpitch'] ?>),
							zoom: parseInt(<?php echo $address['swzoom'] ?>)
						},
						scrollwheel: <?php echo $scrollWheel ?>,
						panControl: false,
						enableCloseButton: true
					}
				}
			},
<?php } } ?>
		});

		setTimeout(function(){
			checkTouchDevice();
		},2000);


<?php if ($options->theme->general->progressivePageLoading) { ?>
			if(!isResponsive(1024)){
				jQuery("#<?php echo $htmlId ?>").waypoint(function(){
					jQuery("#<?php echo $htmlId ?>").parent().parent().addClass('load-finished');
				}, { triggerOnce: true, offset: "95%" });
			} else {
				jQuery("#<?php echo $htmlId ?>").parent().parent().addClass('load-finished');
			}
<?php } else { ?>
			jQuery("#<?php echo $htmlId ?>").parent().parent().addClass('load-finished');
<?php } ?>


		var checkTouchDevice = function() {
			if (Modernizr.touch){
				map = mapDiv.gmap3("get");
				map.setOptions({ draggable : false });
				var draggableClass = 'inactive', draggableTitle = <?php echo NTemplateHelpers::escapeJs(__('Activate map', 'wplatte')) ?>;
				var draggableButton = jQuery('<div class="draggable-toggle-button '+draggableClass+'">'+draggableTitle+'</div>').appendTo(mapDiv);

				draggableButton.click(function () {
					if(jQuery(this).hasClass('active')){
						jQuery(this).removeClass('active').addClass('inactive').text(<?php echo NTemplateHelpers::escapeJs(__('Activate map', 'wplatte')) ?>);
						map.setOptions({ draggable : false });
					} else {
						jQuery(this).removeClass('inactive').addClass('active').text(<?php echo NTemplateHelpers::escapeJs(__('Deactivate map', 'wplatte')) ?>);
						map.setOptions({ draggable : true });
					}
				});
			}
		}

	});

</script>
