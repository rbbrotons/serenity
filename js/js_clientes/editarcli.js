const containerEditar = document.querySelector('.container-editar');
containerEditar.style.display = 'none';


const botonesEditar = document.querySelectorAll('.btn-edit');

botonesEditar.forEach(btn => {
    btn.addEventListener('click', function () {

        containerEditar.style.display = "block";

        // Ahora NO saco los datos de la tabla, LOS LEO DEL BOTÓN:
        const codigo    = this.getAttribute('data-id');
        const nombre    = this.getAttribute('data-nombre');
        const apellido  = this.getAttribute('data-apellido');
        const correo    = this.getAttribute('data-correo');
      
        const domicilio = this.getAttribute('data-domicilio');

        // Rellenar los inputs
        document.querySelector('.inp-nombre').value = nombre;
        document.querySelector('.inp-apellido').value = apellido;
        document.querySelector('.inp-correo').value = correo;
        document.querySelector('.inp-dom').value = domicilio;

        // Input hidden para enviar ID
        let inputCodigo = document.createElement('input');
        inputCodigo.type = 'hidden';
        inputCodigo.name = 'codigo';
        inputCodigo.value = codigo;
        document.querySelector('.form-editar').appendChild(inputCodigo);
    });
});
const btnSalir = document.querySelector('.btn-salir-edt');

btnSalir.addEventListener('click', () => {
    containerEditar.style.display = 'none'; // Oculta el formulario
});

btnSalir.addEventListener('click', () => {
    containerEditar.style.display = 'none';
    document.querySelector('.form-editar').reset();  // Limpia los campos
});

const btnCancelar = document.querySelector('.btn-can-ed');

btnCancelar.addEventListener('click', () => {
    containerEditar.style.display = 'none';      // Oculta el formulario
    document.querySelector('.form-editar').reset(); // Limpia los campos (opcional)
});
