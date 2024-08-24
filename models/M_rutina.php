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

    for ($i = 1; $i <= 7; $i++) {
      $dia = "dia" . $i;
      if (!empty($rutina[$dia])) {
        $idsEjerciciosDia = explode(',', $rutina[$dia]);
        $idsEjercicios = array_merge($idsEjercicios, array_map('trim', $idsEjerciciosDia));
      }
    }

    $idsEjercicios = array_unique($idsEjercicios);
    $idsEjerciciosStr = implode(',', array_map('intval', $idsEjercicios));

    if (!empty($idsEjerciciosStr)) {
      // Preparamos y ejecutamos la consulta usando mysqli
      $query = "SELECT * FROM rutinas WHERE id_ejercicio IN ($idsEjerciciosStr)";
      $resultado = $this->db->query($query);

      if ($resultado) {
        // Fetch all rows
        while ($ejercicio = $resultado->fetch_assoc()) {
          for ($i = 1; $i <= 7; $i++) {
            $dia = "dia" . $i;
            if (!empty($rutina[$dia]) && in_array($ejercicio['id_ejercicio'], explode(',', $rutina[$dia]))) {
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


  public function generarRutina($id_usuario, $nombre_rutina, $tipo_rutina, $dias, $duracion)
  {
    $this->id_usuario = mysqli_real_escape_string($this->db, $id_usuario);
    $this->nombre_rutina = mysqli_real_escape_string($this->db, $nombre_rutina);
    $this->tipo_rutina = mysqli_real_escape_string($this->db, $tipo_rutina); 
    $this->dias = mysqli_real_escape_string($this->db,$dias); 
    $this->duracion = mysqli_real_escape_string($this->db, $duracion);

    $this->id_rutina = generarId();
    $existe = $this->getRutina($this->id_rutina);
    while ($existe != null) {
      $this->id_rutina = generarId();
      $existe = $this->getRutina($this->id_rutina);
    }

    // Insertar la rutina en la tabla rutinasuser
    $queryInsert = "INSERT INTO rutinasuser (id_usuario, id_rutina, nombre_rutina, tipo_rutina, dias_d, duracion_sesiones) 
                        VALUES ('$this->id_usuario', '$this->id_rutina', '$this->nombre_rutina', '$this->tipo_rutina', '$this->dias', '$this->duracion')";
    $insertResult = $this->db->query($queryInsert);

    if ($insertResult) {
      // Obtener y asignar ejercicios aleatorios a los días de la rutina
      $diasSemana = ['dia1', 'dia2', 'dia3', 'dia4', 'dia5', 'dia6', 'dia7'];
      $updatePairs = [];

      for ($dia = 0; $dia < $dias; $dia++) {
        $ejercicios = $this->obtenerEjerciciosAleatorios($this->tipo_rutina, rand(3, 5));
        $userRutinaDia = implode(',', $ejercicios);
        $updatePairs[] = "{$diasSemana[$dia]} = '$userRutinaDia'";
      }

      $updateQuery = "UPDATE rutinasuser SET " . implode(", ", $updatePairs) . " WHERE id_rutina = '$this->id_rutina'";
      $updateResult = $this->db->query($updateQuery);

      if ($updateResult) {
        header("Location: index.php?c=rutina&a=ver&id=" . $this->id_rutina . "&e=1");
        return true; // Rutina y ejercicios insertados correctamente
      } else {
        header("Location: index.php?c=rutina&a=crear" . $this->id_rutina . "&e=3");
        return false;
      }
    } else {
      header("Location: index.php?c=rutina&a=crear" . $this->id_rutina . "&e=3");
      return false;
    }
  }


  private function obtenerEjerciciosAleatorios($tipo_rutina, $cantidad)
  {
    $query = "SELECT id_ejercicio FROM rutinas WHERE tipo_rutina = '$tipo_rutina' ORDER BY RAND() LIMIT $cantidad";
    $result = $this->db->query($query);

    $ejercicios = [];
    if ($result) {
      while ($fila = $result->fetch_assoc()) {
        $ejercicios[] = $fila['id_ejercicio'];
      }
    } else {
      echo "Error en la consulta de ejercicios: " . $this->db->error;
    }
    return $ejercicios;
  }

}
