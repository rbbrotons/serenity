

    const containerEditar = document.querySelector('.container-desc');

    containerEditar.style.display = 'none';
    const botonesEditar = document.querySelectorAll('.btn-aplicar');

    botonesEditar.forEach(btn => {
        btn.addEventListener('click', function () {

            // Mostrar el contenedor de editar
            containerEditar.style.display = "block";

            // Buscar la fila (TR) que corresponde al botón
            
        });
    });

    // Botón salir
    document.querySelector('.btn-salir-desc').addEventListener('click', ()=>{
        containerEditar.style.display = "none";
    });
document.querySelector('.btn-can-desc').addEventListener('click', ()=>{
    document.querySelector('.container-desc').style.display = "none";  // Oculta el formulario
    document.querySelector('.form-editar').reset();  // Limpia los campos
});
const radios = document.querySelectorAll('input[name="tipodesc"]');
const selProd = document.getElementById('selec-prod');
const selCat = document.getElementById('selec-categoria');

// Al iniciar → ambos deshabilitados
selProd.disabled = true;
selCat.disabled = true;

radios.forEach(r => {
    r.addEventListener('change', () => {

        if (r.value === "producto") {
            selProd.disabled = false;     // habilito productos
            selCat.disabled = true;       // deshabilito categorías
            selCat.value = "";            // limpio
        }

        else if (r.value === "categoria") {
            selCat.disabled = false;      // habilito categorías
            selProd.disabled = true;      // deshabilito productos
            selProd.value = "";           // limpio
        }

        else if (r.value === "todo") {
            // No se requiere seleccionar nada
            selProd.disabled = true;
            selCat.disabled = true;
            selProd.value = "";
            selCat.value = "";
        }
    });
});

