const header = document.querySelector('body > header');
const nav = document.querySelector('body > header nav');
const menuBtn = document.getElementById('menuBtn');

menuBtn.addEventListener('click', ()=>{
	nav.classList.toggle('visible');
});
document.addEventListener('click', (e)=>{ // close navbar if click anywhere
	if(!header.contains(e.target)){
		nav.classList.remove('visible')
	}
});