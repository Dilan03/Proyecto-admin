const filtro_btn = document.getElementById('filtro_btn');
const filtro_cuerpo = document.getElementById('filtro_cuerpo');

if (filtro_btn) {
   filtro_btn.addEventListener('click', () => {
      filtro_cuerpo.classList.toggle('hideElement');
   })
}