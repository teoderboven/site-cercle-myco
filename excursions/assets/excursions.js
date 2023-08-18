document.querySelectorAll('.toggle').forEach(elt => {
	elt.addEventListener('click', ()=>{
		elt.classList.toggle('active');
	})
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