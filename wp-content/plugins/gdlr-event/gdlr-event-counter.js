(function($){
	$(document).ready(function(){
		$('.gdlr-event-counter').each(function(){
			var day_field = jQuery(this).children('.upcoming-event-day').children('span');
			var day = parseInt(day_field.text());
			
			var hour_field = jQuery(this).children('.upcoming-event-hour').children('span');
			var hour = parseInt(hour_field.text());
			
			var minute_field = jQuery(this).children('.upcoming-event-minute').children('span');
			var minute = parseInt(minute_field.text());
			
			var second_field = jQuery(this).children('.upcoming-event-second').children('span');
			var second = parseInt(second_field.text());

			var i = setInterval(function(){
				if( second > 0 ){
					second--;			
				}else{
					second = 59;
					if( minute > 0 ){
						minute--;
					}else{
						minute = 59;
						if( hour > 0 ){
							hour--;
						}else{
							hour = 24;
							if( day > 0 ){
								day--;
							}else{
								day = 0;
								hour = 0;
								minute = 0;
								second = 0;
								clearInterval(i);
							}
						}
					}
					minute_field.text(minute);
				}
				second_field.text(second);	
			}, 1000);
		});
	});
})(jQuery);