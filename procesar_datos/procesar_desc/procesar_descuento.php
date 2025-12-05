<?php
require_once "../../clases/Cdescuentos.php";

// 1️⃣ Capturar datos del formulario
$tipo = $_POST['tipodesc'] ?? null;
$porcentaje = $_POST['descuento'] ?? null;
$idProd = $_POST['producto'] ?? null;
$idCat = $_POST['categoria'] ?? null;

// Validación básica
if ($porcentaje === null || $porcentaje === "") {
    die("ERROR: No ingresaste un porcentaje.");
}

switch ($tipo) {

    case "todo":
        Cdescuentos::ActualizarDescuentoATodos($porcentaje);
        break;

    case "categoria":
        if (!$idCat) die("ERROR: No seleccionaste una categoría.");
        Cdescuentos::ActualizarDescuentoPorCategoria($idCat, $porcentaje);
        break;

    case "producto":
        if (!$idProd) die("ERROR: No seleccionaste un producto.");
        Cdescuentos::ActualizarDescuentoProducto($idProd, $porcentaje);
        break;

    default:
        die("ERROR: Tipo de descuento inválido.");
}

// Redireccionar a la página principal
header("Location: ../../descuentos.php?ok=1");
exit;
