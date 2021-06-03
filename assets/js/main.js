jQuery(document).ready(function($){
	const translations = {
		'day ': flash_countdown.strings.day + ' ',
		'days ': flash_countdown.strings.days + ' ',
		'week ': flash_countdown.strings.week + ' ',
		'weeks ': flash_countdown.strings.weeks + ' ',
	}
	const countdown_el = $('.flash-message__countdown');
	const countdown_to = countdown_el.data('countdown-to');
	$(countdown_el).countdown(countdown_to)
	.on('update.countdown', function(event) {
		var format = '%H:%M:%S';
		if(event.offset.totalDays > 0) {
			format = '%-d day%!d ' + format;
		}
		if(event.offset.weeks > 0) {
			format = '%-w week%!w ' + format;
		}
		var time = event.strftime(format);
		$.each(translations, function(index, el) {
			time = time.replace(index, el);
		});
		$(this).html(time);
	})
	.on('finish.countdown', function(event) {
		$(this).parent().parent().slideUp();
	});
});
