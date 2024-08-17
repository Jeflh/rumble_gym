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


  public function index(){ // Función para mostrar todas las rutinas del usuario
    $usuario = $_SESSION['usuario'];
    $rutinas = $this->rutinaModel->getRutinasUser($usuario['id_usuario']); // Se obtienen las rutinas del usuario
    require_once('views/prueba/V_inicioPrueba.php');
  }




  /* Visualización Panel de Nuevas Rutinas*/
  public function nueva(){
    require_once('views/rutinas/V_nuevaRutinas.php');
  }

  public function inicio(){ // Función para mostrar la rutina personalizada del usuario
    require_once('views/rutinas/V_inicioPrueba.php');
  }

// PENDIENTE
  public function editar(){ // Función para mostrar todas las rutinas del usuario
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $usuario = $_SESSION['id_usuario'];

      //$rutinasuser = $this->rutinaModel->getRutinasUser($_SESSION['id_usuario']);
      $rutinas = $this->rutinaModel->getRutinasUser($usuario['id_usuario']);
      require_once('views/rutinas/V_editarRutinas.php');
    }
  }



  # PRUEBA 
  public function insertar(){ // Función para insertar una rutina
      if(isset($_POST)){
        $resultado = $this->rutinaModel->insertRutina(); //
        if ($resultado) {
          echo "Rutina insertada correctamente :D";
          //
          $usuario = $_SESSION['usuario'];
          $rutinas = $this->rutinaModel->getRutinasUser($usuario['id_usuario']);
          header('Location: index.php?c=rutinas&a=insertar&e=0');
          //require_once('views/prueba/V_inicioPrueba.php');   
        }
        else{
          echo "Error al insertar la rutina a la base de datos :(";
        }
        // 
        
        
      }
  }


  # PRUEBA
  public function recomendacion() {
    if(isset($_POST)){
      $usuario = $_SESSION['usuario'];
      $ejercicios = $this->rutinaModel->getAllEjercicios();

      $rutinas = $this->rutinaModel->getUltimoDato($usuario['id_usuario']);
      if($rutinas){
        echo " FUNCIONA ";
        $id_usuario = $usuario['id_usuario'];
        $tipo_rutina = $rutinas['tipo_rutina'];
        $dias_d = $rutinas['dias_d'];
        $this->rutinaModel->guardarRutinaConEjercicios($id_usuario, $tipo_rutina, $dias_d);
        /*
        $dias_d = $rutinas['dias_d'];
        $bloquesPorDia = [
            'dia1' => $rutinas['dia1'],
            'dia2' => $rutinas['dia2'],
            'dia3' => $rutinas['dia3'],
            'dia4' => $rutinas['dia4'],
            'dia5' => $rutinas['dia5'],
            'dia6' => $rutinas['dia6'],
            'dia7' => $rutinas['dia7']
        ];
        $this->imprimirRutina($dias_d, $bloquesPorDia, $rutinas, $usuario);*/
      }
      else{
        echo " NO FUNCIONA :( ";
      }
      require_once('views/prueba/V_recomendacionPrueba.php');
    }
    /*$usuario = $_SESSION['usuario'];
    $rutinas = $this->rutinaModel->getRutinasUser($usuario['id_usuario']);
    require_once('views/prueba/V_recomendacionPrueba.php');*/
  }

  


  public function imprimirRutina($dias_d, $bloquesPorDia, $rutinas, $usuario) {
    for ($dia = 1; $dia <= $dias_d; $dia++) {
        echo "<h4 class=\"mt-5\"><strong>Día $dia</strong></h4>";
        $this->imprimirBloque($dia, $rutinas, $usuario);
        
        /*$numBloques = $bloquesPorDia["dia$dia"];
        for ($bloque = 1; $bloque <= $numBloques; $bloque++) {
            //$this->imprimirBloque($dia, $rutinas, $usuario, $bloque);
        }*/
    }
  }
  
  public function imprimirBloque($dia, $rutinas, $usuario) {
    echo "<div class=\"d-flex justify-content-center mt-4\">";
    echo "<div class=\"col card text-white bg-dark me-2\" style=\"max-width: 30rem; text-align: center;\">";
    echo "<div class=\"card-header\">";
    echo "<h4>Ejercicio $dia</h4>";
    echo "</div>";
    echo "<div class=\"card-body\">";
    
    echo "Aqui va la imagen";
    
    echo "</div>";
    echo "</div>";

    echo "<div class=\"col card text-white bg-dark me-2\" style=\"max-width: 90rem; text-align: center;\">";
    echo "<div class=\"card-header\">";
    echo "<h4>Descripción</h4>";
    echo "</div>";
    echo "<div class=\"card-body\">";
    echo "<div class=\"card-text\">";
    echo "<strong>Descripción: </strong>{$usuario['id_usuario']}";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
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