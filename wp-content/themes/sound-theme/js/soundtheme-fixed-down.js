// SIDEBAR MENU
	var $link = $(".main-nav a");
	var $slide = $(".main-nav ul");
	$link.on('click', function() { 
		var el = $(this);
		el.next($slide)
		.slideToggle();
	 });
	$link
	.closest($slide)
	.prev($link)
	.addClass("parent");
	$(".parent").on('click', function() { 
		var el = $(this);
		el.toggleClass("parent-expanded");
	});