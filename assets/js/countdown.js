export default class Countdown {
	constructor(el) {
		this.el = el;
		this.countdown_to = this.el.data('countdown-to');
		this.initialized = false;
		this.init();
	}

	init() {
		const countdown = this;
		this.countdown = this.el.countdown(this.countdown_to)
		.on('update.countdown', function(event) {
			var format = '%H:%M:%S';
			if(event.offset.totalDays > 0) {
				format = '%-d day%!d ' + format;
			}
			if(event.offset.weeks > 0) {
				format = '%-w week%!w ' + format;
			}
			var time = event.strftime(format);
			jQuery.each(countdown.translations(), function(index, el) {
				time = time.replace(index, el);
			});
			jQuery(this).html(time);
			
			if (!this.initialized) {
				const initializedEvent = new CustomEvent('countdownInitialized');
				window.dispatchEvent(initializedEvent);
				this.initialized = true;
			}
		})
		.on('finish.countdown', function(event) {
			jQuery(this).parent().parent().slideUp();
		});
	}

	translations() {
		return {
			'day ': flash_countdown_vars.strings.day + ' ',
			'days ': flash_countdown_vars.strings.days + ' ',
			'week ': flash_countdown_vars.strings.week + ' ',
			'weeks ': flash_countdown_vars.strings.weeks + ' ',
		}
	}
}
