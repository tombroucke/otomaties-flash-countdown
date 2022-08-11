export default class FlashBanner {
	constructor(el){
		this.el = el;
		this.bindEvents();
		this.type = 'static';
		this.maybeConvert();
		this.init();
	}
	
	init() {
		this.el.classList.add('initialized');
	}
	
	bindEvents() {
		window.addEventListener('resize', this.maybeConvert.bind(this));
		window.addEventListener('countdownInitialized', this.maybeConvert.bind(this));
	}
	
	maybeConvert() {
		let newBanner = false;
		const originalBanner = this.el;
		const content = document.querySelector('.flash-message__content');
		const isOverflown = this.isOverflown(content);
		
		if(isOverflown && this.type == 'static') {
			newBanner = this.convertTo('dynamic')
		} else if(!isOverflown && this.type == 'dynamic') {
			newBanner = this.convertTo('static')
		}
		
		if(newBanner) {
			originalBanner.parentNode.insertBefore(newBanner, originalBanner.nextSibling);
			originalBanner.remove();
			this.el = newBanner;
		}
	}
	
	convertTo(type) {
		this.type = type;
		const nodeType = type == 'dynamic' ? 'marquee' : 'div';
		return this.createBanner(nodeType, this.el);
	}
	
	createBanner(nodeType, originalBanner) {
		const classes = originalBanner.getAttribute('class').split(' ');
		let newBanner = document.createElement(nodeType);
		
		for (let index = 0; index < classes.length; index++) {
			const className = classes[index];
			newBanner.classList.add(className);
		}

		newBanner.setAttribute('style', originalBanner.getAttribute('style'));
		newBanner.innerHTML = originalBanner.innerHTML;
		
		return newBanner;
	}
	
	isOverflown(element) {
		return element.scrollHeight > element.clientHeight || element.scrollWidth > element.clientWidth;
	}
}
