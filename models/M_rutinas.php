<?php 

class RutinasModel {

  private $db;
  private $rutinas;
  private $rutinasuser;
  
  // Variables de la tabla rutinasuser
  private $id_usuario;

  private $id_rutina;
  private $nombre_rutina;
  private $tipo_rutina; // Compartida
  private $dias;
  private $duracion;

  private $lista;

  // Variables de la tabla rutinas (PENDIENTES DE USAR)
  private $id_ejercicio;
  private $tipo_rutina_ejercicio; // Por si la otra no jala
  private $nombre_ejercicio;
  private $descripcion;
  private $imagen_url;



  public function __construct(){
    $this->db = Conectar::conexion();
    $this->rutinas = array();
    $this->rutinasuser = array();
    $this->lista = array();
    
    //$this->lista = array();

    // Elementos de la tabla rutinasuser
    $this->id_rutina = 0;
    $this->nombre_rutina = '';
    $this->tipo_rutina = '';
    $this->dias = '';
    $this->duracion= '';
  }


  public function getRutinasUser($id_usuario){
    $query = $this->db->query("SELECT * FROM rutinasuser WHERE id_usuario = '$id_usuario'");

    while($row = $query->fetch_assoc()) {
      $this->lista[] = $row;
    }
    return $this->lista;
  }

  public function getRutina($id_rutina){
    $query = $this->db->query("SELECT * FROM rutinasuser WHERE id_rutina = '$id_rutina'");
    $row = $query->fetch_assoc();

    return $row;
  }

  
  
