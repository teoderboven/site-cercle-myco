/**
 * Initializes and manages the intersection observer for elements to show.
 */
export function initObserver(): void {
    const eltsToShow = document.querySelectorAll('.description, .interesting.flip');

    if(typeof window.IntersectionObserver !== 'undefined'){
        /**
         * Handles intersection observer entries.
         * @param {IntersectionObserverEntry[]} entries the entries observed
         * @param {IntersectionObserver} observer the intersection observer instance
         */
        function handleIntersection(entries: IntersectionObserverEntry[], observer: IntersectionObserver): void {
            entries.forEach(entry => {
                if(entry.isIntersecting){
                    entry.target.classList.add('show');
                    observer.unobserve(entry.target);
                }
            });
        }

        const options: IntersectionObserverInit = {
            rootMargin: '0px',
            threshold: 0.3
        };

        const observer = new IntersectionObserver(handleIntersection, options);

        eltsToShow.forEach(elt => {
            observer.observe(elt);
        });
    } else {
        eltsToShow.forEach(elt => {
            elt.classList.add('show');
        });
    }
}