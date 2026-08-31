// @ts-ignore
import { ScrollToHash } from '@/js/common/scrollToHash';

const timelineContainer: HTMLElement | null = document.getElementById("timeline-container");
const timelinePastTime: HTMLElement | null = timelineContainer?.querySelector(".timeline .time.past") ?? null;

const nextActivity: HTMLElement | null = document.getElementById("next");
const nextActivityDateElt: HTMLElement | null = nextActivity ? nextActivity.querySelector('.pre-wrapper .date') : null;
const markerWidth: number = timelineContainer ? parseInt(getComputedStyle(timelineContainer).getPropertyValue('--timeline-marker-width')) : NaN;

/**
 * Correctly places the timeline marker
 */
function setTimelineMarker(): void {
    if (!timelineContainer || !timelinePastTime) {
        return;
    }

    if (!nextActivity) {
        const endElt: HTMLElement | null = timelineContainer.querySelector(".activities-container .end-indicator");
        if (endElt) {
            timelinePastTime.style.height = `${endElt.offsetTop + endElt.offsetHeight / 2}px`;
        }
        return;
    }

    let supplementHeight = 0;
    let pastTimeHeight = 0;

    if (nextActivityDateElt) {
        pastTimeHeight = nextActivityDateElt.offsetTop + nextActivityDateElt.offsetHeight / 2;
    } else {
        if (!isNaN(markerWidth)) {
            supplementHeight = markerWidth / 2;
        }
        pastTimeHeight = nextActivity.offsetTop + supplementHeight;
    }

    timelinePastTime.style.height = `${pastTimeHeight}px`;
}

setTimelineMarker();

window.addEventListener('resize', setTimelineMarker);

if (timelineContainer) {
    const hiddenActivities: NodeListOf<HTMLElement> = timelineContainer.querySelectorAll(".activities-container .activity.hidden");

    hiddenActivities.forEach((activity: HTMLElement) => {
        const mainContent: HTMLElement | null = activity.querySelector(".main-content");
        let updateInterval: number | undefined;

        if (mainContent) {
            mainContent.addEventListener("transitionstart", () => {
                updateInterval = window.setInterval(setTimelineMarker, 25);
            });

            ["transitionend", "transitioncancel"].forEach((transitionType: string) => {
                mainContent.addEventListener(transitionType, () => {
                    clearInterval(updateInterval);
                });
            });
        }

        const revealBtn: HTMLElement | null = activity.querySelector(".reveal-btn");
        revealBtn?.addEventListener("click", () => {
            activity.classList.add("revealed");
        });
    });
}

ScrollToHash.hashOffset = 35;
ScrollToHash.init();
