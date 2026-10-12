/**
 * Initializes and manages the home top carousel component.
 */
export function initCarousel(): void {
    const topCarousel = document.getElementById('homeCarousel');
    if(!topCarousel) return;

    const carousel = topCarousel.querySelector('.carousel-track') as HTMLElement;
    const carouselItems = topCarousel.querySelectorAll('.carousel-item');
    const dots = topCarousel.querySelectorAll('.dot');
    let currentIndex = 0;
    let isDragging = false;
    let startPointX = 0;
    let startPointY = 0;
    let moveX = 0;

    /**
     * Shows the specified carousel item in the carousel container.
     * @param {number} index the index of the carousel item to show
     */
    function showCarouselItem(index: number): void {
        if(index < 0 || index > carouselItems.length - 1) return;

        carousel.style.transform = `translateX(-${index * 100}%)`;
        carouselItems.forEach(item => item.classList.remove('active'));
        dots.forEach(dot => dot.classList.remove('active'));
        dots[currentIndex].classList.add('active');
    }

    showCarouselItem(currentIndex);

    let carouselInterval: number | undefined = window.setInterval(() => {
        currentIndex = (currentIndex + 1) % carouselItems.length;
        showCarouselItem(currentIndex);
    }, 5000);

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentIndex = index;
            showCarouselItem(currentIndex);
        });
    });

    topCarousel.addEventListener('click', () => {
        if(carouselInterval){
            clearInterval(carouselInterval);
            carouselInterval = undefined;
        }
    });

    /**
     * Handles the start of dragging the carousel with mouse or touch.
     * @param {MouseEvent | TouchEvent} event The mousedown or touchstart event object
     */
    function handleDragStart(event: MouseEvent | TouchEvent): void {
        isDragging = true;
        const clientEvent = 'touches' in event ? event.touches[0] : event;
        startPointX = clientEvent.clientX;
        startPointY = clientEvent.clientY;
    }

    /**
     * Handles the dragging of the carousel with mouse or touch.
     * @param {MouseEvent | TouchEvent} event The mousemove or touchmove event object
     */
    function handleDragMove(event: MouseEvent | TouchEvent): void {
        if(isDragging){
            const clientEvent = 'touches' in event ? event.touches[0] : event;
            const clientX = clientEvent.clientX;
            const clientY = clientEvent.clientY;
            const deltaX = clientX - startPointX;
            const deltaY = clientY - startPointY;

            if(Math.abs(deltaY) > Math.abs(deltaX)){
                return;
            }
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
     * @param {MouseEvent | TouchEvent} event The mouseup or touchend event object.
     */
    function handleDragEnd(event: MouseEvent | TouchEvent): void {
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

    carousel.addEventListener('mousedown', handleDragStart as EventListener);
    document.addEventListener('mousemove', handleDragMove as EventListener);
    document.addEventListener('mouseup', handleDragEnd as EventListener);
    carousel.addEventListener('touchstart', handleDragStart as EventListener, {passive: true});
    document.addEventListener('touchmove', handleDragMove as EventListener, {passive: true});
    document.addEventListener('touchend', handleDragEnd as EventListener);

    carousel.querySelectorAll('.carousel-item a').forEach(elt => {
        elt.addEventListener('click', (e: Event) => {
            const mouseEvent = e as MouseEvent;
            if(Math.abs(startPointX - mouseEvent.clientX) > 10) e.preventDefault();
        });
    });

    const leftBorder = topCarousel.querySelector('.carousel-border.left');
    if(leftBorder){
        leftBorder.addEventListener('click', () => {
            if(currentIndex - 1 < 0) return;
            showCarouselItem(--currentIndex);
        });
    }

    const rightBorder = topCarousel.querySelector('.carousel-border.right');
    if(rightBorder){
        rightBorder.addEventListener('click', () => {
            if(currentIndex + 1 >= carouselItems.length) return;
            showCarouselItem(++currentIndex);
        });
    }
}