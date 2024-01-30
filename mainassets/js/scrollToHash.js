/**
 * Scrolls to the element targeted by the hash in the URL with an optional offset.
 * @param {number} [offset] The vertical offset in pixels to adjust the scroll position. Default is 5.
 */
function scrollToHashWithOffset(offset = 5){
	const hash = window.location.hash;
	if(hash){
		const targetElement = document.querySelector(hash);
		if(targetElement){
			const targetTop = targetElement.getBoundingClientRect().top + window.scrollY - offset;
			window.scrollTo({
				top: targetTop,
				behavior: 'smooth'
			});
		}
	}
}