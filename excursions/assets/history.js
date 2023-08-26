document.querySelectorAll('.toggle').forEach(elt => {
	elt.addEventListener('click', ()=>{
		elt.classList.toggle('active');
	})
});

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

const titleHeight = document.querySelector('.forays-group .title')?.clientHeight;
const hashOffset = titleHeight + 20;
document.querySelectorAll('#foray-list li ul li a').forEach(elt=>{
	elt.addEventListener('click', (e)=>{
		e.preventDefault();
		window.location.hash = elt.getAttribute('href');
		scrollToHashWithOffset(hashOffset);
	});
});
window.addEventListener('load',(e)=>{
	const hash = window.location.hash;
	if(hash){
		scrollToHashWithOffset(hashOffset);
	}
});


(function(){
	/*
	 * About nav pannel when screen width is less than 1000px
	 */
	const pannelLeft = document.getElementById('nav-container');
	document.getElementById("reveal-btn").addEventListener('click',()=>{
		pannelLeft.classList.toggle('active');
	});
	document.getElementById('forays-container').addEventListener('click', ()=>{
		// close panel when click on foray container

		if(pannelLeft.classList.contains('active')) pannelLeft.classList.remove('active');
	});

	var isDragging = false;
	var startPointX = 0;
	var startPointY = 0;
	var moveX = 0;

	document.addEventListener('touchstart', (e)=>{
		isDragging = true;
		startPointX = e.touches[0].clientX;
		startPointY = e.touches[0].clientY;
	});
	document.addEventListener('touchmove', (e)=>{
		if(isDragging){
			const deltaX = e.touches[0].clientX - startPointX;
			const deltaY = e.touches[0].clientY - startPointY;

			// Check if the swipe is more vertical than horizontal
			if(Math.abs(deltaY) > Math.abs(deltaX)){
				// Allow default scrolling behavior for vertical swipe
				return;
			}
			// Horizontal swipe
			moveX = deltaX;
		}
	});
	document.addEventListener('touchend', ()=>{
		if(isDragging){
			isDragging = false;
			if(moveX > 50){
				pannelLeft.classList.add('active');
			}else if(moveX < -50){
				pannelLeft.classList.remove('active');
			}
			moveX = 0;
		}
	});
})();