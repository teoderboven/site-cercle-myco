(function(){
	const goToNextBtn = document.getElementById('goToNext');

	function hideGoToNext(){
		goToNextBtn.style.display = "none";
	}

	const timelineContainer = document.getElementById("timeline-container");
	const timelinePastTime = timelineContainer.querySelector(".timeline .time.past");
	const activities = timelineContainer.querySelectorAll(".list .activity");
	const season = timelineContainer.dataset.seasonYear;
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
		if(activity.dataset.duration){
			let duration = parseInt(activity.dataset.duration)
			if(!isNaN(duration)){
				eventDate.add(duration, 'h'); // set the time until the end of the event
			}
		}

		if(eventDate.isBefore(today)){
			activity.classList.add('passed');
		}else{
			activity.id = 'next';
			nextActivity = activity;
			if(isTomorrow(eventDate)){
				activity.classList.add('tomorrow');
			}else if(isToday(eventDate)){
				activity.classList.add('today');
			}

			if(i==0) hideGoToNext(); // no button if next is first activity
		}
	}

	if(!nextActivity){
		const activitiesList = timelineContainer.querySelector(".list");
		const noActivity = activities.length == 0;

		// add message at the top of the list
		const seasonEndMsg = document.createElement('section');
		seasonEndMsg.classList.add('season-end');
		seasonEndMsg.innerHTML = `
			<h4>${
				noActivity? "Aucune activité n'est prévue pour le moment" : 
							`La saison ${season} est à présent terminée.`}
			</h4>
			${noActivity? `
			<p>
				De nouvelles aventures mycologiques arrivent bientôt.
				Merci de votre patience, et à très vite pour explorer ensemble le monde fascinant des champignons&nbsp;!
			</p>
			`: `
			<p>
				Merci de nous avoir accompagnés tout au long de ces aventures mycologiques.
				Nous prenons une petite pause, mais ne partez pas trop loin&nbsp;!
			</p>
			<p>
				Soyez prêts pour de nouvelles découvertes l'année prochaine&nbsp;! Nous avons déjà hâte de les partager avec vous&nbsp;!
			</p>
			`}
			<a href="/excursions/" class="history-btn">(Re)découvrir les excursions de ${noActivity? "la saison précédente" : "l'année"} &#9658;</a>`;

		activitiesList.insertBefore(seasonEndMsg, activitiesList.children[0]);

		// add indication at the bottom od the list
		const endElt = document.createElement('section');
		endElt.classList.add('end');
		endElt.innerHTML = noActivity? "<p>Aucune activité prévue pour le moment</p>"
		:`<h3>Fin de la saison : Rendez vous en ${parseInt(season) + 1}!</h3>`;

		activitiesList.appendChild(endElt);

		hideGoToNext();
	}
	
	// const nextActivity = document.getElementById("next");
	const nextActivityDateElt = nextActivity && nextActivity.querySelector('.pre-wrapper .date');
	const markerWidth = parseInt(getComputedStyle(nextActivity).getPropertyValue('--timeline-marker-width'));

	/**
	  * Correctly places the timeline marker
	  */
	function setTimelineMarker(){
		if(!nextActivity){
			const endElt = timelineContainer.querySelector(".list .end");
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

	const passedActivities = document.querySelectorAll("#timeline-container .list .activity.passed.hidden");

	passedActivities.forEach(activity=>{
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
			activity.classList.remove("hidden");
		});
	});


	// scroll to hash #next

	const navbarHeight = document.querySelector('body > header').clientHeight;
	const hashOffset = navbarHeight + 35;
	goToNextBtn.addEventListener('click', (e)=>{
		e.preventDefault();
		window.location.hash = e.target.getAttribute('href');
		scrollToHashWithOffset(hashOffset);
	});
	window.addEventListener('load',()=>{
		const hash = window.location.hash;
		if(hash){
			scrollToHashWithOffset(hashOffset);
		}
	});
})();
