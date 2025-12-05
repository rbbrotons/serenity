// --- ELIMINAR ---
document.querySelectorAll('.btn-elim').forEach(btn => {
    btn.addEventListener('click', function () {
        const codigo = this.getAttribute('data-id');  // CÓDIGO DEL PROD

        Swal.fire({
            title: '¿Eliminar producto?',
            text: `Se eliminará el producto con código ${codigo}.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Crear un formulario oculto para enviar el código
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = './procesar_datos/procesar_elim_prod.php';

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'codigo';
                input.value = codigo;

                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    });
});
