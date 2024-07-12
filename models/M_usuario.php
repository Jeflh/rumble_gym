<?php

class UsuarioModel{
  private $db;

  private $id_usuario;
  private $nombre;
  private $apellido_p;
  private $apellido_m;
  private $sexo;
  private $fecha_nac;
  private $peso;
  private $altura;
  private $imc;
  private $domicilio;
  private $telefono;
  private $tipo_suscripcion;
  private $fecha_inicio;
  private $fecha_fin;
  private $inscrito;

  private $listaUsuarios;

  public function __construct(){
    $this->db = Conectar::conexion();
  }

  public function getAll(){
    $query = $this->db->query("SELECT * FROM usuarios ORDER BY estado DESC");

    while($row = $query->fetch_assoc()) {
      $this->listaUsuarios[] = $row;
    }

    return $this->listaUsuarios;
  }

  public function getUsuario($id){
    $query = $this->db->query("SELECT * FROM usuarios WHERE id_usuario = '$id'");
    $row = $query->fetch_assoc();

    return $row;
  }

  public function insertUsuario(){
    if(isset($_POST)){
      $this->nombre = mysqli_real_escape_string($this->db, $_POST['nombre']);
      $this->apellido_p = mysqli_real_escape_string($this->db, $_POST['apellido_p']);
      $this->apellido_m = mysqli_real_escape_string($this->db, $_POST['apellido_m']);
      if(isset($_POST['sexo'])){
        $this->sexo = mysqli_real_escape_string($this->db, $_POST['sexo']);
      } else {
        $this->sexo = '';
      }
      $this->fecha_nac = mysqli_real_escape_string($this->db, $_POST['fecha_nac']);
      $this->peso = mysqli_real_escape_string($this->db, $_POST['peso']);
      $this->altura = mysqli_real_escape_string($this->db, $_POST['altura']);
      $this->domicilio = mysqli_real_escape_string($this->db, $_POST['domicilio']);
      $this->telefono = mysqli_real_escape_string($this->db, $_POST['telefono']);
      if(isset($_POST['tipo_suscripcion'])){
        $this->tipo_suscripcion = mysqli_real_escape_string($this->db, $_POST['tipo_suscripcion']);
      } else {
        $this->tipo_suscripcion = '';
      }
      $this->fecha_inicio = date('Y-m-d');

      $error = '';

      if(empty($this->nombre) || is_numeric($this->nombre)){
        $error .= '0';
      }
      if(empty($this->apellido_p) || is_numeric($this->apellido_p)){
        $error .= '1';
      }
      if(empty($this->apellido_m) || is_numeric($this->apellido_m)){
        $error .= '2';
      }
      if(empty($this->sexo)){
        $error .= '3';
      }
      if(empty($this->fecha_nac)){
        $error .= '4';
      }
      if(empty($this->peso) || !is_numeric($this->peso)){
        $error .= '5';
      }
      if(empty($this->altura) || !is_numeric($this->altura)){
        $error .= '6';
      }
      if(empty($this->domicilio)){
        $error .= '7';
      }
      if(empty($this->telefono) || !is_numeric($this->telefono) || strlen($this->telefono) != 10){
        $error .= '8';
      }
      if(empty($this->tipo_suscripcion)){
        $error .= '9';
      }

      if($error == ''){
        
        $this->id_usuario = generarId();
        $existe = $this->getUsuario($this->id_usuario);
        while($existe != null){
          $this->id_usuario = generarId();
          $existe = $this->getUsuario($this->id_usuario);
        }

        if(substr($this->sexo, 0, 1) == 'M'){
          $this->sexo = 'M';
        } else {
          $this->sexo = 'F';
        }

        $this->imc = $this->peso / ($this->altura * $this->altura);

        if(substr($this->tipo_suscripcion, 0, 1) == '1'){
          $this->tipo_suscripcion = 1;
          $this->fecha_fin = date('Y-m-d', strtotime('+1 month'));
        } else if (substr($this->tipo_suscripcion, 0, 1) == '2'){
          $this->tipo_suscripcion = 2;
          $this->fecha_fin = date('Y-m-d', strtotime('+3 month'));
        } else if (substr($this->tipo_suscripcion, 0, 1) == '3'){
          $this->tipo_suscripcion = 3;
          $this->fecha_fin = date('Y-m-d', strtotime('+6 month'));
        } else {
          $this->tipo_suscripcion = 4;
          $this->fecha_fin = date('Y-m-d', strtotime('+1 year'));
        }
        
        $this->inscrito = date('Y-m-d');

        $query = $this->db->query("INSERT INTO usuarios VALUES ('$this->id_usuario', '$this->nombre', '$this->apellido_p', '$this->apellido_m', '$this->sexo', '$this->fecha_nac', '$this->peso', '$this->altura', '$this->imc', '$this->domicilio', '$this->telefono', '1', '$this->tipo_suscripcion', '$this->fecha_inicio', '$this->fecha_fin', '$this->inscrito')");

        if($query){
          return true;
        }else{
          return false;
        }
      } else {
        header('Location: index.php?c=usuario&a=nuevo&e='.$error);
      }
    }
  }

