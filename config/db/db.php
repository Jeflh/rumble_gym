<?php // funcion para conectar la base de datos
class Conectar{

  public static function conexion(){

    $host = "localhost"; // sql203.infinityfree.com 
    $user = "root"; // if0_37743579
    $pass = "admin"; // 6bYCM4vRY2I
    $db = "rumble_gym"; // if0_37743579_rumble_gym 

    $conexion = new mysqli($host, $user, $pass, $db);
    $conexion->query("SET NAMES 'utf8'");
    return $conexion;

  }
}
?>