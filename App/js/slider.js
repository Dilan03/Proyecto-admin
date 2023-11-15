const slider = document.querySelectorAll('.sliderContainer');
const flecha_left = document.querySelectorAll('.fleft');
const flecha_right = document.querySelectorAll('.fright');


if (flecha_left && slider) {

   for (let i = 0; i < flecha_left.length; i++) {
      flecha_left[i].addEventListener('click', (e) => {
         const sliderTarjeta = e.target.parentElement.parentElement.nextSibling.nextSibling
         sliderTarjeta.style.marginLeft = `${0}px`;
      })
   }
}

if (flecha_right && slider) {
   for (let i = 0; i < flecha_right.length; i++) {
      flecha_right[i].addEventListener('click', (e) => {
         const sliderTarjeta = e.target.parentElement.parentElement.nextSibling.nextSibling
         sliderTarjeta.style.marginLeft = `${-450}px`;
      })
   }
}
