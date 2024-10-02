<?php

class RutinaModel
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

  public function getEjerciciosRutina($rutina)
  {
    $ejercicios = [];
    $idsEjercicios = [];

    // Recopilar todos los IDs de ejercicios de los días
    for ($i = 1; $i <= 7; $i++) {
      $dia = "dia" . $i;
      if (!empty($rutina[$dia])) {
        $idsEjerciciosDia = explode(',', $rutina[$dia]);
        $idsEjercicios = array_merge($idsEjercicios, array_map('trim', $idsEjerciciosDia));
      }
    }

    // Eliminar duplicados
    $idsEjercicios = array_unique($idsEjercicios);
    $idsEjerciciosStr = implode(',', array_map('intval', $idsEjercicios));

    if (!empty($idsEjerciciosStr)) {
      // Preparar y ejecutar la consulta para obtener ejercicios de la tabla de ejercicios
      $query = "SELECT * FROM ejercicios WHERE id IN ($idsEjerciciosStr)";
      $resultado = $this->db->query($query);

      if ($resultado) {
        // Fetch all rows
        while ($ejercicio = $resultado->fetch_assoc()) {
          for ($i = 1; $i <= 7; $i++) {
            $dia = "dia" . $i;
            if (!empty($rutina[$dia]) && in_array($ejercicio['id'], explode(',', $rutina[$dia]))) {
              $ejercicios[$dia][] = $ejercicio; 
            }
          }
        }
      } else {
        echo 'Error en la consulta: ' . $this->db->error; 
      }
    }

    return $ejercicios; 
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


  public function existeRutina($id_usuario)
  {
    $query = $this->db->query("SELECT * FROM rutinas WHERE id_usuario = '$id_usuario'");

    if ($query->num_rows > 0) {
      return true;
    } else {
      return false;
    }
  }


  public function getIdEjercicio($ejercicio)
  {
    $query = $this->db->query("SELECT * FROM rutinas WHERE id_ejercicio = '$ejercicio'");
    $row = $query->fetch_assoc();

    return $row;
  }

  public function insertarRutina($usuario, $response)
  {
    // Suponiendo que $response es un array con los datos necesarios
    $this->id_usuario = mysqli_real_escape_string($this->db, $usuario);
    $this->id_rutina = generarId();

    // Verificar si el ID de rutina ya existe
    $existe = $this->getRutina($this->id_rutina);
    while ($existe != null) {
      $this->id_rutina = generarId();
      $existe = $this->getRutina($this->id_rutina);
    }

    // Extraer información del microservicio
    $this->nombre_rutina = mysqli_real_escape_string($this->db, $response['nombre_rutina']);
    $this->tipo_rutina = mysqli_real_escape_string($this->db, $response['tipo_rutina']);
    $this->dias = mysqli_real_escape_string($this->db, $response['dias']);
    $this->duracion = mysqli_real_escape_string($this->db, $response['duracion']);

    // Insertar la rutina en la tabla rutinasuser
    $queryInsert = "INSERT INTO rutinasuser (id_usuario, id_rutina, nombre_rutina, tipo_rutina, dias_d, duracion_sesiones) 
                    VALUES ('$this->id_usuario', '$this->id_rutina', '$this->nombre_rutina', '$this->tipo_rutina', '$this->dias', '$this->duracion')";

    $insertResult = $this->db->query($queryInsert);

    if ($insertResult) {
      // Insertar los ejercicios para cada día de la rutina
      $diasRutina = $response['rutina']; // Obtenemos el objeto 'rutina' del response

      $updatePairs = [];

      // Insertar ejercicios en las columnas correspondientes
      for ($dia = 1; $dia <= $this->dias; $dia++) {
        $diaKey = "dia" . $dia; // Crear la clave de columna (dia1, dia2, etc.)
        if (isset($diasRutina[$diaKey])) { // Verificar si existe el día
          $userRutinaDia = implode(',', array_map('intval', $diasRutina[$diaKey])); // Convertir a string y asegurarnos de que son enteros
          $updatePairs[] = "$diaKey = '$userRutinaDia'"; // Construir pares para la actualización
        }
      }

      // Actualizar la tabla rutinasuser con los ejercicios para cada día
      $updateQuery = "UPDATE rutinasuser SET " . implode(", ", $updatePairs) . " WHERE id_rutina = '$this->id_rutina'";
      $this->db->query($updateQuery);

      return $this->id_rutina;
    } else {
      // Manejar el error en caso de que la inserción falle
      header("Location: index.php?c=rutina&a=crear&e=3");
      return false;
    }
  }
}
