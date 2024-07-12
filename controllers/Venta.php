<?php 

class VentaController{
  private $auth;
  private $ventaModel;
  private $productoModel;
  
  public function __construct(){
    require_once('models/M_venta.php');
    require_once('models/M_producto.php');
    $this->ventaModel = new VentaModel();
    $this->productoModel = new ProductoModel();

    $_SESSION['carrito'] = array();  
  }

  public function index(){
    $this->auth = autenticado();
    if(!$this->auth){
      header('Location: index.php?c=login');
    }
    if(isset($_SESSION['usuario']['tipo'])){
      if($_SESSION['usuario']['tipo'] != '1' && $_SESSION['usuario']['tipo'] != '2'){
        header('Location: index.php?c=panel');
      }
    } else {
      header('Location: index.php?c=panel');
    }
    $empleado = $_SESSION['usuario'];  
    if($_SESSION['productos'] == null){
      $_SESSION['productos'] = $this->productoModel->getAll();
    }
    require_once('views/venta/V_puntoDeVenta.php');
  }

  public function confirmar(){
    if(isset($_POST)){
      foreach($_POST as $key => $value){ 
        // En el servidor por alguna razón solo funciona con == en vez de !=
        if($key != 'id_empleado' && $key != 'fecha_venta' && $key != 'monto_venta'){
          $producto = $this->productoModel->getProducto($value);
          $nuevaCantidad = $producto['cantidad'] - 1;
          $this->productoModel->updateCantidad($value, $nuevaCantidad);
        }
      }
      
      $datos = array(
        'id_empleado' => $_POST['id_empleado'],
        'fecha_venta' => $_POST['fecha_venta'],
        'monto_venta' => $_POST['monto_venta']
      );

      $resultado = $this->ventaModel->insertVenta($datos);

      if($resultado){
        header('Location: index.php?c=venta&e=0');
      }else{
        header('Location: index.php');
      }
    }
  }
}
?>