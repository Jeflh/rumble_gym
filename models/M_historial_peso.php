<?php 

class HistorialPesoModel {
  private $db;

  private $id_usuario;
  private $peso;
  private $fecha;

  private $lista;

  public function __construct() {
    $this->db = Conectar::conexion();
    $this->lista = array();

    $this->id_usuario = 0;
    $this->peso = 0.0;
    $this->fecha = "";
  }

  // Obtener registros por id_usuario
  public function getHistorialByUsuario($id_usuario) {
    $this->id_usuario = mysqli_real_escape_string($this->db, $id_usuario);

    $query = $this->db->query("SELECT * FROM historial_peso WHERE id_usuario = '$this->id_usuario' ORDER BY fecha DESC");

    while ($row = $query->fetch_assoc()) {
      $this->lista[] = $row;
    }

    return $this->lista;
  }

  // Insertar un nuevo registro
  public function insertHistorial($id_usuario, $peso, $fecha) {
    if (empty($id_usuario) || !is_numeric($id_usuario)) {
      throw new Exception("El campo id_usuario es inválido o está vacío", $id_usuario);
    }
    $this->id_usuario = mysqli_real_escape_string($this->db, $id_usuario);
    $this->peso = mysqli_real_escape_string($this->db, $peso);
    $this->fecha = mysqli_real_escape_string($this->db, $fecha);

    $query = $this->db->query("INSERT INTO historial_peso (id_usuario, peso, fecha) 
                               VALUES ('$this->id_usuario', '$this->peso', '$this->fecha')");

    if ($query) {
      return true;
    } else {
      return false;
    }
  }

  // Eliminar registros de un usuario específico
  public function deleteHistorialByUsuario($id_usuario) {
    $this->id_usuario = mysqli_real_escape_string($this->db, $id_usuario);

    $query = $this->db->query("DELETE FROM historial_peso WHERE id_usuario = '$this->id_usuario'");

    if ($query) {
      return true;
    } else {
      return false;
    }
  }

  // Actualizar un registro por su id_historial
  public function updateHistorial($id_historial, $peso, $fecha) {
    $id_historial = mysqli_real_escape_string($this->db, $id_historial);
    $this->peso = mysqli_real_escape_string($this->db, $peso);
    $this->fecha = mysqli_real_escape_string($this->db, $fecha);

    $query = $this->db->query("UPDATE historial_peso 
                               SET peso = '$this->peso', fecha = '$this->fecha' 
                               WHERE id_historial = '$id_historial'");

    if ($query) {
      return true;
    } else {
      return false;
    }
  }
}

?>
