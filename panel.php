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
    <link rel="stylesheet" href="./csscarpeta/panel.css">
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
                <a href="" class="menu-link">
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
                <a href="./descuentos.php" class="menu-link">
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
                <a href="dashboard.php" class="menu-link">
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
    <h2>PRODUCTOS</h2>
    <div class="filtros">
        <input type="text" id="buscarProducto" class="buscarproducto" placeholder="Buscar por nombre...">
        

        
       <select id="filtroCategoria" class="filtrocategoria">
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
    <button id="btnExportarPDF" class="exportar">Exportar <i class="fa-solid fa-file-arrow-down"></i></i></button>
    <div class="conteiner-tab">
        <table class="mostrar">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoria</th>
                    <th class="fechat">Fecha Alta</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("./clases/Cproductos.php");
                $consulta=Cproductos::Mostrarproductos();

                foreach($consulta as $fila){
                    echo "<tr>";
                        echo"<td>".$fila["Codigo"]."</td>";
                        echo"<td>".$fila["Nombre"]."</td>";
                        echo"<td>".$fila["Descripcion"]."</td>";
                        echo"<td>".$fila["Precio"]."</td>";
                        echo"<td>".$fila["Stock"]."</td>";
                        echo '<td data-id="' . $fila['ID_categoria'] . '">' . $fila['Nombre_cat'] . '</td>';

                        echo"<td class='fechat'>".$fila["fecha"]."</td>";
                        echo "<td><button class='btn-edit'data-id='".$fila["Codigo"]."'>EDITAR <i class='fa-solid fa-pen-to-square' style='color: #000000;'>
                        </i></button><button class='btn-elim' data-id='".$fila["Codigo"]."'>ELIMINAR<i class='fa-solid fa-trash' style='color: #ffffffff;'></i></button></td>";              
                        echo "</tr>";
                }
                ?>        
            </tbody>
        </table>
    </div>
        <div class="div-boton-agregar"><button class="boton-agregar">AGREGAR NUEVO PRODUCTO<i class="fa-solid fa-plus"></i></button></div>

        <div class="container-agregar">
            <button class="btn-salir-agr"><i class="fa-solid fa-xmark fa-lg" style="color: black;"></i></button>
            <h2 class="agregar-h2">AGREGAR NUEVO PRODUCTO</h2>
            <form action="./procesar_datos/procesar_agregar_prod.php" method="POST" class="form-Agregar">

                <div class="container-campos">
                    <h4>Nombre del Producto</h4>
                    <Input type="text" class="inp-nombre_add" name="nombre_add" required></Input>
                </div>

                <div class="container-campos">
                    <h4>Descripción</h4>
                    <textarea class="txt-desc_add" name="descripcion_add" required></textarea>
                </div>

                <div class="container-campos">
                    <h4 class="h4-prc">Precio</h4>
                    <input type="text" class="inp-precio_add" name="precio_add" required></input>
                </div>

                <div class="container-campos">
                    <h4 >Stock</h4>
                    <input type="text" class="inp-stock_add" name="stock_add" required></input>
                </div>

                <div class="container-campos">
                    <h4>Categoria</h4>
                    <select name="nombre_cats_add" id="nombre_cats_add" class="sel-cat_add  " required >
                        <?php
                            include_once("./clases/Cproductos.php");
                            $categorias = Cproductos::MostrarCategorias();

                            foreach($categorias as $cat){
                                echo "<option value='{$cat['ID_categoria']}'>
                                        {$cat['Nombre_cat']}
                                    </option>";
                            }
                        ?>
                    </select>
                </div>
                    <div class="btns">
                    <button  class="btn-acep-agr">Agregar</button>
                    <button type="button" class="btn-can-agr">Cancelar</button>
                </div>
            </form>
        </div>

    <div class="container-editar">
        <button class="btn-salir-edt"><i class="fa-solid fa-xmark fa-lg" style="color: black;"></i></button>
        <h2 class="editar-h2">EDITAR</h2>
        <form action="./procesar_datos/procesar_edit_prod.php" method="POST" class="form-editar" >
            <div class="container-campos">
                <h4>Nombre del Producto</h4>
                <Input type="text" class="inp-nombre" name="nombre"></Input>
            </div>

            <div class="container-campos">
                <h4>Descripción</h4>
                <textarea class="txt-desc" name="descripcion"></textarea>
            </div>

            <div class="container-campos">
                <h4 class="h4-prc">Precio</h4>
                <input type="text" class="inp-precio" name="precio"></input>
            </div>

            <div class="container-campos">
                <h4 >Stock</h4>
                <input type="text" class="inp-stock" name="stock"></input>
            </div>

            <div class="container-campos">
                <h4>Categoria</h4>
                <select name="nombre_cats" id="nombre_cats" class="sel-cat" >
                <?php
                    include_once("./clases/Cproductos.php");
                    $categorias = Cproductos::MostrarCategorias();

                    foreach($categorias as $cat){
                        echo "<option value='{$cat['ID_categoria']}'>
                                {$cat['Nombre_cat']}
                            </option>";
                    }
                ?>
                </select>
            </div>
            
            <div class="btns">
            <button  class="btn-acep-ed">Aceptar</button>
            <button type="button" class="btn-can-ed">Cancelar</button>
            </div>
        </form>
    </div>
<script src="./js/editar.js"></script>
<script src="./js/agregarprod.js"></script>
<script src="./js/eliminarprod.js"></script>
<script src="./js/buscarprod.js"></script>
<script src="./js/exportarprod.js"></script>
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
  document.querySelector('.btn-acep-ed').addEventListener('click', function (e) {
    e.preventDefault(); // evita que el form se mande directamente

    Swal.fire({
        title: '¿Estás segura/o?',
        text: 'Se actualizará este producto.',
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
<?php if (isset($_GET['editado']) && $_GET['editado'] == 'ok'): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
Swal.fire({
    icon: 'success',
    title: 'Producto actualizado correctamente',
    showConfirmButton: false,
    timer: 1800
}).then(() => {
    // 🔹 Eliminar el parámetro editado de la URL sin recargar
    const url = new URL(window.location);
    url.searchParams.delete('editado');
    window.history.replaceState({}, '', url); 
});
</script>
<?php endif; ?>
<?php if (isset($_GET['eliminado']) && $_GET['eliminado'] == 'ok'): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Producto eliminado correctamente',
    showConfirmButton: false,
    timer: 1800
}).then(() => {
    const url = new URL(window.location.href);
    url.searchParams.delete('eliminado');
    window.history.replaceState({}, '', url);
});
</script>
<?php endif; ?>

<?php if (isset($_GET['agregado']) && $_GET['agregado'] == 'ok'): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Producto agregado correctamente',
    showConfirmButton: false,
    timer: 1800
}).then(() => {
    const url = new URL(window.location);
    url.searchParams.delete('agregado');
    window.history.replaceState({}, '', url);
});
</script>
<?php endif; ?>
<?php if (isset($_GET['eliminado']) && $_GET['eliminado'] == 'ok'): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Producto eliminado correctamente',
    showConfirmButton: false,
    timer: 1800
}).then(() => {
    const url = new URL(window.location);
    url.searchParams.delete('eliminado');
    window.history.replaceState({}, '', url);
});
</script>
<?php endif; ?>

</html>
