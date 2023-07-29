Array.from(document.getElementsByClassName("image")).forEach(elt => {
	elt.addEventListener('contextmenu', (e)=> e.preventDefault());
});