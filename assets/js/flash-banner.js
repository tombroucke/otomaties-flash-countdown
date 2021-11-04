export default class FlashBanner {
	constructor(el){
	  this.el = jQuery(el);
	  this.bindEvents();
	  this.type = 'static';
	  this.maybeConvert();
	  this.init();
	}
  
	init() {
	  this.el.addClass('initialized');
	}
  
	bindEvents() {
	  jQuery(window).on('resize', this.maybeConvert.bind(this));
	  window.addEventListener('countdownInitialized', this.maybeConvert.bind(this));
	}
  
	maybeConvert() {
	  const originalBanner = this.el;
	  let newBanner;
	  let change = false;
	  const content = document.querySelector('.flash-message__content');
	  if(this.isOverflown(content) && this.type == 'static') {
		newBanner = jQuery('<marquee class="flash-message--dynamic ' + originalBanner[0].getAttribute('class') + '" style="' + originalBanner[0].getAttribute('style') + '">' + originalBanner[0].innerHTML + '</marquee>');
		this.type = 'dynamic';
		change = true;
	  } else if(!this.isOverflown(content) && this.type == 'dynamic') {
		newBanner = jQuery('<div class="flash-message--static ' + originalBanner[0].getAttribute('class') + '" style="' + originalBanner[0].getAttribute('style') + '">' + originalBanner[0].innerHTML + '</div>');
		this.type = 'static';
		change = true;
	  }
  
	  if(change) {
		originalBanner.after(newBanner)
		originalBanner.remove();
		this.el = newBanner;
	  }
	}

	isOverflown(element) {
		return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
	}
  }
  