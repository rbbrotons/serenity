<?php
include_once("../clases/Cproductos.php");

if(isset($_POST['codigo'])){
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $stock = $_POST['stock'];
    $categoria = $_POST['nombre_cats'];

    Cproductos::Actualizarprod($codigo, $nombre, $descripcion, $precio, $stock, $categoria);

    header("Location: ../panel.php?editado=ok");
    exit();
}
?>
