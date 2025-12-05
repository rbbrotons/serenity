document.getElementById('btnExportarPDF').addEventListener('click', () => {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Título
    doc.setFontSize(18);
    doc.text("Listado de Productos", 14, 15); // 14 = margen izquierdo, 15 = altura desde arriba

    // Encabezados que queremos
    const headers = ['Código', 'Nombre', 'Descripción', 'Precio', 'Stock', 'Categoría'];

    // Tomar filas visibles (solo las que no están ocultas por filtros)
    const rows = [];
    document.querySelectorAll('.mostrar tbody tr:not([style*="display: none"])').forEach(fila => {
        rows.push([
            fila.children[0].textContent,
            fila.children[1].textContent,
            fila.children[2].textContent,
            fila.children[3].textContent,
            fila.children[4].textContent,
            fila.children[5].textContent
        ]);
    });

    // Generar la tabla en el PDF
    doc.autoTable({
        head: [headers],
        body: rows,
        startY: 25, // ajustamos para que no se superponga con el título
        headStyles: { fillColor: [41, 128, 185] },
        theme: 'grid'
    });

    doc.save('productos.pdf');
});
