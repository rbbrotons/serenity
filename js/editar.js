

    const containerEditar = document.querySelector('.container-editar');

    containerEditar.style.display = 'none';
    const botonesEditar = document.querySelectorAll('.btn-edit');

    botonesEditar.forEach(btn => {
        btn.addEventListener('click', function () {

            // Mostrar el contenedor de editar
            containerEditar.style.display = "block";

            // Buscar la fila (TR) que corresponde al botón
            const fila = this.closest('tr');  

            // Capturar los valores de cada columna
            const codigo     = fila.children[0].textContent;
            const nombre     = fila.children[1].textContent;
            const desc       = fila.children[2].textContent;
            const precio     = fila.children[3].textContent;
            const stock      = fila.children[4].textContent;

            const categoriaID = fila.children[5].getAttribute('data-id');

            // Rellenar los inputs del formulario
            document.querySelector('.inp-nombre').value = nombre;
            document.querySelector('.txt-desc').value   = desc;
            document.querySelector('.inp-precio').value = precio;
            document.querySelector('.inp-stock').value  = stock;
            document.querySelector('.sel-cat').value =categoriaID;

            // Guardamos el ID en un input oculto para el UPDATE
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
document.querySelector('.btn-can-ed').addEventListener('click', ()=>{
    document.querySelector('.container-editar').style.display = "none";  // Oculta el formulario
    document.querySelector('.form-editar').reset();  // Limpia los campos
});
