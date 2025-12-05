<?php
include_once "Cconexion.php";

class Cclientes{
    public static function Mostrarclientes(){
        $query=Cconexion::ConexionBD()->prepare("
            SELECT 
                ID_cliente,
                Nombre_cliente,
                Apellido_cliente,
                Domicilio,
                correo
            FROM cliente;"
        );
        $query->execute();
        $data= $query->fetchAll();
        return $data;

    }
    public static function Actualizarcliente($codigo, $nombre, $apellido,$domicilio,$correo) {
        
  
  
    $query = Cconexion::ConexionBD()->prepare("
        UPDATE cliente SET 
            Nombre_cliente = :n,
            Apellido_cliente= :a,
            Domicilio = :d,
            correo = :c
        WHERE ID_cliente = :id
    ");

    $query->bindParam(':id', $codigo);
    $query->bindParam(':n', $nombre);
    $query->bindParam(':a', $apellido);
    $query->bindParam(':d', $domicilio);   
    $query->bindParam(':c', $correo);
    

    return $query->execute();

}



public static function AgregarCliente($nombre, $apellido, $domicilio, $correo){
    $db = Cconexion::ConexionBD();

    $query = $db->prepare("
        INSERT INTO cliente (Nombre_cliente,Apellido_cliente, Domicilio, correo)
        VALUES (:n, :a, :d, :c)
    ");

    $query->bindParam(':n', $nombre);
    $query->bindParam(':a', $apellido);
    $query->bindParam(':d', $domicilio);
    $query->bindParam(':c', $correo);


    return $query->execute();
}
}


