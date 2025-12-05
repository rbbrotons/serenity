<?php
include_once "Cconexion.php";

class Cproductos{
    public static function Mostrarproductos(){
        $query=Cconexion::ConexionBD()->prepare("
            select p.Codigo, p.Nombre, p.Descripcion, p.Precio, p.Stock, c.Nombre_cat, p.fecha, p.ID_categoria
            from productos p join categoria c on p.ID_categoria=c.ID_categoria");
        $query->execute();
        $data= $query->fetchAll();
        return $data;

    }
    public static function Actualizarprod($codigo, $nombre, $desc, $precio, $stock, $cat) {
        
  
  
    $query = Cconexion::ConexionBD()->prepare("
        UPDATE productos SET 
            Nombre = :n,
            Descripcion = :d,
            Precio = :p,
            Stock = :s,
            id_categoria = :c
        WHERE Codigo = :id
    ");

    $query->bindParam(':id', $codigo);
    $query->bindParam(':n', $nombre);
    $query->bindParam(':d', $desc);
    $query->bindParam(':p', $precio);   
    $query->bindParam(':s', $stock);
    $query->bindParam(':c', $cat);

    return $query->execute();

}
   public static function MostrarCategorias() {
        $query = Cconexion::ConexionBD()->prepare("
            SELECT ID_categoria, Nombre_cat
            FROM categoria
        ");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }



public static function AgregarProducto($nombre, $descripcion, $precio, $stock, $categoria) {
    $db = Cconexion::ConexionBD();

    try {
        // Iniciar transacción
        $db->beginTransaction();

        // Insertar producto
        $query = $db->prepare("
            INSERT INTO productos (Nombre, Descripcion, Precio, Stock, id_categoria, fecha)
            VALUES (:n, :d, :p, :s, :c, GETDATE())
        ");
        $query->bindParam(':n', $nombre);
        $query->bindParam(':d', $descripcion);
        $query->bindParam(':p', $precio);
        $query->bindParam(':s', $stock);
        $query->bindParam(':c', $categoria);

        $query->execute();

        // Obtener ID del nuevo producto
        $idProducto = $db->lastInsertId();

        // Insertar descuento por defecto (porcentaje = 0)
        $queryDesc = $db->prepare("
            INSERT INTO descuentos (id_producto, descuento)
            VALUES (:idProd, 0)
        ");
        $queryDesc->bindParam(':idProd', $idProducto);
        $queryDesc->execute();

        // Confirmar transacción
        $db->commit();

        return true;

    } catch (Exception $e) {
        // Revertir si algo falla
        $db->rollBack();
        return false;
    }
}


public static function EliminarProducto($codigo) {
    $query = Cconexion::ConexionBD()->prepare("
        DELETE FROM productos WHERE Codigo = :cod
    ");
    $query->bindParam(':cod', $codigo);
    return $query->execute();
}
}
?>