document.addEventListener('DOMContentLoaded', function() {
    const inputBuscar = document.getElementById('buscarpedido');
    const selectEstado = document.getElementById('filtrarestado');
    const selectPago = document.getElementById('filtrarpago');
    const tabla = document.querySelector('.mostrar tbody');

    function filtrarPedidos() {
        const texto = inputBuscar.value.toLowerCase();
        const estado = selectEstado.value;
        const pago = selectPago.value;

        tabla.querySelectorAll('tr').forEach(fila => {
            const numeroPedido = fila.children[0].textContent.toLowerCase();
            const estadoFila = fila.getAttribute('data-estado');
            const pagoFila = fila.getAttribute('data-pago');

            let mostrar = true;

            if (texto && !numeroPedido.includes(texto)) mostrar = false;
            if (estado && estadoFila !== estado) mostrar = false;
            if (pago && pagoFila !== pago) mostrar = false;

            fila.style.display = mostrar ? '' : 'none';
        });
    }

    // Eventos
    inputBuscar.addEventListener('input', filtrarPedidos);
    selectEstado.addEventListener('change', filtrarPedidos);
    selectPago.addEventListener('change', filtrarPedidos);
});
