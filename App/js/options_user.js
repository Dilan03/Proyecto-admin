const options_desplegable = document.getElementById('options_desplegable');
const options_btn = document.getElementById('options_btn');
const options_desplegable_llave = document.getElementById('options_desplegable_llave');
const options_desplegable_llave_btn = document.getElementById('options_desplegable_llave_btn');

const borrar_comentario_btn = document.querySelectorAll('.borrar_comentario_btn');

if (borrar_comentario_btn) {
   for (let i = 0; i < borrar_comentario_btn.length; i++) {
      borrar_comentario_btn[i].addEventListener('click', () => {
         toggleModal(borrar_comentario_form)
      })
   }
}

window.addEventListener('click', (e) => {
   if (options_btn) {
      if (e.target.parentElement.id != 'options_desplegable' && options_btn.classList.contains('active') && e.target.parentElement.id != 'options_btn') {
         options_desplegable.classList.toggle('hideElement');
         options_btn.classList.remove('active');
      }
   }

   if (options_desplegable_llave_btn) {
      if (e.target.parentElement.id != 'options_desplegable-llave' && options_desplegable_llave_btn.classList.contains('active') && e.target.parentElement.id != 'options_desplegable_llave_btn') {
         options_desplegable_llave.classList.toggle('hideElement');
         options_desplegable_llave_btn.classList.remove('active');
      }
   }
});

const toogleOption = (btn, desplegable) => {
   if (btn) {
      btn.addEventListener('click', () => {
         if (btn.classList.contains('active')) {
            desplegable.classList.toggle('hideElement');
            btn.classList.remove('active');
         } else {
            desplegable.classList.toggle('hideElement');
            btn.classList.add('active');
         }
      })
   }
}

toogleOption(options_btn, options_desplegable);
toogleOption(options_desplegable_llave_btn, options_desplegable_llave);