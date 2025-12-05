<?php
include_once "Cconexion.php";

class Cdescuentos{

     public static function Mostrarproductosdto(){
        $query=Cconexion::ConexionBD()->prepare("
            SELECT 
                p.codigo,
                p.nombre,
                p.precio,
                c.nombre_cat,
                d.descuento,
                CAST(p.precio * (1 - ISNULL(d.descuento, 0) / 100.0) AS decimal(10,2)) AS precio_descuento
            FROM productos p
            JOIN categoria c 
                ON c.id_categoria = p.id_categoria
            LEFT JOIN descuentos d 
                ON d.id_producto = p.codigo;
");
        $query->execute();
        $data= $query->fetchAll();
        return $data;

    }
 public static function ActualizarDescuentoPorCategoria($idCategoria, $porcentaje) {

    $sql = "
        UPDATE d
        SET d.descuento = :porcentaje
        FROM descuentos d
        INNER JOIN productos p
            ON d.id_producto = p.codigo
        WHERE p.id_categoria = :categoria
    ";

    $query = Cconexion::ConexionBD()->prepare($sql);
    $query->bindParam(":porcentaje", $porcentaje, PDO::PARAM_INT);
    $query->bindParam(":categoria", $idCategoria, PDO::PARAM_INT);

    return $query->execute();
}

public static function ActualizarDescuentoATodos($porcentaje) {

    $sql = "
        UPDATE descuentos
        SET descuento = :porcentaje
    ";

    $query = Cconexion::ConexionBD()->prepare($sql);
    $query->bindParam(":porcentaje", $porcentaje, PDO::PARAM_INT);

    return $query->execute();
}
public static function ActualizarDescuentoProducto($idProducto, $porcentaje) {

    $sql = "
        UPDATE descuentos
        SET descuento = :porcentaje
        WHERE id_producto = :id
    ";

    $query = Cconexion::ConexionBD()->prepare($sql);
    $query->bindParam(":porcentaje", $porcentaje, PDO::PARAM_INT);
    $query->bindParam(":id", $idProducto, PDO::PARAM_INT);

    return $query->execute();
}

}
?>