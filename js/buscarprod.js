const inputBuscar = document.getElementById('buscarProducto');
const selectCategoria = document.getElementById('filtroCategoria');
const tabla = document.querySelector('.mostrar tbody');
const btnBuscar = document.getElementById('btnBuscar');

function filtrarTabla(exacto = false) {
    const texto = inputBuscar.value.toLowerCase();
    const categoria = selectCategoria.value; // ID de la categoría seleccionada

    tabla.querySelectorAll('tr').forEach(fila => {
        const nombre = fila.children[1].textContent.toLowerCase();
        const catID = fila.children[5].getAttribute('data-id'); // ID de la categoría de la fila

        let mostrar = false;

        if (exacto) {
            // Coincidencia exacta por nombre + filtro de categoría
            mostrar = (nombre === texto) && (categoria === "" || catID === categoria);
        } else {
            // Coincidencia parcial por nombre + filtro de categoría
            mostrar = (nombre.includes(texto)) && (categoria === "" || catID === categoria);
        }

        fila.style.display = mostrar ? "" : "none";
    });
}

// Live search: mientras escribís
inputBuscar.addEventListener('input', () => filtrarTabla(false));

// Buscar exacto con botón
btnBuscar.addEventListener('click', () => filtrarTabla(true));

// Buscar exacto con Enter
inputBuscar.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
        e.preventDefault();
        filtrarTabla(true);
    }
});

// Filtrar automáticamente al cambiar la categoría
selectCategoria.addEventListener('change', () => filtrarTabla(false));
