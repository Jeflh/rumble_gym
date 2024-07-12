<?php 

class EmpleadoModel{
  private $db;

  private $id_empleado;
  private $password;
  private $nombre;
  private $apellido_p;
  private $apellido_m;
  private $fecha_nac;
  private $domicilio;
  private $telefono;
  private $tipo;

  private $lista;

  public function __construct(){
    $this->db = Conectar::conexion();
    $this->lista = array();

    $this->id_empleado = 0;
    $this->password = "";
    $this->nombre = "";
    $this->apellido_p = "";
    $this->apellido_m = "";
    $this->fecha_nac = "";
    $this->domicilio = "";
    $this->telefono = "";
    $this->tipo = "";
  }

  public function getAll(){
    $query = $this->db->query("SELECT * FROM empleados ORDER BY id_empleado ASC");

    while($row = $query->fetch_assoc()) {
      $this->lista[] = $row;
    }

    return $this->lista;
  }

  public function getEmpleado($id){
    $query = $this->db->query("SELECT * FROM empleados WHERE id_empleado = '$id'");
    $row = $query->fetch_assoc();

    return $row;
  }

  public function insertEmpleado(){ // Función para insertar un producto.
    if(isset($_POST)){ // mysqli_real_escape_string sirve para evitar inyecciones SQL.
      $this->password = mysqli_real_escape_string($this->db, $_POST['password']);
      $this->nombre = mysqli_real_escape_string($this->db, $_POST['nombre']);      
      $this->apellido_p = mysqli_real_escape_string($this->db, $_POST['apellido_p']);
      $this->apellido_m = mysqli_real_escape_string($this->db, $_POST['apellido_m']);
      $this->fecha_nac = mysqli_real_escape_string($this->db, $_POST['fecha_nac']);
      $this->domicilio = mysqli_real_escape_string($this->db, $_POST['domicilio']);
      $this->telefono = mysqli_real_escape_string($this->db, $_POST['telefono']);
      if(isset($_POST['tipo'])){
        $this->tipo = mysqli_real_escape_string($this->db, $_POST['tipo']);
      } else {
        $this->tipo = "";
      }
      

      $error = ""; // Variable para almacenar los errores.

      if(empty($this->nombre) || is_numeric($this->nombre)){
        $error .= "1";
      }
      if(empty($this->apellido_p) || is_numeric($this->nombre)){
        $error .= "2";
      }
      if(empty($this->apellido_m) || is_numeric($this->nombre)){
        $error .= "3";
      }
      if(empty($this->fecha_nac)){
        $error .= "4";
      }
      if(empty($this->domicilio)){
        $error .= "5";
      }
      if(empty($this->telefono) || strlen($this->telefono) != 10){
        $error .= "6";
      }
      if(empty($this->tipo)){
        $error .= "7";
      }
      if(empty($this->password)){
        $error .= "8";
      }
      
      if($error == ""){ // Si no hay errores, se inserta el producto.
        
        $this->id_empleado = generarId();
        $existe = $this->getEmpleado($this->id_empleado);
        while($existe != null){
          $this->id_empleado = generarId();
          $existe = $this->getEmpleado($this->id_empleado);
        }

        $passwordHash = password_hash($this->password, PASSWORD_BCRYPT);

        if(substr($this->tipo, 0, 1) == '1'){
          $this->tipo = 1;
        } else if(substr($this->tipo, 0, 1) == '2'){
          $this->tipo = 2;
        } else {
          $this->tipo = 3;
        }
          
        $query = $this->db->query("INSERT INTO empleados VALUES('$this->id_empleado', '$passwordHash', '$this->nombre', '$this->apellido_p', '$this->apellido_m', '$this->fecha_nac', '$this->domicilio', '$this->telefono', '$this->tipo')");

        if($query){
          return true;
        }else{
          return false;
        }
      }else{
        header("Location: index.php?c=empleado&a=nuevo&e=" . $error); 
        // Si hay errores, se redirige a la página de nuevo empleado con los errores.
      }
    }
  }

  public function updateEmpleado($id){
    if(isset($_POST)){ // mysqli_real_escape_string sirve para evitar inyecciones SQL.
      $this->id_empleado = mysqli_real_escape_string($this->db, $id);
      $this->password = mysqli_real_escape_string($this->db, $_POST['password']);
      $this->nombre = mysqli_real_escape_string($this->db, $_POST['nombre']);      
      $this->apellido_p = mysqli_real_escape_string($this->db, $_POST['apellido_p']);
      $this->apellido_m = mysqli_real_escape_string($this->db, $_POST['apellido_m']);
      $this->fecha_nac = mysqli_real_escape_string($this->db, $_POST['fecha_nac']);
      $this->domicilio = mysqli_real_escape_string($this->db, $_POST['domicilio']);
      $this->telefono = mysqli_real_escape_string($this->db, $_POST['telefono']);
      if(isset($_POST['tipo'])){
        $this->tipo = mysqli_real_escape_string($this->db, $_POST['tipo']);
      } else {
        $this->tipo = "";
      }
      

      $error = ""; // Variable para almacenar los errores.

      if(empty($this->nombre) || is_numeric($this->nombre)){
        $error .= "1";
      }
      if(empty($this->apellido_p) || is_numeric($this->nombre)){
        $error .= "2";
      }
      if(empty($this->apellido_m) || is_numeric($this->nombre)){
        $error .= "3";
      }
      if(empty($this->fecha_nac)){
        $error .= "4";
      }
      if(empty($this->domicilio)){
        $error .= "5";
      }
      if(empty($this->telefono) || strlen($this->telefono) != 10){
        $error .= "6";
      }
      if(empty($this->tipo)){
        $error .= "7";
      }
      if(empty($this->password)){
        $error .= "8";
      }
      
      if($error == ""){ // Si no hay errores, se inserta el producto.

        $passwordHash = password_hash($this->password, PASSWORD_BCRYPT);

        if(substr($this->tipo, 0, 1) == '1'){
          $this->tipo = 1;
        } else if(substr($this->tipo, 0, 1) == '2'){
          $this->tipo = 2;
        } else {
          $this->tipo = 3;
        }
          
        $query = $this->db->query("UPDATE empleados SET password = '$passwordHash', nombre = '$this->nombre', apellido_p = '$this->apellido_p', apellido_m = '$this->apellido_m', fecha_nac = '$this->fecha_nac', domicilio = '$this->domicilio', telefono = '$this->telefono', tipo = '$this->tipo' WHERE id_empleado = '$this->id_empleado'");

        if($query){
          return true;
        }else{
          return false;
        }
      }else{
        header("Location: index.php?c=empleado&a=editar&id=" . $this->id_empleado ."&e=" . $error); 
        // Si hay errores, se redirige a la página de nuevo empleado con los errores.
      }
    }
  }

  public function deleteEmpleado($id){
    if(isset($_POST)){
      $this->id_empleado = $id;
      $query = $this->db->query("DELETE FROM empleados WHERE id_empleado = '$this->id_empleado'");
      if($query){
        return true;
      }else{
        return false;
      }
    }
  }
}

?>