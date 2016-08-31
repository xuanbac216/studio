

(function($, $window){

	"use strict";

	var Carousel = function(element, options)
	{
		var elem = $(element);
		var obj = this;
		var settings = $.extend({}, options.defaults, options.current);

		var interval;
		var glDirection = "right";
		var glAutoplay = 0;
		var glFading = 0;
		var glInfinite = true;
		var time = 5000;
		var visible;
		var moving = false;
		var item = {};

		var carouselInit = function(){
			carouselTransform();
			carouselSetVisible();
			carouselResize();

			if(settings.layout == "box"){
				glAutoplay = typeof settings.boxEnableAutoplay != "undefined" ? settings.boxEnableAutoplay : 0;
				glFading = typeof settings.boxEnableFading != "undefined" ? settings.boxEnableFading : 0;
			} else {
				glAutoplay = typeof settings.listEnableAutoplay != "undefined" ? settings.listEnableAutoplay : 0;
				glFading = typeof settings.listEnableFading != "undefined" ? settings.listEnableFading : 0;
			}

			if(elem.hasClass('elm-testimonials')){
				carouselTransformItems();
			}

			carouselArrowsCreate();
			carouselArrowLeft();
			carouselArrowRight();
			if(glAutoplay != 0){
				carouselPlay();
				carouselHover();
			}

			if(glInfinite){
				var container = elem.find('.carousel-container');
				container.append(container.find('.item').parent().clone());
				container.prepend(container.find('.item:last').parent());
				container.css({'margin-left':-(item.width+item.gap)});
			}

			elem.find('.loading').fadeOut('fast');
		};

		var carouselTransformItems = function(){
			var height = carouselItemHeight();
			var container = elem.find('.carousel-container');
			container.children('div.item-box').each(function(){
				jQuery(this).find('.item-excerpt').height(height);
			});
		};

		var carouselItemHeight = function(){
			var height = 0;
			var container = elem.find('.carousel-container');

			container.children('div.item-box').each(function(){
				var excerpt = jQuery(this).find('.item-excerpt');
				if(excerpt.height() > height){
					height = excerpt.height();
				}
			});

			return height;
		};

		var carouselTransform = function(){
			elem.parent().parent().addClass('carousel-enabled');
			item.count = elem.find('.carousel-item').length;
			carouselRefresh();
			//elem.css({'overflow' : 'hidden'});
		};

		var carouselRefresh = function(){
			var container = elem.find('.carousel-container');

			container.removeAttr('style');
			container.find('.carousel-item').each(function(){
				$(this).removeAttr('style');
			});

			item.width = parseInt(container.find('.carousel-item').first().width());
			item.gap = parseInt(container.find('.carousel-item').first().outerWidth(true)-item.width);
			visible = Math.round(elem.parent().width() / (item.width+item.gap));
			container.find('.carousel-item').each(function(){
				$(this).css({'width' : item.width, 'margin-right' : item.gap});
			});

			container.width(parseInt((item.width+item.gap)*item.count));
			container.css({'margin-left':-(item.width+item.gap)});

			carouselResetVisible();

			container.find('.carousel-item').css({'visibility':'visible'});
		};

		var carouselResize = function(){
			$window.resize(function(){
				carouselRefresh();
			});
		};

		var carouselSetVisible = function(){
			var container = elem.find('.carousel-container');
			container.find('.carousel-item').each(function(){
				$(this).removeClass('first-visible').removeClass('last-visible');
			});
			var firstVisible = parseInt(container.attr('data-first'));
			var lastVisible = parseInt(container.attr('data-first'))+(visible-1);
			carouselSetRange(firstVisible, 'first-visible');
			carouselSetRange(lastVisible, 'last-visible');
		};

		var carouselResetVisible = function(){
			var container = elem.find('.carousel-container');
			container.attr('data-first', 1);
			carouselSetVisible();
		}

		var carouselSetRange = function(id, htmlclass){
			elem.find('.carousel-item').each(function(){
				if(parseInt($(this).data('id')) == id){
					$(this).addClass(htmlclass);
				}
			});
		};

		var carouselPlay = function(){
			interval = setInterval(function(){
                carouselMoveAuto();
            }, time);
		};

		var carouselStop = function(){
			clearInterval(interval);
		};

		var carouselFade = function(direction, multiplier){
			var container = elem.find('.carousel-container');
			switch(direction){
				case "left":
					// left
					if(glInfinite){
						moving = true;
						var counter = parseInt(container.attr('data-first'));
						var localScroll = parseInt((item.width+item.gap)*multiplier);
						var move = parseInt(container.css('margin-left')) + localScroll;
						container.animate({'opacity': 0}, 250, function(){
							container.delay(500).animate({marginLeft : move}, {queue: true, duration: 100, complete: function(){
								container.find('div.item-box:first').before(container.find('div.item-box:last'));
								container.css({'margin-left':-(item.width+item.gap)});
								carouselSetVisible();
								container.delay(100).animate({'opacity': 1}, 250, function(){
									moving = false;
								});
							}});
						});
					} else {
						firstId = 1;
						firstVisibleId = parseInt(container.attr('data-first'));
						if(firstVisibleId > 0){
							moving = true;
	                        if(multiplier > parseInt(firstVisibleId - firstId)){
	                            localMult = firstVisibleId - firstId;
	                        } else {
	                            localMult = multiplier;
	                        }

	                        var localScroll = parseInt((item.width+item.gap)*localMult);
	                        var move = parseInt(container.css('margin-left')) + localScroll;
							container.animate({marginLeft : move}, {queue: true, duration: 500, complete: function(){
								container.attr('data-first', parseInt(firstVisibleId-localMult));
								carouselSetVisible();
								moving = false;
							}});
						}
					}
				break;
				case "right":
					// right
					if(glInfinite){
						moving = true;
						var counter = parseInt(container.attr('data-first'));
						var localScroll = parseInt((item.width+item.gap)*multiplier);
						var move = parseInt(container.css('margin-left')) - localScroll;
						container.animate({'opacity': 0}, 250, function(){
							container.delay(500).animate({marginLeft : move}, {queue: true, duration: 100, complete: function(){
								container.find('div.item-box:last').after(container.find('div.item-box:first'));
								container.css({'margin-left':-(item.width+item.gap)});
								carouselSetVisible();
								container.delay(100).animate({'opacity': 1}, 250, function(){
									moving = false;
								});
							}});
						});
					} else {
						firstId = parseInt(container.attr('data-first'));
	                    lastId = parseInt(container.attr('data-last'));
	                    lastVisibleId = parseInt(firstId+(visible-1));
	                    if(lastVisibleId < lastId){
	                    	moving = true;
	                        if(multiplier > parseInt(lastId - lastVisibleId)){
	                            localMult = lastId - lastVisibleId;
	                        } else {
	                            localMult = multiplier;
	                        }

	                        var localScroll = parseInt((item.width+item.gap)*localMult);
	                        var move = parseInt(container.css('margin-left')) - localScroll;
	                        container.animate({marginLeft : move}, {queue: true, duration: 500, complete: function(){
								container.attr('data-first', parseInt(firstId+localMult));
								carouselSetVisible();
								moving = false;
							}});
	                    }
					}
				break;
			}
		};

		var carouselMove = function(direction, multiplier){
			var container = elem.find('.carousel-container');
			switch(direction){
				case "left":
					// left
					if(glInfinite){
						moving = true;
						var counter = parseInt(container.attr('data-first'));
						var localScroll = parseInt((item.width+item.gap)*multiplier);
						var move = parseInt(container.css('margin-left')) + localScroll;
						container.animate({marginLeft : move}, {queue: true, duration: 500, complete: function(){
							container.find('div.item-box:first').before(container.find('div.item-box:last'));
							container.css({'margin-left':-(item.width+item.gap)});
							carouselSetVisible();
							moving = false;
						}});
					} else {
						firstId = 1;
						firstVisibleId = parseInt(container.attr('data-first'));
						if(firstVisibleId > 0){
							moving = true;
	                        if(multiplier > parseInt(firstVisibleId - firstId)){
	                            localMult = firstVisibleId - firstId;
	                        } else {
	                            localMult = multiplier;
	                        }

	                        var localScroll = parseInt((item.width+item.gap)*localMult);
	                        var move = parseInt(container.css('margin-left')) + localScroll;
							container.animate({marginLeft : move}, {queue: true, duration: 500, complete: function(){
								container.attr('data-first', parseInt(firstVisibleId-localMult));
								carouselSetVisible();
								moving = false;
							}});
						}
					}
				break;
				case "right":
					// right
					if(glInfinite){
						moving = true;
						var counter = parseInt(container.attr('data-first'));
						var localScroll = parseInt((item.width+item.gap)*multiplier);
						var move = parseInt(container.css('margin-left')) - localScroll;
						container.animate({marginLeft : move}, {queue: true, duration: 500, complete: function(){
							container.find('div.item-box:last').after(container.find('div.item-box:first'));
							container.css({'margin-left':-(item.width+item.gap)});
							carouselSetVisible();
							moving = false;
						}});
					} else {
						firstId = parseInt(container.attr('data-first'));
	                    lastId = parseInt(container.attr('data-last'));
	                    lastVisibleId = parseInt(firstId+(visible-1));
	                    if(lastVisibleId < lastId){
	                    	moving = true;
	                        if(multiplier > parseInt(lastId - lastVisibleId)){
	                            localMult = lastId - lastVisibleId;
	                        } else {
	                            localMult = multiplier;
	                        }

	                        var localScroll = parseInt((item.width+item.gap)*localMult);
	                        var move = parseInt(container.css('margin-left')) - localScroll;
	                        container.animate({marginLeft : move}, {queue: true, duration: 500, complete: function(){
								container.attr('data-first', parseInt(firstId+localMult));
								carouselSetVisible();
								moving = false;
							}});
	                    }
					}
				break;
			}
		};

		var carouselMoveManual = function(index){
			var container = elem.find('.carousel-container');
			var firstVisibleElementId = parseInt(container.attr('data-first'));
            var lastVisibleElementId = parseInt(container.attr('data-first'))+visible-1;
            var allElements = container.attr('data-last');
            /*if(index > lastVisibleElementId){
                var move = index - lastVisibleElementId;
                carouselMove('right', move);
            } else if (index < firstVisibleElementId){
                var move = firstVisibleElementId - index;
                carouselMove('left', move);
            } else {
                // in range, dont move anything
            }*/
            if(!glInfinite){
	            if(glDirection == "right"){
	            	if(lastVisibleElementId == allElements){
	            		glDirection = "left";
	            	}
	            } else {
	            	if(firstVisibleElementId == 1){
	            		glDirection = "right";
	            	}
	            }
            }

            if(glFading != 0){
            	carouselFade(glDirection, index);
            } else {
            	carouselMove(glDirection, index);
            }
		};

		var carouselMoveAuto = function(){
			if(moving == false){
				carouselMoveManual(1);
			}
		};

		/* user functions */
		var carouselHover = function(){
			elem.parent().hover(function(){
				carouselStop();
			}, function(){
				carouselPlay();
			});
		};

		var carouselArrowsCreate = function(){
			// create arrows
			elem.parent().append('<div class="carousel-arrows"><div class="arrow arrow-left">&lt;</div><div class="arrow arrow-right">&gt;</div></div>');
		};

		var carouselArrowLeft = function(){
			// action for left arrow
			elem.parent().find('.carousel-arrows .arrow-left').css({'cursor' : 'pointer'}).click(function(){
				if(moving == false){
					//carouselMove('left', 1);
					if(glFading != 0){
		            	carouselFade('left', 1);
		            } else {
		            	carouselMove('left', 1);
		            }
				}
			});
		};

		var carouselArrowRight = function(){
			// action for right arrow
			elem.parent().find('.carousel-arrows .arrow-right').css({'cursor' : 'pointer'}).click(function(){
				if(moving == false){
					//carouselMove('right', 1);
					if(glFading != 0){
		            	carouselFade('right', 1);
		            } else {
		            	carouselMove('right', 1);
		            }
				}
			});
		};

		carouselInit();
	};

	$.fn.carousel = function(options){
		return this.each(function(){
			var element = $(this);
			if (element.data('carousel')) return;

			var carousel = new Carousel(this, options);
			element.data('carousel', carousel);
		});
	};
})(jQuery, jQuery(window));