  public function renovarSuscripcion($id_usuario){
    $this->id_usuario = $id_usuario;
    $usuario = $this->getUsuario($this->id_usuario);
    $this->tipo_suscripcion = $usuario['tipo_suscripcion'];
    $this->fecha_inicio = date('Y-m-d');
    if($this->tipo_suscripcion == 1){
      $this->fecha_fin = date('Y-m-d', strtotime('+1 month'));
    } else if ($this->tipo_suscripcion == 2){
      $this->fecha_fin = date('Y-m-d', strtotime('+3 month'));
    } else if ($this->tipo_suscripcion == 3){
      $this->fecha_fin = date('Y-m-d', strtotime('+6 month'));
    } else {
      $this->fecha_fin = date('Y-m-d', strtotime('+1 year'));
    }

    $query = $this->db->query("UPDATE usuarios SET fecha_inicio = '$this->fecha_inicio', fecha_fin = '$this->fecha_fin' WHERE id_usuario = '$this->id_usuario'");

    if($query){
      return true;
    } else {
      return false;
    }
  }

  public function updateUsuario($id_usuario){
    if(isset($_POST)){
      $this->id_usuario = mysqli_real_escape_string($this->db, $id_usuario);
      $this->nombre = mysqli_real_escape_string($this->db, $_POST['nombre']);
      $this->apellido_p = mysqli_real_escape_string($this->db, $_POST['apellido_p']);
      $this->apellido_m = mysqli_real_escape_string($this->db, $_POST['apellido_m']);
      if(isset($_POST['sexo'])){
        $this->sexo = mysqli_real_escape_string($this->db, $_POST['sexo']);
      } else {
        $this->sexo = '';
      }
      $this->fecha_nac = mysqli_real_escape_string($this->db, $_POST['fecha_nac']);
      $this->peso = mysqli_real_escape_string($this->db, $_POST['peso']);
      $this->altura = mysqli_real_escape_string($this->db, $_POST['altura']);
      $this->domicilio = mysqli_real_escape_string($this->db, $_POST['domicilio']);
      $this->telefono = mysqli_real_escape_string($this->db, $_POST['telefono']);
      if(isset($_POST['tipo_suscripcion'])){
        $this->tipo_suscripcion = mysqli_real_escape_string($this->db, $_POST['tipo_suscripcion']);
      } else {
        $this->tipo_suscripcion = '';
      }

      $error = '';

      if(empty($this->nombre) || is_numeric($this->nombre)){
        $error .= '0';
      }
      if(empty($this->apellido_p) || is_numeric($this->apellido_p)){
        $error .= '1';
      }
      if(empty($this->apellido_m) || is_numeric($this->apellido_m)){
        $error .= '2';
      }
      if(empty($this->sexo)){
        $error .= '3';
      }
      if(empty($this->fecha_nac)){
        $error .= '4';
      }
      if(empty($this->peso) || !is_numeric($this->peso)){
        $error .= '5';
      }
      if(empty($this->altura) || !is_numeric($this->altura)){
        $error .= '6';
      }
      if(empty($this->domicilio)){
        $error .= '7';
      }
      if(empty($this->telefono) || !is_numeric($this->telefono) || strlen($this->telefono) != 10){
        $error .= '8';
      }
      if(empty($this->tipo_suscripcion)){
        $error .= '9';
      }

      if($error == ''){

        if(substr($this->sexo, 0, 1) == 'M'){
          $this->sexo = 'M';
        } else {
          $this->sexo = 'F';
        }

        $this->imc = $this->peso / ($this->altura * $this->altura);

        if(substr($this->tipo_suscripcion, 0, 1) == '1'){
          $this->tipo_suscripcion = 1;
        } else if (substr($this->tipo_suscripcion, 0, 1) == '2'){
          $this->tipo_suscripcion = 2;
        } else if (substr($this->tipo_suscripcion, 0, 1) == '3'){
          $this->tipo_suscripcion = 3;
        } else {
          $this->tipo_suscripcion = 4;
        }

        $query = $this->db->query("UPDATE usuarios SET nombre = '$this->nombre', apellido_p = '$this->apellido_p', apellido_m = '$this->apellido_m', sexo = '$this->sexo', fecha_nac = '$this->fecha_nac', peso = '$this->peso', altura = '$this->altura', imc = '$this->imc', domicilio = '$this->domicilio', telefono = '$this->telefono', tipo_suscripcion = '$this->tipo_suscripcion' WHERE id_usuario = '$this->id_usuario'");

        if($query){
          return true;
        }else{
          return false;
        }
      } else {
        header('Location: index.php?c=usuario&a=editar&e='.$error);
      }
    }
  }

  public function updateEstado($id_usuario, $estado){
    if(isset($_POST)){
      if($estado == '1'){
        $estado = '0';
      } else {
        $estado = '1';
      }
      $query = $this->db->query("UPDATE usuarios SET estado = '$estado' WHERE id_usuario = '$id_usuario'");
    }
  }

  public function deleteUsuario($id_usuario){
    if(isset($_POST)){
      $this->id_usuario = $id_usuario;
      $query = $this->db->query("DELETE FROM usuarios WHERE id_usuario = '$this->id_usuario'");
      if($query){
        return true;
      }else{
        return false;
      }
    }
  }
}

?>