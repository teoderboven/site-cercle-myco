const dateElt = document.getElementById("date");
if(dateElt){
	const calendar = dateElt.querySelector("span");
	const time = dateElt.querySelector("time");

	var date = new Date(time.dateTime);

	if(isNaN(date)){ // invalid date
		dateElt.style.display = 'none';
	}

	time.textContent = `${date.toLocaleDateString("fr-BE",{
		weekday: 'long',
		year: 'numeric',
		month: 'long',
		day: 'numeric'
	})} à ${date.getHours()}h${date.getMinutes() > 0? new String(date.getMinutes()).padStart(2, '0'):''}`; // display minutes on 2 digits if not zero

	calendar.textContent = date.getDate();
}