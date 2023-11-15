const indexnav = document.getElementById('indexnav');
const lostobjectsnav = document.getElementById('lostobjectsnav');
const foundobjectsnav = document.getElementById('foundobjectsnav');

(window.location.href.indexOf("index") != -1) ?
   indexnav.classList.add('icon__home-active') : indexnav.classList.remove('icon__home-active');

(window.location.href.indexOf("lostobjects") != -1) ?
   lostobjectsnav.classList.add('icon__lost-active') : lostobjectsnav.classList.remove('icon__lost-active');

(window.location.href.indexOf("foundobjects") != -1) ?
   foundobjectsnav.classList.add('icon__found-active') : foundobjectsnav.classList.remove('icon__found-active');