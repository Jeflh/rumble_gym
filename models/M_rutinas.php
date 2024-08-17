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



/*

  public function recomendarRutinaDia($usuario, $dia)
  {
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
  public function getAllEjercicios()
  {
    $query = $this->db->query("SELECT * FROM rutinas");
    while ($row = $query->fetch_assoc()) {
      $this->rutinas[] = $row;
    }
    return $this->rutinas;
  }



  /*
  public function guardarRutinaConBloques($id_usuario, $nombre_rutina, $tipo_rutina, $dias_d, $duracion) {
    // Generar aleatoriamente el número de bloques para cada día
    $bloquesPorDia = [];
    for ($i = 1; $i <= $dias_d; $i++) {
        $bloquesPorDia[$i] = rand(3, 4);  // Generar 3 o 4 bloques por día
    }

    // Construir el query para guardar la rutina con los bloques generados
    $query = "INSERT INTO rutinasuser (id_usuario, nombre_rutina, tipo_rutina, dias_d, duracion, dia1, dia2, dia3, dia4, dia5, dia6, dia7) VALUES ('$id_usuario', '$nombre_rutina', '$tipo_rutina', '$dias_d', '$duracion',";

    // Añadir los valores de los bloques por día al query
    for ($i = 1; $i <= 7; $i++) {
        $query .= isset($bloquesPorDia[$i]) ? $bloquesPorDia[$i] : "0";
        $query .= ($i < 7) ? ", " : ")";
    }

    // Ejecutar el query
    $this->db->query($query);
  }
    */

  // Función para obtener la configuración de bloques ya guardada para un usuario
  public function obtenerRutinaConBloques($id_usuario)
  {
    $query = "SELECT * FROM rutinasuser WHERE id_usuario = '$id_usuario' ORDER BY created_at DESC LIMIT 1";
    $result = $this->db->query($query);
    return $result->fetch_assoc();
  }



  // *************************************************************************************************************
  public function guardarRutinaConBloques($id_usuario, $nombre_rutina, $tipo_rutina, $dias_d, $duracion)
  {
    $bloquesPorDia = $this->generarBloquesPorDia($dias_d);

    $query = "INSERT INTO rutinasuser (id_usuario, nombre_rutina, tipo_rutina, dias_d, duracion, dia1, dia2, dia3, dia4, dia5, dia6, dia7) VALUES ('$id_usuario', '$nombre_rutina', '$tipo_rutina', '$dias_d', '$duracion', '{$bloquesPorDia['dia1']}', '{$bloquesPorDia['dia2']}', '{$bloquesPorDia['dia3']}', '{$bloquesPorDia['dia4']}', '{$bloquesPorDia['dia5']}', '{$bloquesPorDia['dia6']}', '{$bloquesPorDia['dia7']}')";

    return $this->db->query($query);
  }

  public function getRutinaConBloques($id_usuario)
  {
    $query = "SELECT * FROM rutinasuser WHERE id_usuario = '$id_usuario' ORDER BY id_rutina DESC LIMIT 1";
    $result = $this->db->query($query);

    return $result->fetch_assoc();
  }

  public function generarBloquesPorDia($dias_d)
  {
    $bloquesPorDia = [];
    for ($i = 1; $i <= $dias_d; $i++) {
      $bloquesPorDia["dia$i"] = rand(3, 4); // Generar aleatoriamente 3 o 4 bloques
    }
    return $bloquesPorDia;
  }



  // *************************************************************************************************************
  /*

  // Método para obtener ejercicios aleatorios por tipo
  public function obtenerEjerciciosAleatorios($tipo_rutina, $cantidad) {
    $query = $this->db->prepare("SELECT id_ejercicio FROM rutinas WHERE tipo_rutina = ? ORDER BY RAND() LIMIT ?");
    $query->bind_param("si", $tipo_rutina, $cantidad);
    $query->execute();
    $result = $query->get_result();
    $ejercicios = [];
    while ($row = $result->fetch_assoc()) {
        $ejercicios[] = $row['id_ejercicio'];
    }
    return $ejercicios;
  }

  // Método para guardar la rutina generada con ejercicios por día
  public function guardarRutinaConEjercicios($usuarioId, $tipo_rutina, $dias_d) {
      for ($dia = 1; $dia <= $dias_d; $dia++) {
          $cantidadEjercicios = rand(3, 4);
          $ejercicios = $this->obtenerEjerciciosAleatorios($tipo_rutina, $cantidadEjercicios);

          // Convertir el array de ejercicios a una cadena JSON para almacenar en la base de datos
          $ejerciciosJson = json_encode($ejercicios);

          $query = $this->db->prepare("UPDATE rutinasuser SET dia$dia = ? WHERE id_usuario = ?");
          $query->bind_param("si", $ejerciciosJson, $usuarioId);
          $query->execute();
      }
  }


  
  */
  /* POR SI ACASO
  public function obtenerEjerciciosAleatorios($tipo_rutina, $cantidad)
  {
    $query = $this->db->prepare("SELECT id_ejercicio FROM rutinas WHERE tipo_rutina = ? ORDER BY RAND() LIMIT ?");
    $query->bind_param("si", $tipo_rutina, $cantidad);
    $query->execute();
    $result = $query->get_result();
    $ejercicios = [];
    while ($row = $result->fetch_assoc()) {
      $ejercicios[] = $row['id_ejercicio'];
    }
    return $ejercicios;
  }

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


public function recomendarRutinaPRUEBA_UNO($tipo_rutina, $dias_d)
{
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
    $query = $this->db->query("UPDATE rutinasuser SET $updateQuery WHERE id_rutina = '18839'");

    if ($query) {
        echo "<p>Rutina guardada correctamente.</p>";
    } else {
        echo "Error al guardar la rutina: " . $this->db->error;
    }
}







/* POR SI ACASO
  public function seleccionarEjerciciosAleatorios($tipo_rutina, $cantidad)
  {
    $tipo_rutina = $_SESSION['tipo_rutina'];

    $stmt =  $this->db->prepare("SELECT id_ejercicio FROM rutinas WHERE tipo_rutina = $tipo_rutina ORDER BY RAND() LIMIT ?");
    $stmt->bind_param("i", $cantidad);
    $stmt->execute();
    $result = $stmt->get_result();

    $ejercicios = [];
    while ($row = $result->fetch_assoc()) {
      $ejercicios[] = $row['id_ejercicio'];
    }
    return $ejercicios;
  }
  /*
  public function crearRutinaUsuario($usuarioId, $tipo_rutina, $dias_d) {
    
    // Array para almacenar los ID de los ejercicios por día
    $dias = ['dia1', 'dia2', 'dia3', 'dia4', 'dia5', 'dia6', 'dia7'];

    // Preparar la consulta para actualizar la tabla rutinasuser
    $sql = "UPDATE rutinasuser SET ";
    for ($i = 0; $i < $dias_d; $i++) {
        $cantidadEjercicios = rand(3, 4); // Seleccionar entre 3 y 4 ejercicios
        $ejerciciosSeleccionados = seleccionarEjerciciosAleatorios($tipo_rutina, $cantidadEjercicios);

        // Convertir el array de ejercicios en una cadena de texto
        $ejerciciosStr = implode(',', $ejerciciosSeleccionados);
        $sql .= "{$dias[$i]} = '{$ejerciciosStr}'";

        if ($i < $dias_d - 1) {
            $sql .= ", ";
        }
    }

    $sql .= " WHERE id_usuario = ?";
    $stmt = $dbConnection->prepare($sql);
    $stmt->bind_param("i", $usuarioId);
    $stmt->execute();
  }*/




  /*
    for ($dia = 1; $dia <= 7; $dia++) {
        $ejercicios = $this->obtenerEjerciciosAleatorios($_SESSION['tipo_rutina'], rand(3, 4));
        $userRutinaDia[$diasSemana[$dia - 1]] = $ejercicios;
    }*/
  //$rutinaDia = json_encode($rutinaDia); // Convertir a JSON

  // Generar un ID único para la rutina
  /*$this->id_dia = generarId();
    $existe = $this->getRutina($this->id_dia);
    while($existe != null){
      $this->id_dia = generarId();
      $existe = $this->getRutina($this->id_dia);
    }

    $userRutinaDia[$diasSemana[0]] = $this->id_dia;
    /*for ($i = 0; $i < count($dias_d); $i++) {
      $id_ejercicio = $rutinaDia[$i]['id_ejercicio'];
      $nombre_ejercicio = $rutinaDia[$i]['nombre_ejercicio'];
      $descripcion = $rutinaDia[$i]['descripcion'];
      $imagen_url = $rutinaDia[$i]['imagen_url'];
      $query = $this->db->query("INSERT INTO rutinas (id_dia, id_ejercicio, nombre_ejercicio, descripcion, imagen_url) VALUES ('$id_diaUNO', '$id_ejercicio', '$nombre_ejercicio', '$descripcion', '$imagen_url')");
    }
    for ($i = 0; $i < $dias_d; $i++) {
      $query = $this->db->query("INSERT INTO rutinasuser ($diasSemana) VALUES ('$id_diaUNO')");
      $id_diaUNO = +1;
      
    }*/
  /*for ($i = 1; $i < $dias_d; $i++) {
      $this->id_dia += 1; // Incrementar el ID para ser consecutivo
      $userRutinaDia[$diasSemana[$i]] = $this->id_dia;
    }*/
}
