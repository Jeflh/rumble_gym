<?php

class AsistenciaModel{
  private $db;
  private $listaAsistencia; 

  public function __construct(){
    $this->db = Conectar::conexion();
    $this->listaAsistencia = array();
  }

  public function setDia($usuario){
    $id_usuario = $usuario['id_usuario'];
    $fecha_asistencia = $usuario['fecha_asistencia'];
    $estado = $usuario['estado'];
    
    $query = $this->db->query("INSERT INTO asistencias (id_usuario, fecha_asistencia, estado)  VALUES('$id_usuario', '$fecha_asistencia', '$estado')");
  }

  public function updateDia($usuario){
    $id_usuario = $usuario['id_usuario'];
    $fecha_asistencia = $usuario['fecha_asistencia'];
    $estado = $usuario['estado'];

    $query = $this->db->query("UPDATE asistencias SET estado = '$estado' WHERE fecha_asistencia = '$fecha_asistencia' AND id_usuario = '$id_usuario'");
  }

  public function existeDia($fecha){
    $query = $this->db->query("SELECT * FROM asistencias WHERE fecha_asistencia = '$fecha'");

    if($query->num_rows > 0){
      return true;
    } else {
      return false;
    }
  }

  public function getAsistencias($id, $inicio, $fin){
    $query = $this->db->query("SELECT id_usuario, estado FROM asistencias WHERE id_usuario = '$id' AND fecha_asistencia BETWEEN '$inicio' AND '$fin'");

    while($row = $query->fetch_assoc()) {
      $this->listaAsistencia[] = $row;
    }

    return $this->listaAsistencia;
  }

}

?>