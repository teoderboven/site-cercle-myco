const dateElt = document.getElementById("date");
if(dateElt){
	const calendar = dateElt.querySelector("span");
	const time = dateElt.querySelector("time");

	var eventDate = new Date(time.dateTime);

	/**
	 * Checks if a date is today
	 * @param {Date} date the date to check
	 * @return {boolean} true if the date is today, false else 
	 */
	function isToday(date){
		if(!(date instanceof Date)) return false;

		const today = new Date();

		return date.getDate() === today.getDate() &&
		date.getMonth() === today.getMonth() &&
		date.getFullYear() === today.getFullYear();
	}

	if(isNaN(eventDate)){ // invalid date
		dateElt.style.display = 'none';
	}

	if(eventDate.getTime() < Date.now()){ // past event
		time.textContent = "Cet événement est passé";
		time.classList.add('past');
		calendar.style.display = 'none';
		dateElt.querySelector('#calendarContainer').style.display = 'none';
	}else{
		time.innerHTML = `${
			isToday(eventDate)?
			"Aujourd'hui" // event is today
			: eventDate.toLocaleDateString("fr-BE",{ // event is not today
			weekday: 'long',
			year: 'numeric',
			month: 'long',
			day: 'numeric'
		})} à ${
			eventDate.getHours()
		}h${
			eventDate.getMinutes() > 0? new String(eventDate.getMinutes()).padStart(2, '0'):'' // display minutes on 2 digits if not zero
		}${
			time.dataset.duration? ` (dure &#8776; ${time.dataset.duration})`:'' // display event duration
		}`; 

		calendar.textContent = eventDate.getDate();

		
	}
	
}