<?php
  
class RutinasController{
  private $db;
  private $auth;
  private $rutinaModel;
  private $usuarioModel; //

  public function __construct(){
    $this->db = Conectar::conexion();
    $this->auth = autenticado();

    require_once ('models/M_rutinas.php');
    require_once('models/M_usuario.php');
    
    // Modelo de Rutinas
    $this->rutinaModel = new RutinasModel();
    // Modelo de Usuario
    $this->usuarioModel = new UsuarioModel(); //
    $usuarios = new UsuarioModel();

    if(!$this->auth){
      header("Location: index.php?c=panel");
    }
  }


  /* Visualización Panel de Nuevas Rutinas*/
  public function index(){
    require_once('views/rutinas/V_nuevaRutinas.php');
  }

  public function inicio(){ // Función para mostrar la rutina personalizada del usuario
    require_once('views/rutinas/V_inicioRutinas.php');
  }


  public function editar(){ // Función para mostrar todas las rutinas del usuario
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id_usuario = $_POST['id_usuario'];
      //$rutinasuser = $this->rutinaModel->getRutinasUser($_SESSION['id_usuario']);
      $rutinasuser = $this->rutinaModel->getRutinasUser($id_usuario);
      require_once('views/rutinas/V_editarRutinas.php');
    }
  }



  # PRUEBA 
  public function insertar(){ // Función para insertar una rutina
      if(isset($_POST)){
        $resultado = $this->rutinaModel->insertRutina(); //
        if ($resultado) {
          echo "Rutina insertada correctamente :D";
          //header('Location: index.php?c=rutinas&a=insertar&e=0');
        }
        else{
          echo "Error al insertar la rutina a la base de datos :(";
        }

        require_once('views/prueba/V_inicioPrueba.php');   
      }
  }


   /*
  # ESTO FUE CREADO POR COPILOT
  public function crear(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id = $_POST['id'];
      $tipo = $_POST['tipo'];
      $dias = $_POST['dias'];
      $duracion = $_POST['duracion'];
      $sql = "INSERT INTO rutinas (id_usuario, tipo, dias, duracion) VALUES ('$id', '$tipo', '$dias', '$duracion')";
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
      $sql = "UPDATE rutinas SET tipo = '$tipo', dias = '$dias', duracion = '$duracion', WHERE id_usuario = '$id'";
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
    
  
  */


}
  


?>