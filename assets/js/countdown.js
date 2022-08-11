export default class Countdown {
	constructor(el, banner) {
		this.el = el;
		this.banner = banner;
		this.initialized = false;
		this.timer = false;

        this._second = 1000;
        this._minute = this._second * 60;
        this._hour = this._minute * 60;
        this.countDownTo = new Date(this.el.getAttribute('data-countdown-to'));
        this._day = this._hour * 24;
		this.initCountdown();
	}

	initCountdown() {
        this.timer = setInterval(this.showRemaining.bind(this), 1000);
	}

	showRemaining() {
		var now = new Date();
		var timeRemaining = this.countDownTo - now;
		if (timeRemaining <= 0) {

			clearInterval(this.timer);
			this.banner.remove();

			return;
		}
		var days = Math.floor(timeRemaining / this._day);
		var hours = Math.floor((timeRemaining % this._day) / this._hour);
		var minutes = Math.floor((timeRemaining % this._hour) / this._minute);
		var seconds = Math.floor((timeRemaining % this._minute) / this._second);

		this.el.innerHTML = '';
		if (days > 0) {
			this.el.innerHTML += days + ' ' + this.pluralize(flash_countdown_vars.strings.day, flash_countdown_vars.strings.days, days) + ' ';
		}
		this.el.innerHTML += hours + ':' + this.pad(minutes, 2) + ':' + this.pad(seconds, 2);
	}

	pad(num, size) {
		num = num.toString();
		while (num.length < size) num = "0" + num;
		return num;
	}

	pluralize(singular, plural, amount) {
		return amount == 1 ? singular : plural;
	}
}
