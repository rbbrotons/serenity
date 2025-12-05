// MOSTRAR FORMULARIO AGREGAR
const contAgregar = document.querySelector('.container-agregar');
contAgregar.style.display = 'none';


document.querySelector('.boton-agregar').addEventListener('click', () => {
    contAgregar.style.display = 'block';
});

// CERRAR CON LA X
document.querySelector('.btn-salir-agr').addEventListener('click', () => {
    contAgregar.style.display = "none";
});

// CANCELAR
document.querySelector('.btn-can-agr').addEventListener('click', () => {
    contAgregar.style.display = "none";
});

// ACEPTAR
// ACEPTAR AGREGAR PRODUCTO
document.querySelector('.btn-acep-agr').addEventListener('click', (e) => {
    e.preventDefault();

    // VALIDACIÓN ANTES DE ENVIAR
    let nombre = document.querySelector('.inp-nombre_add').value.trim();
    let apellido = document.querySelector('.inp-apellido_add').value.trim();
    let correo = document.querySelector('.inp-correo_add').value.trim();
    let domicilio = document.querySelector('.inp-dom_add').value.trim();

    if (nombre === '' || apellido === '' || correo === '' || domicilio=== '') {
        Swal.fire({
            icon: 'error',
            title: 'Campos incompletos',
            text: 'Completa nombre, apellido, correo y domicilio.'
        });
        return;  // NO ENVÍA EL FORMULARIO
    }

    Swal.fire({
        title: '¿Agregar nuevo cliente?',
        text: 'Se guardará en la base de datos.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, agregar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector('.form-Agregar').submit();
        }
    });
});
