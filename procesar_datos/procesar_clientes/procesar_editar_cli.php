<?php
include_once("../../clases/Cclientes.php");

if(isset($_POST['codigo'])){
    $codigo = $_POST['codigo'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $domicilio = $_POST['domicilio'];
   
   

    Cclientes::Actualizarcliente($codigo, $nombre, $apellido, $domicilio, $correo);

    header("Location: ../../panel_clientes.php?editado=ok");
    exit();
}
?>
