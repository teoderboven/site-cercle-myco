document.getElementById('accept-cookies')?.addEventListener('click', ()=>{
    const oneYear = 60 * 60 * 24 * 365;
    document.cookie = `cookie_accepted=yes; path=/; max-age=${oneYear}; samesite=lax`;
    document.getElementById('cookie-banner')!.style.display = 'none';
});
