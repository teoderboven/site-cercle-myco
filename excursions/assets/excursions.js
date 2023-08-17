document.querySelectorAll('.toggle').forEach(elt => {
	elt.addEventListener('click', ()=>{
		elt.classList.toggle('active');
	})
});