document.querySelectorAll('.toggle').forEach(elt => {
	elt.addEventListener('click', ()=>{
		if(elt.parentElement && elt.parentElement.classList.contains('expanded')){ // click when foray is expanded
			closeExpanded(elt.parentElement);
		}else{
			elt.classList.toggle('active');
		}
	})
});

// configure scroll to hash
const titleHeight = document.querySelector('.forays-group h3').clientHeight;
ScrollToHash.hashOffset = titleHeight + 17;

/*
 * About the expand and open in new tab buttons of forays
 */
const magicHash = "#mycelium";
/*
 * if you are wondering what is the utility of magicHash, well it is simply to change url when a foray is expanded,
 * like that when on an android smartphone you press the back key, I can detect it.
 * And finally it makes a good easter egg.
 * So if you find it, well done!
 */
function openExpanded(element){
	element.classList.add('expanded');
	window.location.hash = magicHash;
}
function closeExpanded(element){
	element.classList.remove('expanded');
	window.history.back();
}
document.querySelectorAll('.foray .expand-btn').forEach(elt=>{
	elt.addEventListener('click', (e)=>{
		e.stopPropagation();
		try{
			const foray = elt.parentElement.parentElement.parentElement;
			if(foray){
				if(foray.classList.contains('expanded')) closeExpanded(foray);
				else openExpanded(foray);
			}
		}catch(e){
			console.error(e);
		}
	});
});
document.querySelectorAll('.foray .new-tab-btn').forEach(elt=>{
	elt.addEventListener('click', (e)=>{
		e.stopPropagation();
		try{
			const url = elt.parentElement.parentElement.parentElement.querySelector('iframe').src;
			if(url) window.open(url, '_blank');
		}catch(e){
			console.error(e);
		}
	});
});
document.querySelectorAll('.foray .open-pdf-btn').forEach(elt=>{
	elt.addEventListener('click', (e)=>{
		e.stopPropagation();
	});
});
window.addEventListener('popstate', ()=>{
	const expanded = document.querySelector('.expanded');
	if(!expanded || window.location.hash == magicHash) return;
	expanded.classList.remove('expanded');
	/*
	 * I do not use the closeExpanded function because otherwise it would break all while making a back in the history.
	 */
});
document.addEventListener('keydown', (e)=>{
	const expanded = document.querySelector('.expanded');
	if(!expanded) return;
	if(e.key == 'Escape'){
		closeExpanded(expanded);
	}
});


(function(){
	/*
	 * About nav pannel when screen width is less than 1000px
	 */
	const pannelLeft = document.getElementById('nav-container');
	document.getElementById("reveal-btn").addEventListener('click',()=>{
		pannelLeft.classList.toggle('active');
	});
	document.getElementById('forays-container').addEventListener('click', ()=>{
		// close panel when click on foray container

		if(pannelLeft.classList.contains('active')) pannelLeft.classList.remove('active');
	});

	var isDragging = false;
	var startPointX = 0;
	var startPointY = 0;
	var moveX = 0;

	document.addEventListener('touchstart', (e)=>{
		isDragging = true;
		startPointX = e.touches[0].clientX;
		startPointY = e.touches[0].clientY;
	});
	document.addEventListener('touchmove', (e)=>{
		if(isDragging){
			const deltaX = e.touches[0].clientX - startPointX;
			const deltaY = e.touches[0].clientY - startPointY;

			// Check if the swipe is more vertical than horizontal
			if(Math.abs(deltaY) > Math.abs(deltaX)){
				// Allow default scrolling behavior for vertical swipe
				return;
			}
			// Horizontal swipe
			moveX = deltaX;
		}
	});
	document.addEventListener('touchend', ()=>{
		if(isDragging){
			isDragging = false;
			if(moveX > 50){
				pannelLeft.classList.add('active');
			}else if(moveX < -50){
				pannelLeft.classList.remove('active');
			}
			moveX = 0;
		}
	});
})();