<?php 

class LoginModel{

  private $db;

  public function __construct(){
    $this->db = Conectar::conexion();
  }

  public function autenticarCliente($codigo, $fecha_nac){
    $query = $this->db->query("SELECT * FROM usuarios WHERE id_usuario = '$codigo' AND fecha_nac = '$fecha_nac'");

    $row = $query->fetch_assoc();

    return $row;
  }

  public function autenticarEmpleado($codigo){
    $query = $this->db->query("SELECT * FROM empleados WHERE id_empleado = '$codigo'");

    $row = $query->fetch_assoc();

    return $row;
  }

}

?>