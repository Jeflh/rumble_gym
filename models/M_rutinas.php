<?php

class RutinasModel
{

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

  private $id_dia;



  public function __construct()
  {
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
    $this->duracion = '';
  }


  public function getRutinasUser($id_usuario)
  {
    $query = $this->db->query("SELECT * FROM rutinasuser WHERE id_usuario = '$id_usuario'");

    while ($row = $query->fetch_assoc()) {
      $this->lista[] = $row;
    }
    return $this->lista;
  }

  public function getRutina($id_rutina)
  {
    $query = $this->db->query("SELECT * FROM rutinasuser WHERE id_rutina = '$id_rutina'");
    $row = $query->fetch_assoc();

    return $row;
  }



  // Inserta valores a la tabla rutinasuser
  public function insertRutina()
  {
    if (isset($_POST)) {

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
      if (empty($this->nombre_rutina) || strlen($this->nombre_rutina) > 45) { // Comprobamos que el nombre no esté vacío y que no supere los 50 caracteres.
        $error .= "1";
      }
      if ($error == "") { // Si no hay errores, se inserta el producto.

        $this->id_rutina = generarId();
        $existe = $this->getRutina($this->id_rutina);
        while ($existe != null) {
          $this->id_rutina = generarId();
          $existe = $this->getRutina($this->id_rutina);
        }

        $query  = $this->db->query("INSERT INTO rutinasuser (id_usuario, id_rutina, nombre_rutina, tipo_rutina, dias_d, duracion_sesiones) 
        VALUES ('$this->id_usuario', '$this->id_rutina', '$this->nombre_rutina', '$this->tipo_rutina', '$this->dias', '$this->duracion')");

        if ($query) {
          echo "Rutina insertada correctamente C:";
          return true; // Si se inserta correctamente, se devuelve true.
        } else {
          //echo "Error al insertar la rutina a la base de datos :C " . $this->db->error;
          //echo $this->id_usuario . " " . $this->id_rutina . " " . $this->nombre_rutina . " " . $this->tipo_rutina . " " . $this->dias . " " . $this->duracion . " ";
          return false; // Si no, se devuelve false.
        }
      } else {
        header("Location:index.php?c=rutinas&e=" . $error);
        // Si hay errores, se redirige a la página de nuevo producto con los errores.
      }
    }
  }



 // Tengo entendido que ya no se usa
  public function consultaRutinasUser($usuario)
  {
    $id_usuario = $usuario['id_usuario'];

    $consultaTipoDuracion = "SELECT tipo_rutina, duracion_sesiones FROM rutinasuser WHERE id_usuario = $id_usuario";
    $resultadoTipoDuracion = $this->db->query($consultaTipoDuracion);

    if (!$resultadoTipoDuracion) {
      echo ("Error al obtener la información del usuario.");
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


// *************************************************************************************************************


  public function obtenerNombreDia($numeroDia)
  {
    // Obtener el nombre del día según el número (1 para lunes, 2 para martes, ..., 7 para domingo)
    $nombresDias = array('Día 1', 'Día 2', 'Día 3', 'Día 4', 'Día 5', 'Día 6', 'Día 7');
    return $nombresDias[$numeroDia - 1];
  }



  // Eliminar Rutina de la tabla rutinasuser
  public function deleteRutina($id_rutina)
  {
    $query = $this->db->query("DELETE FROM rutinasuser WHERE id_rutina = '$id_rutina'");
    if ($query) {
      return true; // Si se elimina correctamente, se devuelve true.
    } else {
      return false; // Si no, se devuelve false.
    }
  }








// *************************************************************************************************************


  public function existeRutina($id_usuario)
  {
    $query = $this->db->query("SELECT * FROM rutinas WHERE id_usuario = '$id_usuario'");

    if ($query->num_rows > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function getRutinas($id_usuario)
  {
    $query = $this->db->query("SELECT id_usuario, tipo, dias, duracion FROM rutinas WHERE id_usuario = '$id_usuario'");

    while ($row = $query->fetch_assoc()) {
      $this->rutinas[] = $row;
    }

    return $this->rutinas;
  }




  /** FUNCIONES DE PRUEBA */



  public function getData($id)
  {
    $query = $this->db->query("SELECT * FROM rutinasuser WHERE id_usuario = '$id'");
    $row = $query->fetch_assoc();
    return $row;
  }

  public function verRutinas()
  {
    $query = $this->db->query("SELECT * FROM rutinasuser");
    while ($row = $query->fetch_assoc()) {
      $this->rutinasuser[] = $row;
    }
    return $this->rutinasuser;
  }


  public function insertRutinaUserID()
  {
    if (isset($_POST)) {
      //$id_usuario = $usuario['id_usuario'];
      //echo($_SESSION['usuario']);
      $usuario = $_SESSION['usuario'];
      $id_usuario = $usuario['id_usuario'];
      $query = $this->db->query("INSERT INTO rutinasuser (id_usuario) VALUES('$id_usuario')");

      if ($query) {
        return true;
      } else {
        return false;
      }
    }
  }
  public function insertRutinaUser()
  {
    if (isset($_POST)) {
      $nombre_rutina = mysqli_real_escape_string($this->db, $_POST['nombre_rutina']);
      $tipo_rutina = mysqli_real_escape_string($this->db, $_POST['tipo_rutina']);
      $dias = mysqli_real_escape_string($this->db, $_POST['dias']);
      $duracion = mysqli_real_escape_string($this->db, $_POST['duracion']);
      $query = $this->db->query("INSERT INTO rutinasuser (nombre_rutina, tipo_rutina, dias, duracion) VALUES('$nombre_rutina', '$tipo_rutina', '$dias', '$duracion')'");

      if ($query) {
        return true;
      } else {
        return false;
      }
    }
  }


// *************************************************************************************************************


  // Función para obtener el último dato de la tabla rutinasuser
  public function getUltimoDato($id_usuario)
  {
    $query = $this->db->query("SELECT * FROM rutinasuser WHERE id_usuario = '$id_usuario' ORDER BY created_at DESC LIMIT 1");
    if ($query->num_rows > 0) {
      return $query->fetch_assoc(); // Retorna un único registro
    }
    return null; // Retorna nulo si no hay registros
    if ($query) {
      echo "Busqueda exitosa";
      return true;
    } else {
      echo "Error en la Busqueda: " . $this->db->error; // Añade esta línea para ver el error de la base de datos
      return false;
    }
  }


  // *************************************************************************************************************

  // FUNCIONES PARA EJERCICIOS 
  public function getAllEjercicios(){
    $query = $this->db->query("SELECT * FROM rutinas");
    while ($row = $query->fetch_assoc()) {
      $this->rutinas[] = $row;
    }
    return $this->rutinas;
  }

  public function getIdEjercicio($ejercicio){
    $query = $this->db->query("SELECT * FROM rutinas WHERE id_ejercicio = '$ejercicio'");
    $row = $query->fetch_assoc();

    return $row;
  }




  // *************************************************************************************************************

  


  // *************************************************************************************************************
  /*



  // Método para guardar la rutina generada con ejercicios por día
  /* POR SI ACASO 
  public function guardarRutinaConEjercicios($id_usuario, $tipo_rutina, $dias_d)
  {
    for ($dia = 1; $dia <= $dias_d; $dia++) {
      $cantidadEjercicios = rand(3, 4);
      $ejercicios = $this->obtenerEjerciciosAleatorios($tipo_rutina, $cantidadEjercicios);

      // Convertir el array de ejercicios a una cadena JSON para almacenar en la base de datos
      $ejerciciosJson = json_encode($ejercicios);

      $query = $this->db->prepare("UPDATE rutinasuser SET dia$dia = ? WHERE id_usuario = '$id_usuario'");
      $query->bind_param("s", $ejerciciosJson);
      $query->execute();
    }

    return true;
  }

  // *************************************************************************************************************

  /*
  public function recomendarRutinaPRUEBA_UNO($tipo_rutina ,$dias_d){
    $tipo_rutina = $_SESSION['tipo_rutina'];
    //$consultaEjercicios = "SELECT * FROM rutinas WHERE tipo_rutina = '{$_SESSION['tipo_rutina']}' ORDER BY RAND()";
    $query = $this->db->query("SELECT * FROM rutinas WHERE tipo_rutina = '$tipo_rutina' ORDER BY RAND()");
    if ($query) { // Verificacion y sorteador de ejercicios
      
      // Verificar proceso, sino ejecutar en Rutinas.php
      $ejerciciosRecomendados = array();
      while ($filaEjercicio = mysqli_fetch_assoc($query)) {
        $ejerciciosRecomendados[] = $filaEjercicio['id_ejercicio'];
      }

      // Barajar los ejercicios para asignar aleatoriamente
      shuffle($ejerciciosRecomendados);


      // Retorna solo los ejercicios correspondientes al día actual sin repetir
      $rutinaDia = array_slice($ejerciciosRecomendados, 0, min(count($ejerciciosRecomendados), 4));

    

      // Almacenar la rutina del dia en algun lado XD
      return $rutinaDia;     
   
    } else {
      // Manejar el error si la consulta falla
      echo "Error en la consulta: " . $this->db->error;
      return null;
    }

  
    // Array para almacenar los ID de los ejercicios por día
    $diasSemana = ['dia1', 'dia2', 'dia3', 'dia4', 'dia5', 'dia6', 'dia7']; // Días de la semana en la tabla
    $userRutinaDia = [];   
    

    // Construir la consulta SQL con las columnas y valores
    
    $columns = implode(", ", array_slice($diasSemana, 0, $dias_d));
    $values = implode(", ", array_map(function($id) {
        return "'$id'";
    }, array_values($userRutinaDia)));

    $query = $this->db->query("INSERT INTO rutinasuser ($columns) VALUES ($values)");
    //$query = "INSERT INTO rutinasuser ($columns) VALUES ($values)";
    if ($query) {
    //if ($this->db->query($query)) {
        echo "<p>Rutina guardada correctamente.</p>";
    } else {
        echo "Error al guardar la rutina: " . $this->db->error;
    }

  }
*/

// ALGORITMO DE RECOMENDACION DE RUTINA
public function recomendarRutinaPRUEBA_UNO($tipo_rutina, $dias_d, $id_rutina){
    // Array para almacenar los ID de los ejercicios por día
    $diasSemana = ['dia1', 'dia2', 'dia3', 'dia4', 'dia5', 'dia6', 'dia7'];
    $userRutinaDia = [];

    for ($dia = 0; $dia < $dias_d; $dia++) {
        // Realizar la consulta para seleccionar ejercicios de la tabla 'rutinas'
        $query = $this->db->query("SELECT id_ejercicio FROM rutinas WHERE tipo_rutina = '$tipo_rutina' ORDER BY RAND()");

        if ($query) {
            // Array para almacenar los ejercicios recomendados
            $ejerciciosRecomendados = array();

            // Almacenar los IDs de los ejercicios en un array
            while ($filaEjercicio = mysqli_fetch_assoc($query)) {
                $ejerciciosRecomendados[] = $filaEjercicio['id_ejercicio'];
            }

            // Barajar los ejercicios para seleccionar de forma aleatoria
            shuffle($ejerciciosRecomendados);

            // Seleccionar hasta 4 ejercicios de forma aleatoria
            $rutinaDia = array_slice($ejerciciosRecomendados, 0, min(count($ejerciciosRecomendados), 4));

            // Almacenar los IDs de los ejercicios seleccionados para el día actual
            $userRutinaDia[$diasSemana[$dia]] = implode(',', $rutinaDia);
        } else {
            // Manejar el error si la consulta falla
            echo "Error en la consulta: " . $this->db->error;
            return null;
        }
    }

    // Crear los pares columna = valor para la consulta UPDATE
    $updatePairs = [];
    foreach ($userRutinaDia as $column => $value) {
        $updatePairs[] = "$column = '$value'";
    }
    $updateQuery = implode(", ", $updatePairs);

    // Ejecutar la consulta para actualizar la tabla 'rutinasuser'
    $query = $this->db->query("UPDATE rutinasuser SET $updateQuery WHERE id_rutina = '$id_rutina'");

    if ($query) {
        echo "<p>Rutina guardada correctamente.</p>";
    } else {
        echo "Error al guardar la rutina: " . $this->db->error;
    }
}

public function obtenerDiasPRUEBA_UNO($id_usuario, $id_rutina){
  $query = $this->db->query("SELECT dia1, dia2, dia3, dia4, dia5, dia6, dia7 FROM rutinasuser WHERE id_usuario = '$id_usuario' AND id_rutina = '$id_rutina'");
  if ($query) {
      $resultado = mysqli_fetch_assoc($query);
      $dias = [];
      foreach ($resultado as $dia => $ejercicios) {
          $dias[$dia] = explode(',', $ejercicios);
      }
      return $dias;
      //print_r($dias);
      //echo "<p>Rutina mostrada correctamente?</p>";
      //echo "<p> Rutina: $dias </p>";
  } else {
      echo "Error en la consulta: " . $this->db->error;
  }
}

public function obtenerDiasPRUEBA_DOS($id_usuario, $id_rutina){
  $query = $this->db->query("SELECT dia1, dia2, dia3, dia4, dia5, dia6, dia7 FROM rutinasuser WHERE id_usuario = '$id_usuario' AND id_rutina = '$id_rutina'");
  if ($query) {
    $resultado = mysqli_fetch_assoc($query);
    $dias = []; 
    foreach ($resultado as $dia => $ejercicios) {
        $dias[$dia] = explode(',', $ejercicios);
    }
    return $dias;
    //$row = $query->fetch_assoc();
    //return $row;
  } else {
      echo "Error en la consulta: " . $this->db->error;
  }
}






}
