import '../scss/main.scss';

import FlashBanner from './flash-banner';
import Countdown from './countdown';

document.addEventListener('DOMContentLoaded', () => {
	const flashMessageEl = document.querySelector('.flash-message');
	if(flashMessageEl) {
		new FlashBanner(flashMessageEl);
	}

	const countdownEl = document.querySelector('.flash-message__countdown');
	if(countdownEl && flashMessageEl) {
		new Countdown(countdownEl, flashMessageEl);
	}
});
