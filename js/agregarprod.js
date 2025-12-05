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
    let precio = document.querySelector('.inp-precio_add').value.trim();
    let stock = document.querySelector('.inp-stock_add').value.trim();

    if (nombre === '' || precio === '' || stock === '') {
        Swal.fire({
            icon: 'error',
            title: 'Campos incompletos',
            text: 'Completa nombre, precio y stock.'
        });
        return;  // NO ENVÍA EL FORMULARIO
    }

    if (isNaN(precio) || isNaN(stock)) {
        Swal.fire({
            icon: 'error',
            title: 'Formato incorrecto',
            text: 'Precio y stock deben ser numéricos.'
        });
        return;
    }

    Swal.fire({
        title: '¿Agregar producto?',
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
