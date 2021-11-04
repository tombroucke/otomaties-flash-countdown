import '../scss/main.scss';

import Countdown from './countdown';
import FlashBanner from './flash-banner';

jQuery(document).ready(function($){ 
	const countdownEl = $('.flash-message__countdown');
	if(countdownEl.length) {
		new Countdown(countdownEl);
	}

	const flashMessageEl = $('.flash-message');
	if(flashMessageEl.length) {
		new FlashBanner(flashMessageEl);
	}
});
