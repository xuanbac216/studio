/*
 * AIT WordPress Theme
 *
 * Copyright (c) 2012, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */
/* Main Initialization Hook */
jQuery(document).ready(function(){
	/* menu.js initialization */
	desktopMenu();
	responsiveMenu();
	/* menu.js initialization */

	/* portfolio-item.js initialization */
	portfolioSingleToggles();
	/* portfolio-item.js initialization */

	/* custom.js initialization */
	renameUiClasses();
	removeUnwantedClasses();

	initWPGallery();
	initColorbox();
	initRatings();
	//initInfieldLabels();
	initSelectBox();

	notificationClose();
	/* custom.js initialization */

	/* Theme Dependent Functions */
		fixInitSelectBox();				// replace initSelectBox call
	/* Theme Dependent Functions */
});
/* Main Initialization Hook */

/* Theme Dependenent Functions */


function fixInitSelectBox(){
	jQuery('.widget_archive select').selectbox();
	jQuery('.widget_categories select').selectbox();
	jQuery('.widget_ait-languages #lang_choice').selectbox();
	jQuery('.widget-container.woocommerce select').selectbox({
		onOpen: function(inst){
			jQuery(this).parent().parent().parent().css({'z-index': 100});
		},
		onClose: function(inst){
			jQuery(this).parent().parent().parent().removeAttr("style");
		}
	});
}
/* Theme Dependenent Function */
