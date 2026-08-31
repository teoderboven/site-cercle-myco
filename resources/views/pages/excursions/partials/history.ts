import { ScrollToHash } from '&/common/scrollToHash';

document.querySelectorAll('.toggle').forEach((elt: Element) => {
    elt.addEventListener('click', () => {
        console.log(elt.parentElement?.classList.contains('expanded'));
        if (elt.parentElement?.classList.contains('expanded')) {
            closeExpanded(elt.parentElement);
        } else {
            elt.classList.toggle('active');
        }
    });
});

const forayHeader: HTMLElement | null = document.querySelector('.forays-group h3');
const titleHeight: number = forayHeader ? forayHeader.clientHeight : 0;
ScrollToHash.hashOffset = titleHeight + 17;
ScrollToHash.init();

/**
 * About the expand and open in new tab buttons of forays
 */
const magicHash = "#mycelium";

function openExpanded(element: HTMLElement): void {
    element.classList.add('expanded');
    window.location.hash = magicHash;
}

function closeExpanded(element: HTMLElement): void {
    element.classList.remove('expanded');
    window.history.back();
}

document.querySelectorAll('.foray .expand-btn').forEach((elt: Element) => {
    elt.addEventListener('click', (e: Event) => {
        e.stopPropagation();
        try {
            const foray: HTMLElement | null = elt.parentElement?.parentElement?.parentElement ?? null;
            if (foray) {
                if (foray.classList.contains('expanded')) {
                    closeExpanded(foray);
                } else {
                    openExpanded(foray);
                }
            }
        } catch (err: unknown) {
            console.error(err);
        }
    });
});

document.querySelectorAll('.foray .new-tab-btn').forEach((elt: Element) => {
    elt.addEventListener('click', (e: Event) => {
        e.stopPropagation();
        try {
            const iframe: HTMLIFrameElement | null = elt.parentElement?.parentElement?.parentElement?.querySelector('iframe') ?? null;
            const url: string | undefined = iframe?.src;
            if (url) {
                window.open(url, '_blank');
            }
        } catch (err: unknown) {
            console.error(err);
        }
    });
});

document.querySelectorAll('.foray .open-pdf-btn').forEach((elt: Element) => {
    elt.addEventListener('click', (e: Event) => {
        e.stopPropagation();
    });
});

window.addEventListener('popstate', () => {
    const expanded: HTMLElement | null = document.querySelector('.expanded');
    if (!expanded || window.location.hash === magicHash) {
        return;
    }
    expanded.classList.remove('expanded');
});

document.addEventListener('keydown', (e: KeyboardEvent) => {
    const expanded: HTMLElement | null = document.querySelector('.expanded');
    if (!expanded) {
        return;
    }
    if (e.key === 'Escape') {
        closeExpanded(expanded);
    }
});

const panelLeft: HTMLElement | null = document.getElementById('nav-container');
const revealBtn: HTMLElement | null = document.getElementById("reveal-btn");
const foraysContainer: HTMLElement | null = document.getElementById('forays-container');

revealBtn?.addEventListener('click', () => {
    panelLeft?.classList.toggle('active');
});

foraysContainer?.addEventListener('click', () => {
    if (panelLeft?.classList.contains('active')) {
        panelLeft.classList.remove('active');
    }
});

let isDragging = false;
let startPointX = 0;
let startPointY = 0;
let moveX = 0;

document.addEventListener('touchstart', (e: TouchEvent) => {
    isDragging = true;
    startPointX = e.touches[0].clientX;
    startPointY = e.touches[0].clientY;
});

document.addEventListener('touchmove', (e: TouchEvent) => {
    if (isDragging) {
        const deltaX: number = e.touches[0].clientX - startPointX;
        const deltaY: number = e.touches[0].clientY - startPointY;

        if (Math.abs(deltaY) > Math.abs(deltaX)) {
            return;
        }
        moveX = deltaX;
    }
});

document.addEventListener('touchend', () => {
    if (isDragging) {
        isDragging = false;
        if (moveX > 50) {
            panelLeft?.classList.add('active');
        } else if (moveX < -50) {
            panelLeft?.classList.remove('active');
        }
        moveX = 0;
    }
});
