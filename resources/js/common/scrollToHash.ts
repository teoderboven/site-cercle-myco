/**
 * Feature to place an element targeted by an hash at a certain offset of the navbar.
 */
export class ScrollToHash {
    private static _navbarHeight: number = document.querySelector('body > header')?.clientHeight ?? 0;

    /**
     * The offset between the targeted element and the navbar. Default is 5.
     */
    public static hashOffset: number = 5;

    /**
     * Scrolls to the element targeted by the hash in the URL with an optional offset.
     * @param offset The vertical offset in pixels to adjust the scroll position. If not filled in, the hashOffset value will be taken
     */
    public static scroll(offset: number = this.hashOffset): void {
        const hash: string = window.location.hash;
        if (hash) {
            const targetElement: HTMLElement | null = document.querySelector(hash);
            if (targetElement) {
                const targetTop: number = targetElement.getBoundingClientRect().top + window.scrollY - (offset + this._navbarHeight);
                window.scrollTo({
                    top: targetTop,
                    behavior: 'smooth'
                });
            }
        }
    }

    /**
     * Binds window and link click events for hash navigation.
     */
    public static init(): void {
        window.addEventListener('hashchange', (e: Event) => {
            e.preventDefault();
            this.scroll();
        });

        window.addEventListener('load', () => {
            this.scroll();
        });

        const pageLinks: NodeListOf<HTMLAnchorElement> = document.querySelectorAll('a');

        pageLinks.forEach((link: HTMLAnchorElement) => {
            if (link.host === window.location.host && link.hash) {
                link.addEventListener('click', (e: MouseEvent) => {
                    e.preventDefault();
                    if (window.location.hash !== link.hash) {
                        window.location.hash = link.hash;
                    } else {
                        this.scroll();
                    }
                });
            }
        });
    }
}
