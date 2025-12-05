const inputBuscar = document.getElementById('buscarcliente');
const tabla = document.querySelector('.mostrar tbody');

function filtrarTabla(exacto = false) {
    const texto = inputBuscar.value.toLowerCase();

    tabla.querySelectorAll('tr').forEach(fila => {
        const nombre = fila.children[1].textContent.toLowerCase();

        let mostrar = false;

        if (exacto) {
            // Coincidencia exacta por nombre 
            mostrar = (nombre === texto) ;
        } else {
            // Coincidencia parcial por nombre 
            mostrar = (nombre.includes(texto))
        }

        fila.style.display = mostrar ? "" : "none";
    });
}

// Live search: mientras escribís
inputBuscar.addEventListener('input', () => filtrarTabla(false));

// Buscar exacto con Enter
inputBuscar.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
        e.preventDefault();
        filtrarTabla(true);
    }
});

// Filtrar automáticamente al cambiar la categoría
selectCategoria.addEventListener('change', () => filtrarTabla(false));
