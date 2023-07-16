var header = document.querySelector('body > header');
var nav = document.querySelector('body > header nav');
var menuBtn = document.getElementById('menuBtn');

menuBtn.addEventListener('click', ()=>{
	nav.classList.toggle('visible');
});
document.addEventListener('click', (e)=>{ // close navbar if click anywhere
	if(!header.contains(e.target)){
		nav.classList.remove('visible')
	}
});