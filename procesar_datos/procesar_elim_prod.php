<?php
include_once("../clases/Cproductos.php");

if (isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];

    // Ejecutar en la clase
    if (Cproductos::EliminarProducto($codigo)) {
        header("Location: ../panel.php?eliminado=ok");
        exit();
    } else {
        header("Location: ../panel.php?eliminado=error");
        exit();
    }
}
?>
