<?php
include_once("../../clases/Cpedidos.php");

if (isset($_POST['inp-numero'])) {

    // datos que SI existen en tu POST
    $id      = $_POST['inp-numero']; 
    $estado  = $_POST['estado-selec']; 
    $pago    = $_POST['estado-pago-selec'];

    // VALIDACIÓN LÓGICA
    $valido = true;

    if ($estado == 'En proceso' && $pago != 'Pagado') {
        $valido = false;
    }

    if (!$valido) {
        header("Location: /../../panel_pedidos.php?error=pendiente_no_pagado");
        exit();
    }

    // ¡OJO!: tu clase se llama Cpedidos, no Cpedido
    Cpedidos::Actualizarestado($id, $estado, $pago);

    header("Location: ../../panel_pedidos.php?editado=ok");
    exit();
}
?>
