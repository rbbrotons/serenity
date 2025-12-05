<?php
include_once "Cconexion.php";

class Cpedidos{
 public static function Mostrarpedidos(){
    $query = Cconexion::ConexionBD()->prepare("
        SELECT 
            p.ID_pedido,
            c.Nombre_cliente,
            c.Apellido_cliente,
            e.ID_estado,
            e.Nombre_estado,
            ep.id_estado_pago,
            ep.nombre_estado_pago,
            p.fecha_compra,
            SUM(dp.cantidad * pr.precio) AS total_pedido
        FROM pedido p
        JOIN cliente c ON p.ID_cliente = c.ID_cliente
        JOIN estado e ON p.ID_estado = e.ID_estado
        JOIN estado_pago ep ON ep.id_estado_pago = p.id_estado_pago
        JOIN detalle_pedido dp ON dp.ID_pedido = p.ID_pedido
        JOIN productos pr ON dp.ID_producto = pr.codigo
        GROUP BY 
            p.ID_pedido, c.Nombre_cliente, c.Apellido_cliente,
            e.ID_estado, e.Nombre_estado, ep.id_estado_pago, ep.nombre_estado_pago,
            p.fecha_compra
    ");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

public static function MostrarDetallePedido($idPedido)
{
    $sql = "
        SELECT 
            p.nombre, 
            d.cantidad, 
            d.ID_detalle, 
            d.ID_pedido, 
            d.ID_producto,
            p.precio,
            d.cantidad * p.precio AS subtotal
        FROM productos p
        JOIN detalle_pedido d 
            ON p.codigo = d.ID_producto
        WHERE d.ID_pedido = :id
    ";

    $conexion = Cconexion::ConexionBD()->prepare($sql);
    $conexion->bindParam(':id', $idPedido, PDO::PARAM_INT);
    $conexion->execute();

    return $conexion->fetchAll(PDO::FETCH_ASSOC);
}


  public static function Actualizarestado($codigo, $estado, $estado_pago) {
        
    $query = Cconexion::ConexionBD()->prepare("
        UPDATE pedido SET 
            id_estado = :e,
            id_estado_pago = :p
        WHERE ID_pedido = :id
    ");

    $query->bindParam(':id', $codigo);
    $query->bindParam(':e', $estado);
    $query->bindParam(':p', $estado_pago);

    return $query->execute();
}

   public static function Mostrarestado() {
        $query = Cconexion::ConexionBD()->prepare("
            SELECT ID_estado, Nombre_estado
            FROM estado
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
   public static function Mostrarpago() {
        $query = Cconexion::ConexionBD()->prepare("
            SELECT id_estado_pago, nombre_estado_pago
            FROM estado_pago
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

public static function MostrarTodosLosDetalles() {
    $sql = "
        SELECT 
            d.ID_pedido,
            p.nombre,
            p.precio,
            d.cantidad,
            (p.precio * d.cantidad) AS subtotal
        FROM detalle_pedido d
        JOIN productos p ON p.codigo = d.ID_producto
        ORDER BY d.ID_pedido ASC
    ";

    $stmt = Cconexion::ConexionBD()->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



}
?>