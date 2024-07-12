<?php // funcion para conectar la base de datos
class Conectar{

  public static function conexion(){

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "rumble_gym";

    $conexion = new mysqli($host, $user, $pass, $db);
    $conexion->query("SET NAMES 'utf8'");
    return $conexion;

  }
}
?>