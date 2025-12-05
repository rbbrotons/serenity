<?php
include_once("../../clases/Cclientes.php");

if(isset($_POST['nombre_add'])){

    $nombre = trim($_POST['nombre_add']);
    $apellido= trim($_POST['apellido_add']);
    $correo = trim($_POST['correo_add']);
    $domicilio = trim($_POST['dom_add']);

    // VALIDACIÓN SERVIDOR
    if ($nombre == "" || $apellido == "" || $correo == "" || $domicilio=="") {
        header("Location: ../panel_clientes.php?agregado=error");
        exit();
    }

    $resultado = Cclientes::AgregarCliente($nombre, $apellido, $domicilio, $correo);

    if($resultado){
        header("Location: ../../panel_clientes.php?agregado=ok");
    } else {
        header("Location: ../../panel_clientes.php?agregado=error");
    }
    exit();
}
?>
