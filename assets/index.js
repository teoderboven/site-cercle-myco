// top carousel
(function(){
	const topCarousel = document.getElementById('topCarousel');
	const carousel = topCarousel.querySelector('.carousel');
	const carouselItems = topCarousel.querySelectorAll('.item');
	const dots = topCarousel.querySelectorAll('.dot');
	let currentIndex = 0;
	let isDragging = false;
	let startPointX = 0;
	let startPointY = 0
	let moveX = 0;

	/**
	 * Shows the specified carousel item in the carousel container
	 * @param {number} index the index of the carousel item to show
	 */
	function showCarouselItem(index){
		if(index < 0 || index > carouselItems.length-1) return;

		carousel.style.transform = `translateX(-${index * 100}%)`;
		carouselItems.forEach(item => item.classList.remove('active'));
		dots.forEach(dot => dot.classList.remove('active'));
		dots[currentIndex].classList.add('active');
	}

	showCarouselItem(currentIndex);

	let carouselInterval = setInterval(() => {
		currentIndex = (currentIndex + 1) % carouselItems.length;
		showCarouselItem(currentIndex);
	}, 5000);

	dots.forEach((dot, index)=>{
		dot.addEventListener('click', ()=>{
			currentIndex = index;
			showCarouselItem(currentIndex);
		});
	});

	topCarousel.addEventListener('click', ()=>{ // stop auto scrolling at any click on the carousel
		if(carouselInterval){
			clearInterval(carouselInterval);
			carouselInterval = undefined;
		}
	});

	// dragging items

	/**
	 * Handles the start of dragging the carousel with mouse or touch
	 * @param {Event} event The mousedown or touchstart event object
	 */
	function handleDragStart(event){
		isDragging = true;
		startPointX = event.clientX || event.touches[0].clientX;
		startPointY = event.clientY || event.touches[0].clientY;
	}
	/**
	 * Handles the dragging of the carousel with mouse or touch
	 * @param {Event} event The mousemove or touchmove event object
	 */
	function handleDragMove(event){
		if(isDragging){
			const clientX = event.clientX || event.touches[0].clientX;
			const clientY = event.clientY || event.touches[0].clientY;
			const deltaX = clientX - startPointX;
			const deltaY = clientY - startPointY;

			// Check if the swipe is more vertical than horizontal
			if(Math.abs(deltaY) > Math.abs(deltaX)){
				// Allow default scrolling behavior for vertical swipe
				return;
			}
			// Horizontal swipe
			moveX = deltaX;
			carousel.style.transition = 'none';
			carousel.style.transform = `translateX(calc(-${currentIndex * 100}% + ${moveX}px))`;

			if(carouselInterval){
				clearInterval(carouselInterval);
				carouselInterval = undefined;
			}
		}
	}
	/**
	 * Handles the end of dragging the carousel with mouse or touch.
	 * @param {Event} event The mouseup or touchend event object.
	 */
	function handleDragEnd(event){
		if(isDragging){
			isDragging = false;
			carousel.style.transition = '';
			if(Math.abs(moveX) > 50){
				currentIndex += moveX > 0 ? -1 : 1;
				currentIndex = Math.min(Math.max(currentIndex, 0), carouselItems.length - 1);
			}
			moveX = 0;
			showCarouselItem(currentIndex);
		}
	}
	carousel.addEventListener('mousedown', handleDragStart);
	document.addEventListener('mousemove', handleDragMove);
	document.addEventListener('mouseup', handleDragEnd);
	carousel.addEventListener('touchstart', handleDragStart);
	document.addEventListener('touchmove', handleDragMove);
	document.addEventListener('touchend', handleDragEnd);

	// when use anchor as item
	carousel.querySelectorAll('a.item').forEach(elt=>{
		elt.setAttribute('draggable','false');
		elt.setAttribute('tabindex','-1');

		elt.addEventListener('click', (e)=>{
			if(Math.abs(startPointX - e.clientX) > 10) e.preventDefault(); // don't redirect if navigate
		});
	});

	// navigate with border
	topCarousel.querySelector('.carousel-border.left').addEventListener('click', ()=>{
		if(currentIndex - 1 < 0) return;
		showCarouselItem(--currentIndex);
	});
	topCarousel.querySelector('.carousel-border.right').addEventListener('click', ()=>{
		if(currentIndex + 1 >= carouselItems.length) return;
		showCarouselItem(++currentIndex);
	});
})();
{
	// description observer

	const eltsToShow = document.querySelectorAll('.description, .interesting.flip');
console.log(eltsToShow);
	if(IntersectionObserver){
		function handleIntersection(entries, observer){
			entries.forEach(entry => {
				if(entry.isIntersecting){
					entry.target.classList.add('show');
					observer.unobserve(entry.target);
				}
			});
		}
		const options = {
			rootMargin: '0px',
			threshold: 0.3
		};

		const observer = new IntersectionObserver(handleIntersection, options);

		eltsToShow.forEach(elt=>{
			observer.observe(elt);
		});
	}else{ // if browser does not have Observer
		eltsToShow.forEach(elt=>{
			elt.classList.add('show');
		});
	}
}