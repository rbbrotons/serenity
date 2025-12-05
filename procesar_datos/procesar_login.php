<?php
session_start();
include_once("../clases/Cconexion.php");
include_once("../clases/Cusuarios.php");

$usuario = $_POST['nombre_user'] ?? '';
$contrasena = $_POST['contrasena_user'] ?? '';

if (Cusuarios::validar_datos($usuario, $contrasena)) {
    $_SESSION['usuario'] = $usuario;
    header("Location: ../panel.php");
    exit();
} else {
    // Redirigir a index con parámetro de error
    header("Location: ../index.php?login=error");
    exit();
}