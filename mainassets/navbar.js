var header = document.querySelector("header");
var nav = document.querySelector("header nav");
var menuBtn = document.getElementById("menuBtn");

function switchNavBar(){
	if(nav.classList.contains('visible')){
		nav.classList.remove('visible');
	}else{
		nav.classList.add('visible');
	}
}

menuBtn.addEventListener('click', switchNavBar);
document.addEventListener('click', (e)=>{ // close navbar if click anywhere
	if(!header.contains(e.target)){
		nav.classList.remove('visible')
	}
})