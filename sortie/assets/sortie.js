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
/**
 * Calculates the number of days between 2 dates (excluding hours)
 * @param {Date} startDate the start date
 * @param {Date} endDate the end date
 * @returns {number} the number of days between the 2 dates or null if a parameter is not a date
 */
function getDaysDifference(startDate, endDate){
	if(!(startDate instanceof Date) || !(endDate instanceof Date)) return null;
	
	var start = new Date(startDate.getFullYear(), startDate.getMonth(), startDate.getDate());
	var end = new Date(endDate.getFullYear(), endDate.getMonth(), endDate.getDate());
	
	return Math.ceil((end - start) / (1000 * 3600 * 24));
}
/**
 * main function of this file
 */
function _sortie(){
	const dateElt = document.getElementById("date");
	const meteoElt = document.getElementById("meteo");

	// date
	if(dateElt){
		const calendar = dateElt.querySelector("span");
		const time = dateElt.querySelector("time");

		const eventDate = new Date(time.dateTime);

		if(isNaN(eventDate)){ // invalid date
			dateElt.style.display = 'none';
		}

		if(eventDate.getTime() < Date.now()){ // past event
			time.textContent = "Cet événement est passé";
			time.classList.add('past');
			calendar.style.display = 'none';
			dateElt.querySelector('#calendarContainer').style.display = 'none';

			return;
		}

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
		
		// meteo  -- linked with date
		if(meteoElt){
			if(!meteoElt.dataset.cityurl){
				meteoElt.style.display = 'none';

				return;
			}

			const meteoReq = new XMLHttpRequest();
			meteoReq.onreadystatechange = ()=>{
				if(meteoReq.readyState === XMLHttpRequest.DONE && meteoReq.status === 200){
					const res = JSON.parse(meteoReq.responseText);

					if(res.errors){
						meteoElt.style.display = 'none';
						return;
					}

					let daysRemaining = getDaysDifference(new Date(), eventDate);
					console.log('\x1B[1m\x1B[32mCalculated days remaining :', daysRemaining);
					
					if(daysRemaining <= 4){
						let fcst_day = res[`fcst_day_${daysRemaining}`];

						/*
							sometimes the api may not be up to date (1 day delay)
							Check that the day returned by the api is the same as the Date object
						*/
						while(parseInt(fcst_day.date.split(".")[0]) != eventDate.getDate()){
							fcst_day = res[`fcst_day_${++daysRemaining}`];
							console.warn('\x1B[36mWeather api is not up to date')
							console.log('\x1B[31mRECALCULATING DAYS REMAINING :', daysRemaining);
							if(daysRemaining > 4) return;
						}
						
						const fcst = fcst_day.hourly_data[`${eventDate.getHours()}H00`];
						console.log(`\x1B[1m\x1B[32mfcst_day_${daysRemaining} :`, fcst_day.date);
						console.table(fcst);

						const img = document.createElement('img');
						let icon = fcst.ICON;
						icon = icon.slice(0, icon.indexOf('.png')) + '-big.png'; // transform icon into big icon (other url)
						img.src = icon;

						const tmp = document.createElement('span');
						tmp.classList.add('tmp');
						tmp.innerHTML = `${Math.round(fcst.TMP2m)}&deg;C`;

						const cond = document.createElement('span');
						cond.classList.add('cond');
						cond.textContent = fcst.CONDITION;

						const credit = document.createElement('div');
						credit.classList.add('credit');
						credit.textContent = "Météo par ";

						const creditAnchor = document.createElement('a');
						creditAnchor.href = 'https://prevision-meteo.ch/';
						creditAnchor.textContent = 'prevision-meteo.ch';
						creditAnchor.target = "_blank";

						credit.appendChild(creditAnchor);

						meteoElt.appendChild(img);
						meteoElt.appendChild(tmp);
						meteoElt.appendChild(cond);
						meteoElt.appendChild(credit);
						meteoElt.classList.add('ready');
					}
				}
			}
			meteoReq.open('GET', `https://prevision-meteo.ch/services/json/${meteoElt.dataset.cityurl}`);
			meteoReq.send();
		}
	}
}
_sortie();
