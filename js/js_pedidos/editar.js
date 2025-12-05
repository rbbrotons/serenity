const containerEditar = document.querySelector('.container-editar');
const botonesEditar = document.querySelectorAll('.btn-edit');
const selectEstado = document.querySelector('.estado-selec');
const selectPago = document.querySelector('.estado-pago-selec');

containerEditar.style.display = 'none';

botonesEditar.forEach(btn => {
    btn.addEventListener('click', function () {

        containerEditar.style.display = "block";

        // Datos desde los data-attributes
        const codigo = this.getAttribute('data-id');
        const estadoActual = this.getAttribute('data-estado');
        const estadoPagoActual = this.getAttribute('data-estado-pago');

        // Mostrar ID del pedido
        document.querySelector('.inp-numero').value = codigo;

        // Seleccionar valores del select
        selectEstado.value = estadoActual;
        selectPago.value = estadoPagoActual;

        // Borrar inputs ocultos previos
        document
            .querySelectorAll("input[name='codigo']")
            .forEach(e => e.remove());

        // Crear input oculto nuevo
        let inputCodigo = document.createElement('input');
        inputCodigo.type = 'hidden';
        inputCodigo.name = 'codigo';
        inputCodigo.value = codigo;

        document.querySelector('.form-editar').appendChild(inputCodigo);
    });
});

// Botón salir
document.querySelector('.btn-salir-edt').addEventListener('click', ()=>{
    containerEditar.style.display = "none";
});

// Botón cancelar
document.querySelector('.btn-can-ed').addEventListener('click', ()=>{
    containerEditar.style.display = "none";
    document.querySelector('.form-editar').reset();
});
