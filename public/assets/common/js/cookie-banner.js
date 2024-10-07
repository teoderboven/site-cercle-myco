document.getElementById('accept-cookies').addEventListener('click', ()=>{
	document.cookie = "cookie_accepted=yes; path=/; max-age=" + (60 * 60 * 24 * 365) + "; samesite=lax";
	document.getElementById('cookie-banner').style.display = 'none';
});