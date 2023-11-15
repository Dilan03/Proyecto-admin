const crear_post_btn = document.getElementById('crear_post_btn');
const crear_post_form = document.getElementById('crear_post_form');
const cerrar_modal = document.getElementById('cerrar_modal');
const login_btn = document.getElementById('login_btn');
const login_btn2 = document.getElementById('login_btn2');
const login_form = document.getElementById('login_form');
const registro_btn = document.getElementById('registro_btn');
const registro_form = document.getElementById('registro_form');
const editar_registro_btn = document.getElementById('editar_registro_btn');
const editar_registro_form = document.getElementById('editar_registro_form');
const editar_post_btn = document.getElementById('editar_post_btn');
const editar_post_form = document.getElementById('editar_post_form');
const eliminar_post_btn = document.getElementById('eliminar_post_btn');
const eliminar_post_form = document.getElementById('eliminar_post_form');
const cerrar_sesion_btn = document.getElementById('cerrar_sesion_btn');
const cerrar_sesion_form = document.getElementById('cerrar_sesion_form');
const marcar_recuperado_btn = document.getElementById('marcar_recuperado_btn');
const marcar_recuperado_form = document.getElementById('marcar_recuperado_form');

const body = document.body

if (registro_btn) {
   registro_btn.addEventListener('click', () => {
      toggleModal(login_form);
      toggleModal(registro_form);
   });
}

if (login_btn) {
   login_btn.addEventListener('click', () => toggleModal(login_form));
}

if (login_btn2) {
   login_btn2.addEventListener('click', () => toggleModal(login_form));
}

if (crear_post_btn) {
   crear_post_btn.addEventListener('click', () => toggleModal(crear_post_form));
}

if (editar_registro_btn) {
   editar_registro_btn.addEventListener('click', () => toggleModal(editar_registro_form));
}

if (editar_post_btn) {
   editar_post_btn.addEventListener('click', () => toggleModal(editar_post_form));
}

if (eliminar_post_btn) {
   eliminar_post_btn.addEventListener('click', () => toggleModal(eliminar_post_form));
}

if (cerrar_sesion_btn) {
   cerrar_sesion_btn.addEventListener('click', () => toggleModal(cerrar_sesion_form));
}

if (marcar_recuperado_btn) {
   marcar_recuperado_btn.addEventListener('click', () => toggleModal(marcar_recuperado_form));
}

const myFile = document.getElementById('myFile');
const myFile2 = document.getElementById('myFile2');
const myFileArea = document.getElementById('myFileArea');
const myFileArea2 = document.getElementById('myFileArea2');

if (myFile) {
   myFile.addEventListener('change', () => {
      myFileArea.classList.add('fotocargada');
   });
}

if (myFile2) {
   myFile2.addEventListener('change', () => {
      myFileArea2.classList.add('fotocargada');
   });
}
window.addEventListener('click', (e) => {
   if (e.target.id == 'crear_post_form') {
      myFileArea.classList.remove('fotocargada');
      toggleModal(crear_post_form);
   } else if (e.target.id == 'login_form') {
      toggleModal(login_form);
   } else if (e.target.id == 'registro_form') {
      toggleModal(registro_form);
   } else if (e.target.id == 'editar_registro_form') {
      toggleModal(editar_registro_form);
   } else if (e.target.id == 'editar_post_form') {
      toggleModal(editar_post_form);
   } else if (e.target.id == 'eliminar_post_form') {
      toggleModal(eliminar_post_form);
   } else if (e.target.id == 'cerrar_sesion_form') {
      toggleModal(cerrar_sesion_form);
   } else if (e.target.id == 'marcar_recuperado_form') {
      toggleModal(marcar_recuperado_form);
   }

   if (e.target.parentElement.id != 'options_desplegable' && options_btn.classList.contains('active') && e.target.parentElement.id != 'options_btn') {
      options_desplegable.classList.toggle('hideElement');
      options_btn.classList.remove('active');
   }

   if (e.target.id == 'cerrar_modal') {
      e.preventDefault()
      const currentModal = document.getElementById(e.target.parentElement.parentElement.parentElement.id);
      toggleModal(currentModal);
      myFileArea.classList.remove('fotocargada');
   }
});

const toggleModal = (modal) => {
   window.scrollTo(0, 0);
   modal.classList.toggle('hideElement');
   body.classList.toggle('bloquear');
}