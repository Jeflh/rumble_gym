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
          $tipo_rutina = $rutinas['tipo_rutina'];
          $dias_d = $rutinas['dias_d'];
          $id_rutina = $rutinas['id_rutina'];
          //$rutinaDelDia = $this->rutinaModel->recomendarRutinaPRUEBA_UNO('Cardio', 4);
          
          $this->rutinaModel->recomendarRutinaPRUEBA_UNO($tipo_rutina, $dias_d, $id_rutina);
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
        $id_rutina = $rutinas['id_rutina'];
          //$rutinaDelDia = $this->rutinaModel->recomendarRutinaPRUEBA_UNO('Cardio', 4);
          
        $this->rutinaModel->recomendarRutinaPRUEBA_UNO($tipo_rutina, $dias_d, $id_rutina);
       
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

  

  
  
  // V2 imprimirRutina
  public function imprimirRutinaVDOS($dias_d, $diasPrueba, $usuario) {
    $rutinas = $this->rutinaModel->getUltimoDato($usuario['id_usuario']);
    $id_usuario = $usuario['id_usuario'];
    $id_rutina = $rutinas['id_rutina'];
    $diasPrueba = $this->rutinaModel->obtenerDiasPRUEBA_UNO($id_usuario, $id_rutina);
    
    for ($dia = 1; $dia <= $dias_d; $dia++) {
        echo "<h4 class=\"mt-5\"><strong>Día $dia</strong></h4>";
        // Convertir $dia a 'dia1', 'dia2', etc.
        $diaKey = 'dia' . $dia;
        // Verificar si existe el día en $diasPrueba
        if (isset($diasPrueba[$diaKey])) {
            $this->imprimirBloqueVDOS($diasPrueba[$diaKey], $usuario);
        } else {
            echo "<p>No hay ejercicios disponibles para el día$dia</p>";
        }
    }
  }

  // V2 imprimirBloque
  public function imprimirBloqueVDOS($ejer, $usuario) {
    foreach ($ejer as $i => $ejercicio) {
        $infoEjercicios = $this->rutinaModel->getIdEjercicio($ejercicio);
        $id_ejercicio = $infoEjercicios['id_ejercicio'];
        $nombre_ejercicio = $infoEjercicios['nombre_ejercicio'];
        $descripcion_ejercicio = $infoEjercicios['descripcion'];
        $img_ejercicio = $infoEjercicios['imagen_url'];
        echo "<div class=\"d-flex justify-content-center mt-4\">";
        // Bloque del ejercicio
        echo "<div class=\"col card text-white bg-dark me-2\" style=\"max-width: 30rem; text-align: center;\">";
        echo "<div class=\"card-header\">";
        echo "<h4>Ejercicio " . ($i + 1) . "</h4>";
        echo "</div>";
        echo "<div class=\"card-body\">";
        echo "Ejercicio $ejercicio";
        if ($id_ejercicio == $ejercicio) {
          echo "</br>";
          echo "<img src=\"" . $img_ejercicio . "\" alt=\"Imagen del ejercicio\" style=\"width:100%; height:auto;\">";
          //echo $img_ejercicio;
        }
        else{
            echo "<p>No se encontró el ejercicio</p>";
        }
        
        echo "</div>";
        echo "</div>";
        // Bloque de descripción
        echo "<div class=\"col card text-white bg-dark me-2\" style=\"max-width: 90rem; text-align: center;\">";
        echo "<div class=\"card-header\">";
        echo "<h4>Descripción</h4>";
        echo "</div>";
        echo "<div class=\"card-body\">";
        echo "<div class=\"card-text\">";
        echo "<strong>Nombre: </strong>{$nombre_ejercicio}</br>";
        echo "<strong>Descripción: </strong>{$descripcion_ejercicio}";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</div>"; // Cerrar el contenedor del bloque
    }
  }






/*
  // V1
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
    // V1
  public function imprimirRutina($dias_d, $rutinas, $usuario) {
    for ($dia = 1; $dia <= $dias_d; $dia++) {
        echo "<h4 class=\"mt-5\"><strong>Día $dia</strong></h4>";
        $this->imprimirBloque($dia, $rutinas, $usuario);
        
        /*$numBloques = $bloquesPorDia["dia$dia"];
        for ($bloque = 1; $bloque <= $numBloques; $bloque++) {
            //$this->imprimirBloque($dia, $rutinas, $usuario, $bloque);
        }
      }
    }



    */
   
    
  


  

  


}
  


?>