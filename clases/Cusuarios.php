<?php
include_once("Cconexion.php");
$consulta = Cconexion:: ConexionBD();
class Cusuarios{
    public static function validar_datos($nombre_usu,$contra){


        $query = Cconexion::ConexionBD()-> prepare ("select contraseña_hash from usuario where nom_usuario= :nombre");
        $query -> bindParam(':nombre',$nombre_usu, PDO::PARAM_STR);
        $query -> execute();
        $data = $query -> fetch(PDO::FETCH_ASSOC);
        
        if ($data) {
            if (password_verify($contra, $data['contraseña_hash'])){
                return true;
            }
        }
        return false;
    }
   
public static function registrar_usuario() {
    if (!isset($_POST["nuevo_nombre_user"], $_POST["nuevo_correo_user"], $_POST["nueva_contrasena_user"])) {
        return "faltan_datos";
    }

    $usuario = trim($_POST["nuevo_nombre_user"]);
    $email = trim($_POST["nuevo_correo_user"]);
    $contra = $_POST["nueva_contrasena_user"];
    $hash = password_hash($contra, PASSWORD_DEFAULT);

    $pdo = Cconexion::ConexionBD();

    // Verificar si ya existe usuario o correo
    $verificar = $pdo->prepare("SELECT 1 FROM usuario WHERE nom_usuario = :nombre OR correo_electronico = :correo");
    $verificar->bindParam(':nombre', $usuario, PDO::PARAM_STR);
    $verificar->bindParam(':correo', $email, PDO::PARAM_STR);
    $verificar->execute();

    if ($verificar->fetchColumn()) { // Si encontró al menos una fila
        return "existe";
    }

    // Insertar nuevo usuario
    $query = $pdo->prepare("INSERT INTO usuario (nom_usuario, rol, correo_electronico, contraseña_hash) VALUES (?, ?, ?, ?)");
    $rol = "invitado";

    $query->bindParam(1, $usuario, PDO::PARAM_STR);
    $query->bindParam(2, $rol, PDO::PARAM_STR);
    $query->bindParam(3, $email, PDO::PARAM_STR);
    $query->bindParam(4, $hash, PDO::PARAM_STR);

    if ($query->execute()) {
        return "exito";
    } else {
        return "error";
    }
}


}
