Array.from(document.getElementsByClassName("image")).forEach(elt => {
	elt.addEventListener('contextmenu', (e)=> e.preventDefault());
});

// import viewer if necessary
if(document.querySelector('.image.viewable')){
	const css = document.createElement('link');
	css.rel = "stylesheet";
	css.href = "/mainassets/css/viewer.css";

	const script = document.createElement('script');
	script.src = "/mainassets/js/viewer.js";

	document.head.appendChild(css);
	document.head.appendChild(script);
}