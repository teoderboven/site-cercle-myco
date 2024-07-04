/**
 * main code of this file
 */
(function(){
	const dateElt = document.getElementById("date");
	const meteoElt = document.getElementById("meteo");

	// date
	if(dateElt){
		const calendar = dateElt.querySelector("span");
		const time = dateElt.querySelector("time");

		const eventDate = new moment(time.dateTime);

		if(!eventDate.isValid()){ // invalid date
			dateElt.style.display = 'none';
			return;
		}

		time.title = eventDate.format('D/MM/Y H[h]mm');

		if(eventDate.isBefore(moment())){ // past event
			time.textContent = "Cet événement est passé";
			time.classList.add('past');
			calendar.style.display = 'none';
			dateElt.querySelector('#calendarContainer').style.display = 'none';

			return;
		}

		time.innerHTML = `${
			isToday(eventDate)?
			"Aujourd'hui" // event is today
			: isTomorrow(eventDate)?
			"Demain": // event is tomorrow
			eventDate.format(`dddd D MMMM ${eventDate.isSame(moment(), 'year')? '':'Y'}`) // event is in >= 2 days
			} à ${
				eventDate.format(`H[h]mm`)
			}${
				time.dataset.duration? ` (dure &#8776; ${time.dataset.duration})`:'' // display event duration
			}`

		calendar.textContent = eventDate.date();
		
		// meteo  -- linked with date
		if(meteoElt){
			if(!meteoElt.dataset.cityurl){
				meteoElt.style.display = 'none';

				return;
			}
			
			let daysRemaining = eventDate.diff(moment(), 'days');
			console.log('\x1B[1m\x1B[32mCalculated days remaining :', daysRemaining);
			
			if(daysRemaining <= 4){
				const meteoReq = new XMLHttpRequest();
				meteoReq.onreadystatechange = ()=>{
					if(meteoReq.readyState === XMLHttpRequest.DONE && meteoReq.status === 200){
						const res = JSON.parse(meteoReq.responseText);

						if(res.errors){
							meteoElt.style.display = 'none';
							return;
						}

						let fcst_day = res[`fcst_day_${daysRemaining}`];

						/*
							sometimes the api may not be up to date (1 day delay)
							Check that the day returned by the api is the same as the Date object
						*/
						while(parseInt(fcst_day.date.split(".")[0]) != eventDate.date()){
							fcst_day = res[`fcst_day_${++daysRemaining}`];
							console.warn('\x1B[36mWeather api is not up to date')
							console.log('\x1B[31mRECALCULATING DAYS REMAINING :', daysRemaining);
							if(daysRemaining > 4) return;
						}
						
						const fcst = fcst_day.hourly_data[`${eventDate.hour()}H00`];
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
				meteoReq.open('GET', `https://prevision-meteo.ch/services/json/${meteoElt.dataset.cityurl}`);
				meteoReq.send();
			}
		}
	}
})()