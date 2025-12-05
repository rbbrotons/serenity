document.getElementById('btnExportarPDF').addEventListener('click', async () => {
    const { jsPDF } = window.jspdf;
    const pdf = new jsPDF('p', 'mm', 'a4');

    // ✅ Título del PDF
    pdf.setFontSize(18);
    pdf.text("Dashboard de Reportes", 105, 15, { align: "center" });

    const graficos = document.querySelectorAll('.chart-container');
    let yOffset = 25; // dejamos espacio debajo del título

    for (let i = 0; i < graficos.length; i++) {
        const contenedor = graficos[i];
        const canvas = await html2canvas(contenedor, { scale: 2 });
        const imgData = canvas.toDataURL('image/png');

        const imgProps = pdf.getImageProperties(imgData);
        const pdfWidth = pdf.internal.pageSize.getWidth() - 20;
        const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

        if (yOffset + pdfHeight > pdf.internal.pageSize.getHeight()) {
            pdf.addPage();
            yOffset = 10;
        }

        pdf.addImage(imgData, 'PNG', 10, yOffset, pdfWidth, pdfHeight);
        yOffset += pdfHeight + 10;
    }

    pdf.save('dashboard.pdf');
});
