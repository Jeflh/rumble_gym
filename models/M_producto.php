<?php 

class ProductoModel{
  private $db;

  private $id_producto;
  private $nombre;
  private $descripcion;
  private $cantidad;
  private $precio;

  private $lista;

  public function __construct(){
    $this->db = Conectar::conexion();
    $this->lista = array();

    $this->id_producto = 0;
    $this->nombre = "";
    $this->descripcion = "";
    $this->cantidad = "";
    $this->precio = "";
  }

  public function getAll(){
    $query = $this->db->query("SELECT * FROM productos ORDER BY nombre ASC");

    while($row = $query->fetch_assoc()) {
      $this->lista[] = $row;
    }

    return $this->lista;
  }

  public function getProducto($id){
    $query = $this->db->query("SELECT * FROM productos WHERE id_producto = '$id'");
    $row = $query->fetch_assoc();

    return $row;
  }

  public function insertProducto(){ // Función para insertar un producto.
    if(isset($_POST)){ // mysqli_real_escape_string sirve para evitar inyecciones SQL. 
      $this->nombre = mysqli_real_escape_string($this->db, $_POST['nombre']); 
      $this->descripcion = mysqli_real_escape_string($this->db, $_POST['descripcion']);
      $this->cantidad = mysqli_real_escape_string($this->db, $_POST['cantidad']);
      $this->precio = mysqli_real_escape_string($this->db, $_POST['precio']);

      $error = ""; // Variable para almacenar los errores.

      if(empty($this->nombre) || strlen($this->nombre) > 45){ // Comprobamos que el nombre no esté vacío y que no supere los 50 caracteres.
        $error .= "1";
      }
      if(empty($this->cantidad)){
        $error .= "2";
      }
      if(empty($this->precio)){
        $error .= "3";
      }
      if(empty($this->descripcion) || strlen($this->descripcion) > 200){
        $error .= "4";
      }

      if($error == ""){ // Si no hay errores, se inserta el producto.

        $this->id_producto = generarId();
        $existe = $this->getProducto($this->id_producto);
        while($existe != null){
          $this->id_producto = generarId();
          $existe = $this->getProducto($this->id_producto);
        }

        $query = $this->db->query("INSERT INTO productos VALUES('$this->id_producto', '$this->nombre', '$this->descripcion', '$this->cantidad', '$this->precio')");

        if($query){
          return true; // Si se inserta correctamente, se devuelve true.
        }
        else{
          return false; // Si no, se devuelve false.
        }
      }else{
        header("Location: index.php?c=producto&a=nuevo&e=" . $error); 
        // Si hay errores, se redirige a la página de nuevo producto con los errores.
      }
    }
  }

  public function deleteProducto($id){ // Función para eliminar un producto.
    $query = $this->db->query("DELETE FROM productos WHERE id_producto = '$id'");

    if($query){
      return true; // Si se elimina correctamente, se devuelve true.
    }else{
      return false; // Si no, se devuelve false.
    }
  }

  public function updateProducto($id){ // Función para editar un producto.
    if(isset($_POST)){ // mysqli_real_escape_string sirve para evitar inyecciones SQL.
      $this->id_producto = mysqli_real_escape_string($this->db, $id);
      $this->nombre = mysqli_real_escape_string($this->db, $_POST['nombre']);
      $this->descripcion = mysqli_real_escape_string($this->db, $_POST['descripcion']);
      $this->cantidad = mysqli_real_escape_string($this->db, $_POST['cantidad']);
      $this->precio = mysqli_real_escape_string($this->db, $_POST['precio']);

      $error = ""; // Variable para almacenar los errores.

      if(empty($this->nombre) || strlen($this->nombre) > 45){ // Comprobamos que el nombre no esté vacío y que no supere los 50 caracteres.
        $error .= "1";
      }
      if(empty($this->cantidad)){
        $error .= "2";
      }
      if(empty($this->precio)){
        $error .= "3";
      }
      if(empty($this->descripcion) || strlen($this->descripcion) > 200){
        $error .= "4";
      }

      if($error == ""){ // Si no hay errores, se edita el producto.
        $query = $this->db->query("UPDATE productos SET nombre = '$this->nombre', descripcion = '$this->descripcion', cantidad = '$this->cantidad', precio = '$this->precio' WHERE id_producto = '$this->id_producto'");

        if($query){
          return true; // Si se edita correctamente, se devuelve true.
        }
        else{
          return false; // Si no, se devuelve false.
        }
      }else{
        header("Location: index.php?c=producto&a=editar&id=" . $this->id_producto . "&e=" . $error); 
        // Si hay errores, se redirige a la página de editar producto con los errores.
      }
    }
  }
  
  public function updateCantidad($id_producto, $cantidad){
    $query = $this->db->query("UPDATE productos SET cantidad = '$cantidad' WHERE id_producto = '$id_producto'");

    if($query){
      return true; // Si se edita correctamente, se devuelve true.
    }
    else{
      return false; // Si no, se devuelve false.
    }
  }
}

?>