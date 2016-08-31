// SIDEBAR OPTIONS
$(document).ready(function () {

	// SIDEBAR OPEN
	$(".soundtheme-btn-sidebar").click(function () {
	   $(".soundtheme-sidebar-menu").animate({
	       right: '0'
	   }, 500, 'easeInOutExpo');
	   $(".soundtheme-menu-icon").animate({
	       opacity: '0'
	   }, 400, 'easeInOutExpo');
	});

	// SIDEBAR CLOSE
	$("#content, .soundtheme-sidebar-closed").click(function () {
	   $(".soundtheme-sidebar-menu").animate({
	       right: '-400'
	   }, 500, 'easeInOutExpo');
	   $(".soundtheme-menu-icon").animate({
	       opacity: '0.9'
	   }, 700, 'easeInOutExpo');
	});


	// SEARCH OPEN
	$(".soundtheme-btn-search").click(function () {
	   $(".soundtheme-top-search").animate({
	       top: '75px'
	   }, 300, 'easeInOutExpo');
	   $(".soundtheme-menu-icon").animate({
	       opacity: '0'
	   }, 400, 'easeInOutExpo');
	});

	// SEARCH CLOSE
	$("#content").click(function () {
	   $(".soundtheme-menu-icon").animate({
	       opacity: '0.9'
	   }, 700, 'easeInOutExpo');
	   $(".soundtheme-top-search").animate({
	       top: '-75px'
	   }, 500, 'easeInOutExpo');
	});


	// SEARCH ENTER CLOSE
	$('#searchform').keypress(function(event){
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
    	$(".soundtheme-menu-icon").animate({
	       opacity: '0.9'
	  	}, 500, 'easeInOutExpo');
	   	$(".soundtheme-top-search").animate({
	       top: '-75px'
	   	}, 300, 'easeInOutExpo');
    }

	});

});

// VIDEO FIXED
var $allVideos = $("iframe[src^='//player.vimeo.com'], iframe[src^='//www.youtube.com'], object, embed"),
	$fluidEl = $("body");
	$allVideos.each(function() {
	  $(this)
	    .data('aspectRatio', this.height / this.width)
	    .removeAttr('height')
	    .removeAttr('width');

	});
	$(window).resize(function() {
	  var newWidth = $fluidEl.width();
	  $allVideos.each(function() {
	    var $el = $(this);
	    $el
	      .width(newWidth)
	      .height(newWidth * $el.attr('aspectRatio'));

	  });
	}).resize();