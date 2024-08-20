(function(){
	const timelineContainer = document.getElementById("timeline-container");
	const timelinePastTime = timelineContainer.querySelector(".timeline .time.past");

	const nextActivity = document.getElementById("next");
	const nextActivityDateElt = nextActivity && nextActivity.querySelector('.pre-wrapper .date');
	const markerWidth = parseInt(getComputedStyle(timelineContainer).getPropertyValue('--timeline-marker-width'));

	/**
	  * Correctly places the timeline marker
	  */
	function setTimelineMarker(){
		if(!nextActivity){
			const endElt = timelineContainer.querySelector(".activities-container .end-indicator");
			timelinePastTime.style.height = endElt.offsetTop + endElt.offsetHeight/2 + 'px';

			return;
		}

		let supplementHeight, pastTimeHeight = 0;
		
		if(nextActivityDateElt){
			pastTimeHeight = nextActivityDateElt.offsetTop + nextActivityDateElt.offsetHeight/2;
		}else{ // default
			if(!isNaN(markerWidth)){
				supplementHeight = markerWidth/2;
			}
			pastTimeHeight = nextActivity.offsetTop + supplementHeight;
		}

		timelinePastTime.style.height = pastTimeHeight + 'px';
	};
	setTimelineMarker();

	window.addEventListener('resize', setTimelineMarker);

	// reveal button of passed activities

	const hiddenActivities = timelineContainer.querySelectorAll(".activities-container .activity.hidden");

	hiddenActivities.forEach(activity=>{
		// add transition event to modified element when reveal for update timeline
		const mainContent = activity.querySelector(".main-content");	
		let updateInterval;

		mainContent.addEventListener("transitionstart", e=>
			updateInterval = setInterval(setTimelineMarker, 25)
		)
		Array.of("transitionend", "transitioncancel").forEach((transitionType)=>
			mainContent.addEventListener(transitionType, e=>
				clearInterval(updateInterval) // stop updating marker
			)
		);

		// add event to button
		activity.querySelector(".reveal-btn").addEventListener("click", e=>{
			activity.classList.add("revealed");
		});
	});

	// configure scroll to hash
	ScrollToHash.hashOffset = 35;
	
})();
