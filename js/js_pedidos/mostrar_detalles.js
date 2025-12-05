const contDetalle = document.querySelector('.div-detalle');
contDetalle.style.display = 'none';

const filasDetalles = document.querySelectorAll('.fila-detalle');
const botonesDetalle = document.querySelectorAll('.btn-detalle');

botonesDetalle.forEach(btn => {
    btn.addEventListener('click', () => {

        const idPedido = btn.getAttribute('data-id');

        // Mostrar el contenedor
        contDetalle.style.display = 'block';

        // Cambiar título
        const h2Detalle = contDetalle.querySelector('.h2-detalle');
        h2Detalle.textContent = `Detalle de pedido N° ${idPedido}`;

        // Ocultar todas las filas
        filasDetalles.forEach(fila => fila.style.display = 'none');

        // Mostrar solo las del pedido clickeado
        filasDetalles.forEach(fila => {
            if (fila.getAttribute('data-id-pedido') === idPedido) {
                fila.style.display = 'table-row';
            }
        });
    });
});

// Cerrar
document.querySelector('.salir-det').addEventListener('click', () => {
    contDetalle.style.display = 'none';
    
    // --- BORRAR EL ?id DE LA URL SIN RECARGAR ---
    const url = new URL(window.location);
    url.searchParams.delete('id');
    window.history.replaceState({}, '', url);

});
