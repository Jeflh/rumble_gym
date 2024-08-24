<?php

class RutinaController
{
  private $db;
  private $auth;
  private $rutinaModel;
  private $usuarioModel;

  public function __construct()
  {
    $this->db = Conectar::conexion();
    $this->auth = autenticado();

    require_once('models/M_rutina.php');
    require_once('models/M_usuario.php');

    // Modelo de Rutinas
    $this->rutinaModel = new RutinaModel();
    // Modelo de Usuario
    $this->usuarioModel = new UsuarioModel(); //
    $usuarios = new UsuarioModel();

    if (!$this->auth) {
      header("Location: index.php?c=panel");
    }
  }

  public function index()
  { // Función para mostrar todas las rutinas del usuario
    $rutinas = $this->rutinaModel->getRutinasUser($_SESSION['usuario']['id_usuario']); // Se obtienen las rutinas del usuario
    require_once('views/rutina/V_inicioRutina.php');
  }

  public function ver(){
    if(isset($_GET['id'])){
      $rutina = $this->rutinaModel->getRutina($_GET['id']);
      $ejercicios = $this->rutinaModel->getEjerciciosRutina($rutina);
      require_once('views/rutina/V_rutina.php');
    }
  }

  /* Formulario para generar nuevas rutinas*/
  public function crear()
  {
    require_once('views/rutina/V_crearRutina.php');
  }

  // PENDIENTE
  public function editar()
  { // Función para mostrar todas las rutinas del usuario
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $usuario = $_SESSION['id_usuario'];

      //$rutinasuser = $this->rutinaModel->getRutinasUser($_SESSION['id_usuario']);
      $rutinas = $this->rutinaModel->getRutinasUser($usuario['id_usuario']);
      require_once('views/rutina/V_editarRutina.php');
    }
  }

  public function eliminar()
  {
    if (isset($_GET['id'])) {
      $this->rutinaModel->deleteRutina($_GET['id']);
      header("Location: index.php?c=rutina&a=index&e=3");
    }
  }

  public function generar()
  {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $usuario = $_SESSION['usuario']['id_usuario'];
      $nombre_rutina = $_POST['nombre_rutina'];
      $tipo_rutina = $_POST['tipo_rutina'];
      $dias = $_POST['dias'];
      $duracion = $_POST['duracion'];

      // Validar datos
      if (empty($nombre_rutina) || empty($tipo_rutina) || empty($dias) || empty($duracion)) {
        header("Location: index.php?c=rutina&a=crear&e=1");
        return;
      }

      if (strlen($nombre_rutina) > 45) {
        header("Location: index.php?c=rutina&a=crear&e=2");
        return;
      }

      $this->rutinaModel->generarRutina($usuario, $nombre_rutina, $tipo_rutina, $dias, $duracion);
      
    }
  }
}
