<?php
session_start();

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php"); // Redirigir si no está logueado
    exit();
}

// Evitar cacheo para que no se pueda usar "atrás" después de cerrar sesión
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
header("Pragma: no-cache");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <title>Panel de Usuario</title>
    <script src="https://kit.fontawesome.com/8534bf3f5a.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>
    <link rel="stylesheet" href="./csscarpeta/panel_descuentos.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
</head>
<body>
    
    <div class="sidebar">
        <div class="brand">
            <img class="" src="./images/face-laugh-svgrepo-com.svg" alt="">
            <span>BIENVENIDO/A!</span>       
        </div>
        
        <div class="menu-container">
            <div class="menu-item">
                <a href="./panel.php" class="menu-link">
                    <i class="fa-solid fa-tag" ></i>
                    <span>Productos</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="./panel_clientes.php" class="menu-link">
                    <i class="fa-solid fa-users" ></i>
                    <span>Clientes</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="./panel_pedidos.php" class="menu-link">
                    <i class="fa-solid fa-cart-shopping" ></i>
                    <span>Pedidos</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="" class="menu-link">
                    <i class="fa-solid fa-tags";"></i>
                    <span>Descuentos</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="./reportes.php" class="menu-link">
                    <i class="fa-solid fa-file-lines" ></i>
                    <span>Reportes</span>
                </a>
            </div>
            <div class="menu-item">
                <a href="./dashboard" class="menu-link">
                   <i class="fa-solid fa-chart-line" ></i>
                    <span>Dashboard</span>
                </a>
            </div>
        </div>
        <div class="container-usuario">
            <div class="img-usr">
                <i class="fa-solid fa-circle-user"></i>
            </div>
            <div class="data-user">
                <span class="nombre">Hola <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</span>
            </div>
            <div class="container-cerrar">
                <button type="button" class="cerrar" id="btnCerrarSesion">Cerrar Sesión<i class="fa-solid fa-right-from-bracket"></i>
            </button>
            </div>
        </div>
    </div>
    <h2>DESCUENTOS</h2>
    <button class="btn-aplicar"> Aplicar descuento <i class="fa-solid fa-percent"></i></button>
      <div class="conteiner-tab">
        <table class="mostrar">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoria</th>
                    <th>% Descuento</th> 
                    <th>Precio con descuento</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("./clases/Cdescuentos.php");
                $consulta=Cdescuentos::Mostrarproductosdto();

                foreach($consulta as $fila){
                    echo "<tr>";
                        echo"<td>".$fila["codigo"]."</td>";
                        echo"<td>".$fila["nombre"]."</td>";
                        echo"<td>".$fila["precio"]."</td>";
                        echo '<td >' . $fila['nombre_cat'] . '</td>';
                        echo"<td >".$fila['descuento']."</td>";
                        echo "<td>".$fila["precio_descuento"]."</td>";              
                        echo "</tr>";
                }
                ?>        
            </tbody>
        </table>
    </div>

    <div class="container-desc">
        <button class="btn-salir-desc"><i class="fa-solid fa-xmark fa-lg" style="color: black;"></i></button>
        <h2 class="desc-h2">APLICAR DESCUENTO</h2>
        <form action="./procesar_datos/procesar_desc/procesar_descuento.php" method="POST" class="form-editar" >
            <div class="container-campos">
                <h4>COMO QUIERES APLICAR EL DESCUENTO?</h4>
                <div class="radio-div">
                    <input type="radio" name="tipodesc" value="producto">
                    Por producto
                    </label>

                    <label>
                    <input type="radio" name="tipodesc" value="categoria">
                    Por categoría
                    </label>

                    <label>
                    <input type="radio" name="tipodesc" value="todo">
                    Todos los productos
                    </label>
                </div>
                <label>
            </div>
            <div class="container-campos">
                <select name="producto" id="selec-prod" class="selec-prod" disabled>
                    <option value="">Todos los productos</option>
            <?php
                include_once("./clases/Cproductos.php");
                $productos = Cproductos::Mostrarproductos();

                foreach($productos as $prod){
                    echo "<option value='{$prod['Codigo']}'>{$prod['Nombre']}</option>";
                }
            ?>
                </select>
            </div>
            
            <div class="container-campos"> 
                <select id="selec-categoria" name="categoria" class="selec-categoria" disabled>
                    <option value="">Todas las categorías</option>
                    <?php
                        include_once("./clases/Cproductos.php");
                        $categorias = Cproductos::MostrarCategorias();

                        foreach($categorias as $cat){
                            echo "<option value='{$cat['ID_categoria']}'>{$cat['Nombre_cat']}</option>";
                        }
                    ?>

                </select>
            </div>
            <div class="container-campos">
                <input class="inp-per"type="number" id="porcentaje" min="0" max="100" step="1" name="descuento"> %

            </div>

            <div class="btns">
            <button  class="btn-acep-desc">Aceptar</button>
            <button type="button" class="btn-can-desc">Cancelar</button>
            </div>
        </form>
    </div>
<script src="./js/js_descuentos/agregardescuento.js"></script>
<script src="./js/buscarprod.js"></script>
</body>
<script>
  document.getElementById("btnCerrarSesion").addEventListener("click", function () {
    Swal.fire({
      title: "¿Estás segura/o?",
      text: "Cerrarás tu sesión actual.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#7c71b2",
      cancelButtonColor: "#aaa",
      confirmButtonText: "Sí, cerrar sesión",
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "./procesar_datos/procesar_cierre.php"; // archivo PHP que destruye la sesión
      }
    });
  });
  document.querySelector('.btn-acep-desc').addEventListener('click', function (e) {
    e.preventDefault(); // evita que el form se mande directamente

    Swal.fire({
        title: '¿Estás segura/o?',
        text: 'Se agregara un descuento.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Sí, editar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.querySelector('.form-editar').submit();  // ENVÍA EL FORMULARIO
        }
    });
});

</script>
<?php if (isset($_GET['ok']) && $_GET['ok'] == '1'): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    icon: 'success',
    title: 'Descuento aplicado correctamente',
    showConfirmButton: false,
    timer: 1800
}).then(() => {
    // Quitar ?ok=1 de la URL sin recargar la página
    const url = new URL(window.location);
    url.searchParams.delete('ok');
    window.history.replaceState({}, '', url);
});
</script>
<?php endif; ?>


</html>
