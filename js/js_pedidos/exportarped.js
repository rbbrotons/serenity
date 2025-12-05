document.getElementById('btnExportarPDF').addEventListener('click', () => {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // --- TÍTULO ---
    doc.setFontSize(18);
    doc.text("Listado de Pedidos", 14, 15);

    // --- ENCABEZADOS ---
    const headers = ['N° Pedido', 'Cliente', 'Estado', 'Estado de pago', 'Fecha'];

    // --- FILAS VISIBLES ---
    const rows = [];
    document.querySelectorAll('.mostrar tbody tr:not([style*="display: none"])').forEach(fila => {
        rows.push([
            fila.children[0].textContent,
            fila.children[1].textContent,
            fila.children[2].textContent,
            fila.children[3].textContent,
            fila.children[4].textContent,
         
        ]);
    });

    // --- GENERAR TABLA EN EL PDF ---
    doc.autoTable({
        head: [headers],
        body: rows,
        startY: 25,
        headStyles: { fillColor: [41, 128, 185] },
        theme: 'grid'
    });

    // --- GUARDAR PDF ---
    doc.save('pedidos.pdf');
});