  // Inserta valores a la tabla rutinasuser
  public function insertRutina(){
    if(isset($_POST)){
      
      $this->nombre_rutina = mysqli_real_escape_string($this->db, $_POST['nombre_rutina']);  
      $this->tipo_rutina = mysqli_real_escape_string($this->db, $_POST['tipo_rutina']); // Reparar
      $this->dias = mysqli_real_escape_string($this->db, $_POST['dias']); // Reparar
      $this->duracion = mysqli_real_escape_string($this->db, $_POST['duracion']);

      /*IMPORTANTE
      $usuarioRutina = $this->getRutina($this->id_usuario); // Obtenemos los datos del usuario y la rutina.
      $this->nombre_rutina = $usuarioRutina['tipo_suscripcion'];*/

      $usuario = $_SESSION['usuario']; // Obtener el usuario de la sesión
      $this->id_usuario = $usuario['id_usuario']; // Obtener el ID del usuario
      
      $error = ""; // Variable para almacenar los errores.
      if(empty($this->nombre_rutina) || strlen($this->nombre_rutina) > 45){ // Comprobamos que el nombre no esté vacío y que no supere los 50 caracteres.
        $error .= "1"; 
      }
      if($error == ""){ // Si no hay errores, se inserta el producto.

        $this->id_rutina = generarId();
        $existe = $this->getRutina($this->id_rutina);
        while($existe != null){
          $this->id_rutina = generarId();
          $existe = $this->getRutina($this->id_rutina);
        }

        $query  = $this->db->query("INSERT INTO rutinasuser (id_usuario, id_rutina, nombre_rutina, tipo_rutina, dias_d, duracion_sesiones) 
        VALUES ('$this->id_usuario', '$this->id_rutina', '$this->nombre_rutina', '$this->tipo_rutina', '$this->dias', '$this->duracion')");
 
        if($query){
          echo "Rutina insertada correctamente C:";
          return true; // Si se inserta correctamente, se devuelve true.
        }
        else{
          //echo "Error al insertar la rutina a la base de datos :C " . $this->db->error;
          //echo $this->id_usuario . " " . $this->id_rutina . " " . $this->nombre_rutina . " " . $this->tipo_rutina . " " . $this->dias . " " . $this->duracion . " ";
          return false; // Si no, se devuelve false.
        }
      }else{
        header("Location:index.php?c=rutinas&e=" . $error); 
        // Si hay errores, se redirige a la página de nuevo producto con los errores.
      }
    }
  }




  public function consultaRutinasUser($usuario){
    $id_usuario = $usuario['id_usuario'];

    $consultaTipoDuracion = "SELECT tipo_rutina, duracion_sesiones FROM rutinasuser WHERE id_usuario = $id_usuario";
    $resultadoTipoDuracion = $this->db->query($consultaTipoDuracion);
    
    if (!$resultadoTipoDuracion) {
      echo("Error al obtener la información del usuario.");
    }
    
    // mysqli_fetch_assoc = Obtiene una fila de resultados como un array asociativo
    $filaTipoDuracion = mysqli_fetch_assoc($resultadoTipoDuracion);
    $tipo_rutinaActual = $filaTipoDuracion['tipo_rutina'];
    //$duracion_sesionesActual = $filaTipoDuracion['duracion_sesiones'];
    
    // Verificar si las metas y experiencias actuales son diferentes a las almacenadas en la sesión
    if (!isset($_SESSION['tipo_rutina']) || $_SESSION['tipo_rutina_actual'] !== $tipo_rutinaActual) {
      // Actualizar las metas y experiencias actuales en la sesión
      $_SESSION['tipo_rutina_actual'] = $tipo_rutinaActual;
      //$_SESSION['duracion_sesione_actual'] = $duracion_sesionesActual;
    
      // Limpiar la rutina existente en la sesión
      unset($_SESSION['rutina']);
    }
      
  }
  
  
    
  

  public function recomendarRutinaDia($usuario, $dia){
    global $conexion;
    $id_usuario = $usuario['id_usuario'];

    if (isset($_SESSION['rutina'][$dia])) {
      $rutinaDia = $_SESSION['rutina'][$dia];
    } else {

      $consultaEjercicios = "SELECT * FROM rutinas WHERE tipo_rutina = '{$_SESSION['tipo_rutina']}' ORDER BY RAND()";
      $resultadoRutinaDia = $this->db->query($consultaEjercicios);

      if (!$resultadoRutinaDia) {
        die("Error al obtener la rutina del día.");
      }

      // Verifica si hay algún ejercicio recomendado
      $ejerciciosRecomendados = array();
      while ($filaEjercicio = mysqli_fetch_assoc($resultadoRutinaDia)) {
        $ejerciciosRecomendados[] = $filaEjercicio;
      }

      // Barajar los ejercicios para asignar aleatoriamente
      shuffle($ejerciciosRecomendados);

      // Retorna solo los ejercicios correspondientes al día actual sin repetir
      $rutinaDia = array_slice($ejerciciosRecomendados, 0, min(count($ejerciciosRecomendados), 4));

      // Almacena la rutina del día en la sesión
      $_SESSION['rutina'][$dia] = $rutinaDia;
    }


    return $rutinaDia;

  }
/*
  public function obtenerDia($id_usuario){
    $dias_d = $_SESSION['dias_d'];
    $diaSeleccionado = isset($_GET['dias']); // 1 para Dia 1, 2 para Dia 2, ..., 7 para Dia 7
    $detalleEjercicio = recomendarRutinaPorDia($diaSeleccionado);

    $query = $this->db->query("SELECT dias_d FROM rutinasuser WHERE id_usuario = '$id_usuario' AND dias_d = '$dias_d'");
    if($query){
      for ($i = 1; $i <= $dias_d; $i++) {
        echo "<li><a href='?dia=$i'>" . obtenerNombreDia($i) . "</a></li>";
      }
    }
    
  }*/



  public function obtenerNombreDia($numeroDia) {
    // Obtener el nombre del día según el número (1 para lunes, 2 para martes, ..., 7 para domingo)
    $nombresDias = array('Día 1', 'Día 2', 'Día 3', 'Día 4', 'Día 5', 'Día 6', 'Día 7');
    return $nombresDias[$numeroDia - 1];
  }









  // Eliminar Rutina de la tabla rutinasuser
  public function deleteRutina($id_rutina){
    $query = $this->db->query("DELETE FROM rutinasuser WHERE id_rutina = '$id_rutina'");
    if($query){
      return true; // Si se elimina correctamente, se devuelve true.
    }else{
      return false; // Si no, se devuelve false.
    }
  }















//
  /*
  public function recomendarRutina($nombreRutina, $tipo, $diasDisponibles, $duracion) {
    $query = $this->db->prepare("
        SELECT nombre_ejercicio, descripcion, imagen_url
        FROM TablaRutinas
        WHERE tipo = ? AND duracion = ? AND dias_disponibles = ?
    ");
    $query->execute([$tipo, $diasDisponibles]);
    $ejercicios = $query->fetchAll();

    $rutina = [];
    for ($dia = 1; $dia <= $diasDisponibles; $dia++) {
        $ejercicio = $ejercicios[array_rand($ejercicios)];
        $rutina[] = [
            'dia' => $dia,
            'nombre_ejercicio' => $ejercicio['nombre_ejercicio'],
            'descripcion' => $ejercicio['descripcion'],
            'imagen_url' => $ejercicio['imagen_url']
        ];
    }

    $this->guardarRutina($nombreRutina, $tipo, $rutina, $duracion);
    return $rutina;

    */
















//





 

  public function existeRutina($id_usuario){
    $query = $this->db->query("SELECT * FROM rutinas WHERE id_usuario = '$id_usuario'");

    if($query->num_rows > 0){
      return true;
    } else {
      return false;
    }
  }

  public function getRutinas($id_usuario){
    $query = $this->db->query("SELECT id_usuario, tipo, dias, duracion FROM rutinas WHERE id_usuario = '$id_usuario'");

    while($row = $query->fetch_assoc()) {
      $this->rutinas[] = $row;
    }

    return $this->rutinas;
  }




  /** FUNCIONES DE PRUEBA */



  public function getData($id){
    $query = $this->db->query("SELECT * FROM rutinasuser WHERE id_usuario = '$id'");
    $row = $query->fetch_assoc();
    return $row;
  }

  public function verRutinas(){
    $query = $this->db->query("SELECT * FROM rutinasuser");
    while($row = $query->fetch_assoc()) {
      $this->rutinasuser[] = $row;
    }
    return $this->rutinasuser;
  }

  
  public function insertRutinaUserID(){
    if(isset($_POST)){
      //$id_usuario = $usuario['id_usuario'];
      //echo($_SESSION['usuario']);
      $usuario = $_SESSION['usuario'];
      $id_usuario = $usuario['id_usuario'];
      $query = $this->db->query("INSERT INTO rutinasuser (id_usuario) VALUES('$id_usuario')");

      if($query){
        return true;
      }else{
        return false;
      }
    }
  }
  public function insertRutinaUser(){
    if(isset($_POST)){
      $nombre_rutina = mysqli_real_escape_string($this->db, $_POST['nombre_rutina']);
      $tipo_rutina = mysqli_real_escape_string($this->db, $_POST['tipo_rutina']);
      $dias = mysqli_real_escape_string($this->db, $_POST['dias']);
      $duracion = mysqli_real_escape_string($this->db, $_POST['duracion']);
      $query = $this->db->query("INSERT INTO rutinasuser (nombre_rutina, tipo_rutina, dias, duracion) VALUES('$nombre_rutina', '$tipo_rutina', '$dias', '$duracion')'");

      if($query){
        return true;
      }else{
        return false;
      }
    }
  }


}


















?>