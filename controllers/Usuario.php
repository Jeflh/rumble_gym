<?php 

class UsuarioController{
  private $auth;
  private $usuarioModel;
  private $ventaModel;

  public function __construct(){
    $this->auth = autenticado();
    if(!$this->auth){
      header('Location: index.php?c=login');
    }
    if(!isset($_SESSION['usuario']['tipo'])){
      header('Location: index.php?c=panel');
    }
    require_once('models/M_usuario.php');
    require_once('models/M_venta.php');
    $this->usuarioModel = new UsuarioModel();
    $this->ventaModel = new VentaModel();
  }

  public function index(){
    $usuarios = $this->usuarioModel->getAll();
    require_once('views/usuario/V_inicioUsuarios.php');
  }

  public function nuevo(){
    require_once('views/usuario/V_nuevoUsuario.php');
  }

  public function insertar(){
    if(isset($_POST)){

      if(isset($_POST['tipo_suscripcion'])){
        if(substr($_POST['tipo_suscripcion'], 0, 1) == '1'){
          $costo = 300;
        } else if (substr($_POST['tipo_suscripcion'], 0, 1) == '2'){
          $costo = 855;
        } else if (substr($_POST['tipo_suscripcion'], 0, 1) == '3'){
          $costo = 1620;
        } else {
          $costo = 2880;
        }
      } else {
        $costo = 0;
      }

      $datos = array(
        'id_empleado' => $_POST['id_empleado'],
        'fecha_venta' => date('Y-m-d'),
        'monto_venta' => $costo
      );
      
      $resultado = $this->usuarioModel->insertUsuario();
      if($resultado){
        $this->ventaModel->insertSuscripcion($datos);
        header('Location: index.php?c=usuario&e=0');
      }
    }
  }

  public function renovar(){
    if(isset($_GET)){
      $this->usuarioModel->renovarSuscripcion($_GET['id']);

      $datos = array(
        'id_empleado' => $_GET['em'],
        'fecha_venta' => date('Y-m-d'),
        'monto_venta' => $_GET['m']
      );

      $resultado = $this->ventaModel->insertSuscripcion($datos);
      if($resultado){
        header('Location: index.php?c=usuario&e=4');
      }
    }
  }

  public function cambiarEstado(){
    $this->usuarioModel->updateEstado($_GET['id'], $_GET['s']);
    if(isset($_GET['e']) && $_GET['e'] == 1){
      header('Location: index.php?c=bitacora&e=1');
    }else{
    header('Location: index.php?c=usuario&e=3');
    }
  }

  public function editar(){
    $id_usuario = $_GET['id'];
    $usuario = $this->usuarioModel->getUsuario($id_usuario);
    require_once('views/usuario/V_editarUsuario.php');
  }  

  public function actualizar(){
    if(isset($_POST)){
      $resultado = $this->usuarioModel->updateUsuario($_POST['id_usuario']);
      if($resultado){
        header('Location: index.php?c=usuario&e=1');
      }
    }
  }

  public function eliminar(){
    $this->usuarioModel->deleteUsuario($_GET['id']);
    header('Location: index.php?c=usuario&e=2');
  }

  public function buscar(){
    if(isset($_POST)){
      $error = '';

      if(empty($_POST['id']) || !is_numeric($_POST['id']) || strlen($_POST['id']) != 5){ 
        $error .= '5';
      }

      if($error == ''){
        $usuario = $this->usuarioModel->getUsuario($_POST['id']);
        if($usuario){
          require_once('views/usuario/V_usuario.php');
        }else{
          header('Location: index.php?c=usuario&e=6');
        }
      } else {
        header('Location: index.php?c=usuario&e='.$error);
      }
    }
  }

  public function ver(){
    if(isset($_GET['id'])){
      $usuario = $this->usuarioModel->getUsuario($_GET['id']);
      require_once('views/usuario/V_usuario.php');
    }
  }
}

?>