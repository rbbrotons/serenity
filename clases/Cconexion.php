<?php
class Cconexion{
    public static function ConexionBD(){
        $host="localhost";
        $dbname="lenguajes4";
        $username="sa";
        $password="2011";
        $port="1433";

        try{
            $conn= new PDO("sqlsrv:server=$host, $port; database=$dbname", $username, $password);
            $conn-> setAttribute(PDO :: ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
            //echo("Se conectó a la BD");
        }
        catch(PDOException $pe){
            die ("No se logró conectar a la BD". $pe->getmessage());
        }
        return $conn;
    }
}
?>