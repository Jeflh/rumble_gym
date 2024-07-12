<?php

class EmpleadoController{
  private $auth;
  private $empleadoModel;

  public function __construct(){
    require_once('models/M_empleado.php');
    $this->empleadoModel = new EmpleadoModel();
  }

  public function index(){
    $this->auth = autenticado();
    if(!$this->auth){
      header('Location: index.php?c=login');
    }
    if($_SESSION['usuario']['tipo'] != '1'){
      header('Location: index.php?c=panel');
    }
    $empleados = $this->empleadoModel->getAll();
    require_once('views/empleado/V_inicioEmpleados.php');
  }

  public function nuevo(){
    require_once('views/empleado/V_nuevoEmpleado.php');
  }
  
  public function insertar(){
    if(isset($_POST)){
      $resultado = $this->empleadoModel->insertEmpleado();
      if($resultado){
        header('Location: index.php?c=empleado&e=0');
      }
    }
  }

  public function editar(){
    $id = $_GET['id'];
    $empleado = $this->empleadoModel->getEmpleado($id);
    require_once('views/empleado/V_editarEmpleado.php');
  }

  public function actualizar(){
    if(isset($_POST)){
      $resultado = $this->empleadoModel->updateEmpleado($_POST['id_empleado']);
      if($resultado){
        header('Location: index.php?c=empleado&e=1');
      }
    }
  }

  public function eliminar(){
    $this->empleadoModel->deleteEmpleado($_GET['id']);
    header('Location: index.php?c=empleado&e=2');
  }
}

?>