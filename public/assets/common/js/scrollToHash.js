/**
 * Feature to place an element targeted by an hash at a certain offset of the navbar.
 */
const ScrollToHash = {
	_navbarHeight: document.querySelector('body > header').clientHeight,

	/**
	 * The offset between the targeted element and the navbar. Default is 5.
	 */
	hashOffset: 5,

	/**
	 * Scrolls to the element targeted by the hash in the URL with an optional offset.
	 * @param {number} [offset] The vertical offset in pixels to adjust the scroll position. If not filled in, the hashOffset value will be taken
	 */
	scroll: function (offset = this.hashOffset){
		const hash = window.location.hash;
		if(hash){
			const targetElement = document.querySelector(hash);
			if(targetElement){
				const targetTop = targetElement.getBoundingClientRect().top + window.scrollY - (offset + this._navbarHeight);
				window.scrollTo({
					top: targetTop,
					behavior: 'smooth'
				});
			}
		}
	}
}

// connect events
window.addEventListener('hashchange', e=>{	
	e.preventDefault();
	ScrollToHash.scroll();	
});
window.addEventListener('load', e=>{	
	ScrollToHash.scroll();
});

// connect event to all links with a hash

const pageLinks = document.querySelectorAll('a');

pageLinks.forEach(link=>{
	if(link.host == window.location.host && link.hash){
		link.addEventListener('click', e=>{
			e.preventDefault();
			if (window.location.hash != link.hash) {
				window.location.hash = link.hash;
				// event hashChange fired
			}else{
				ScrollToHash.scroll();
			}
		});
	}
});