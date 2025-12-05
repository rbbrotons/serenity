<?php
include_once("../clases/Cproductos.php");

if(isset($_POST['nombre_add'])){

    $nombre = trim($_POST['nombre_add']);
    $descripcion = trim($_POST['descripcion_add']);
    $precio = trim($_POST['precio_add']);
    $stock = trim($_POST['stock_add']);
    $categoria = $_POST['nombre_cats_add'];

    // VALIDACIÓN SERVIDOR
    if ($nombre == "" || $precio == "" || $stock == "" || !is_numeric($precio) || !is_numeric($stock)) {
        header("Location: ../panel.php?agregado=error");
        exit();
    }

    $resultado = Cproductos::AgregarProducto($nombre, $descripcion, $precio, $stock, $categoria);

    if($resultado){
        header("Location: ../panel.php?agregado=ok");
    } else {
        header("Location: ../panel.php?agregado=error");
    }
    exit();
}
?>
