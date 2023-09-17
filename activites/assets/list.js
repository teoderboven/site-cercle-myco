(function(){
	const timelineContainer = document.getElementById("timeline-container");
	const timelinePastTime = timelineContainer.querySelector(".timeline .time.past");
	const activities = timelineContainer.querySelectorAll(".list .activity");
	const today = new moment();

	var nextActivity;
	
	for(let i = 0; i < activities.length && !nextActivity; i++){
		var activity = activities[i];

		var time = activity.querySelector('time');
		if(!time){
			console.warn(`activity ${i} has no time element`);
			continue;
		}

		const eventDate = new moment(time.dateTime);

		if(!eventDate.isValid()){
			console.warn(`activity ${i} has invalid time`);
			continue;
		}
		// event has no time set (actually starts at 0h00)
		if(!eventDate.hour() && !time.dateTime.toLowerCase().includes('t')){
			eventDate.hour(12);
			console.warn(`activity ${i} has no scheduled time. Time sets at 12`);
		}
		if(time.dataset.duration){
			let duration = parseInt(time.dataset.duration)
			if(!isNaN(duration)){
				eventDate.add(duration, 'h'); // set the time until the end of the event
			}
		}
		
		if(eventDate.isBefore(today)){
			activity.classList.add('passed');
		}else{
			activity.classList.add('next');
			nextActivity = activity;
			if(isTomorrow(eventDate)){
				activity.classList.add('tomorrow');
			}else if(isToday(eventDate)){
				activity.classList.add('today');
			}
		}
	}

	/**
	  * Correctly places the timeline marker
	  */
	function setTimelineMarker(){
		if(!nextActivity){
			if(activities.length){
				timelinePastTime.style.height = activities[activities.length -1].offsetTop + activities[activities.length -1].offsetHeight + 15 + 'px';
			}
			return;
		}

		let actDateElt = nextActivity.querySelector('.pre-wrapper .date');
		let supplementHeight, pastTimeHeight = 0;
		
		if(actDateElt){
			pastTimeHeight = actDateElt.offsetTop + actDateElt.offsetHeight/2;
		}else{ // default
			let markerWidth = parseInt(getComputedStyle(nextActivity).getPropertyValue('--timeline-marker-width'));
			if(!isNaN(markerWidth)){
				supplementHeight = markerWidth/2;
			}
			pastTimeHeight = nextActivity.offsetTop + supplementHeight;
		}

		timelinePastTime.style.height = pastTimeHeight + 'px';
	};
	setTimelineMarker();

	window.addEventListener('resize', setTimelineMarker);
})();