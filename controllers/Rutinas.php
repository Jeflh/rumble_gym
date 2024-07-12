<?php
  
class RutinasController{
  private $db;
  private $auth;

  public function __construct(){
    $this->db = Conectar::conexion();
    $this->auth = autenticado();
    if(!$this->auth){
      header("Location: index.php?c=panel");
    }
  }

  /* Visualización Panel de Nuevas Rutinas*/
  public function index(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      require_once('views/rutinas/V_nuevaRutinas.php');
    }
  }

  # ESTO FUE CREADO POR COPILOT
  public function crear(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id = $_POST['id'];
      $tipo = $_POST['tipo'];
      $dias = $_POST['dias'];
      $duracion = $_POST['duracion'];
      $dificultad = $_POST['dificultad'];
      $sql = "INSERT INTO rutinas (id_usuario, tipo, dias, duracion, dificultad) VALUES ('$id', '$tipo', '$dias', '$duracion', '$dificultad')";
      $this->db->query($sql);
      //header("Location: index.php?c=panel");
    }
  }
  public function editar(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id = $_POST['id'];
      $sql = "SELECT * FROM rutinas WHERE id_usuario = '$id'";
      $resultado = $this->db->query($sql);
      $rutina = $resultado->fetch_assoc();
      require_once('views/rutinas/V_editarRutinas.php');
    }
  }
  public function actualizar(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id = $_POST['id'];
      $tipo = $_POST['tipo'];
      $dias = $_POST['dias'];
      $duracion = $_POST['duracion'];
      $dificultad = $_POST['dificultad'];
      $sql = "UPDATE rutinas SET tipo = '$tipo', dias = '$dias', duracion = '$duracion', dificultad = '$dificultad' WHERE id_usuario = '$id'";
      $this->db->query($sql);
      //header("Location: index.php?c=panel");
    }
  }
  public function eliminar(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id = $_POST['id'];
      $sql = "DELETE FROM rutinas WHERE id_usuario = '$id'";
      $this->db->query($sql);
      //header("Location: index.php?c=panel");
    }
  }

}

?>