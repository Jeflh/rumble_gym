<?php
  
class PanelController{
  private $db;
  private $auth;

  public function __construct(){
    $this->db = Conectar::conexion();
    $this->auth = autenticado();

    if(!$this->auth){
      header("Location: index.php?c=login");
    }
  }

  public function index(){
    if(isset($_SESSION['usuario']['tipo'])){
      if($_SESSION['usuario']['tipo'] == 1){
        require_once('views/panel/V_panelAdmin.php');
      }
      else if($_SESSION['usuario']['tipo'] == 2){
        require_once('views/panel/V_panelEmpleado.php');
      } 
      else if($_SESSION['usuario']['tipo'] == 3){
        require_once('views/panel/V_panelEntrenador.php');
      } 
    }
    else if(isset($_SESSION['usuario']['estado'])) {
      require_once('views/panel/V_panelUsuario.php');
    }
    else {
      header("Location: index.php?c=login");
    }
  }

  #public function nuevaRutina(){
  #  if($_SERVER['REQUEST_METHOD'] == 'POST'){
  #    require_once('views/rutinas/V_nuevaRutinas.php');
  #  }
    
  #}

}

?>