<?php
include_once("../clases/Cconexion.php");
include_once("../clases/Cusuarios.php");

$resultado = Cusuarios::registrar_usuario();

switch ($resultado) {
    case "exito":
        header("Location: ../registro.php?registro=exito");
        break;
    case "existe":
        header("Location: ../registro.php?registro=existe");
        break;
    case "faltan_datos":
        header("Location: ../registro.php?registro=faltan_datos");
        break;
    default:
        header("Location: ../registro.php?registro=error");
        break;
}

exit();
