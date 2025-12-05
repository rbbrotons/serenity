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
    <link rel="stylesheet" href="./csscarpeta/panel_pedidos.css">
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
                <a href="" class="menu-link">
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
                <a href="./reportes" class="menu-link">
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
    <h2>PEDIDOS</h2>

    
    <div class="filtros">
        <input type="text" id="buscarpedido" class="buscarpedido" placeholder="Buscar por numero de pedido">
        <select name="filtrarestado" id="filtrarestado">
             <option value="">Todos los estados</option>
            <?php
                include_once("./clases/Cpedidos.php");
                $estados = Cpedidos::Mostrarestado();

                foreach($estados as $est){
                    echo "<option value='{$est['ID_estado']}'>{$est['Nombre_estado']}</option>";
                }
            ?>
        </select>
        
        <select name="filtrarpago" id="filtrarpago">
             <option value="">Estado de pago</option>
            <?php
                include_once("./clases/Cpedidos.php");
                $pago = Cpedidos::Mostrarpago();

                foreach($pago as $pag){
                    echo "<option value='{$pag['id_estado_pago']}'>{$pag['nombre_estado_pago']}</option>";
                }
            ?>
        </select>
    </div>


    <button id="btnExportarPDF" class="exportar">Exportar <i class="fa-solid fa-file-arrow-down"></i></i></button>
    <div class="conteiner-tab">
        <table class="mostrar">
            <thead>
                <tr>
                    <th>Numero de pedido</th>
                    <th>Nombre y Apellido</th>
                    <th>Estado</th>
                    <th>Estado de pago</th>
                    <th>Fecha de compra</th>
                    <th>Total del pedido</th>
                    <th>Accion</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("./clases/Cpedidos.php");
                $consulta=Cpedidos::Mostrarpedidos();

                foreach($consulta as $fila){
                    echo "<tr data-estado='{$fila['ID_estado']}' data-pago='{$fila['id_estado_pago']}'>";
                        echo"<td>".$fila["ID_pedido"]."</td>";
                        echo "<td>".$fila['Nombre_cliente'].' '.$fila['Apellido_cliente']."</td>";
                        echo "<td data-estado='" . $fila["ID_estado"] . "'>" . $fila["Nombre_estado"] . "</td>";
                        echo "<td data-pago='" . $fila["id_estado_pago"] . "'>" . $fila["nombre_estado_pago"] . "</td>";

                        echo"<td>".$fila["fecha_compra"]."</td>";
                        echo"<td>".$fila["total_pedido"]."</td>";
                        echo "<td>
                        <button class='btn-edit'
                            data-id='" . $fila["ID_pedido"] . "'
                            data-estado='" . $fila["ID_estado"] . "'
                            data-estado-pago='" . $fila["id_estado_pago"] . "'>
                            EDITAR ESTADO Y PAGO
                            <i class='fa-solid fa-pen-to-square' style='color: #000000;'></i>
                        </button>

                        <button type='button' class='btn-detalle' data-id='" . $fila["ID_pedido"] . "'>
                            MOSTRAR DETALLE <i class='fa-solid fa-list'></i>
                        </button>
                    </td>"; 
                }
                 
                ?>        
            </tbody>
        </table>
    </div>
                
    <div class="container-editar">
        <button class="btn-salir-edt"><i class="fa-solid fa-xmark fa-lg" style="color: black;"></i></button>
        <h2 class="editar-h2">EDITAR ESTADO Y PAGO</h2>
        <form action="./procesar_datos/procesar_pedidos/procesar_editar_estado.php" method="POST" class="form-editar" >
            <div class="container-campos">
                <h4>Numero de pedido</h4>
                <Input type="text" class="inp-numero" name="inp-numero" readonly></Input>
            </div>
            <div class="container-campos">
                <h4 class="h4-estado">Estado</h4>
                <select name="estado-selec" id="estado-selec" class="estado-selec">
                    
                    <?php
                    include_once("./clases/Cpedidos.php");
                    $estados = Cpedidos::Mostrarestado();

                    foreach($estados as $est){
                        echo "<option value='{$est['ID_estado']}'>
                                {$est['Nombre_estado']}
                            </option>";
                    }
                    ?>
                </select>
                <h4 class="h4-pago">Pago</h4>
                <select name="estado-pago-selec" id="estado-pago-selec" class="estado-pago-selec">
                     <?php
                    include_once("./clases/Cpedidos.php");
                    $estados = Cpedidos::Mostrarpago();

                    foreach($estados as $est){
                        echo "<option value='{$est['id_estado_pago']}'>
                                {$est['nombre_estado_pago']}
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
    <div class="div-detalle">
        <button class="salir-det"><i class="fa-solid fa-x"></i></button>
        <h2 class="h2-detalle">Detalle de pedido N°</h2>

         <table class="mostrar t-detalle    ">
            <thead>
                <tr>
                    <th>Nombre de Producto</th>
                    <th>Cantidad</th>
                    <th>precio</th>
                    <th>Subtotal</th>
                    
                    
                </tr>
            </thead>
            <tbody>
            <?php
            include_once("./clases/Cpedidos.php");
            $detalles = Cpedidos::MostrarTodosLosDetalles();

            foreach($detalles as $fila){
                echo "<tr data-id-pedido='" . $fila["ID_pedido"] . "' class='fila-detalle'>";
                echo "<td>".$fila["nombre"]."</td>";
                echo "<td>".$fila["cantidad"]."</td>";
                echo "<td>".$fila["precio"]."</td>";
                echo "<td>".$fila["subtotal"]."</td>";
                echo "</tr>";
            }
            ?>
            </tbody>

        </table>

    </div>
    <script src="./js/js_pedidos/editar.js"></script>
<script src="./js/js_pedidos/mostrar_detalles.js"></script>
<script src="./js/js_pedidos/buscar_pedido.js"></script>
<script src="./js/js_pedidos/exportarped.js"></script>
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
        text: 'Se actualizarán el estado del pedido y el estado de pago del pedido.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Sí, actualizar',
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
    title: 'Datos del pedido actualizados correctamente',
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

<?php if (isset($_GET['agregado']) && $_GET['agregado'] == 'ok'): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Nuevo pedido agregado correctamente',
    showConfirmButton: false,
    timer: 1800
}).then(() => {
    const url = new URL(window.location);
    url.searchParams.delete('agregado');
    window.history.replaceState({}, '', url);
});
</script>
<?php endif; ?>


</html>
