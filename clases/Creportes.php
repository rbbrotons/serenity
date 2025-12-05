<?php
include_once "Cconexion.php";

class Creportes{
public static function ProductosConDescuento() {
    $sql = "
        SELECT 
            p.codigo,
            p.nombre,
            p.precio,
            d.descuento,
            CAST(p.precio * (1 - d.descuento / 100.0) AS DECIMAL(10,2)) AS precio_descuento
        FROM productos p
        JOIN descuentos d ON d.id_producto = p.codigo
        WHERE d.descuento > 0
    ";

    $query = Cconexion::ConexionBD()->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
public static function ProductosSinDescuento() {
    $sql = "
        SELECT 
            p.codigo,
            p.nombre,
            p.precio,
            d.descuento
        FROM productos p
        JOIN descuentos d ON d.id_producto = p.codigo
        WHERE d.descuento = 0
    ";

    $query = Cconexion::ConexionBD()->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
public static function CantProductosPorCategoria() {
    $sql = "
        SELECT 
            c.nombre_cat,
            COUNT(*) AS cantidad_productos
        FROM productos p
        JOIN categoria c ON c.id_categoria = p.id_categoria
        GROUP BY c.nombre_cat
    ";

    $query = Cconexion::ConexionBD()->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

public static function ClientesConMasCompras() {
    $sql = "
        SELECT 
            c.id_cliente,
            c.Nombre_cliente + ' ' + c.Apellido_cliente AS Nombre_apellido,
            COUNT(p.ID_pedido) AS cantidad_compras
        FROM cliente c
        JOIN pedido p ON p.ID_cliente = c.id_cliente
        GROUP BY c.id_cliente, c.Nombre_cliente, c.Apellido_cliente
        ORDER BY cantidad_compras DESC;

    ";

    $query = Cconexion::ConexionBD()->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
public static function ProductosMasPedidos() {
    $sql = "
       
    SELECT 
            p.codigo,
            p.nombre,
            SUM(dp.cantidad) AS total_pedidos
        FROM detalle_pedido dp
        JOIN productos p ON p.codigo = dp.ID_producto
        GROUP BY p.codigo, p.nombre
        ORDER BY total_pedidos DESC
    ";

    $query = Cconexion::ConexionBD()->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
public static function ProductosSinPedidos() {
    $sql = "
         SELECT 
            p.codigo,
            p.nombre,
            p.precio
        FROM productos p
        LEFT JOIN detalle_pedido dp ON dp.ID_producto = p.codigo
        WHERE dp.ID_pedido IS NULL
    ";

    $query = Cconexion::ConexionBD()->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}


}
?>