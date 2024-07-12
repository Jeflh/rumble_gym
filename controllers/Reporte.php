<?php 

class ReporteController{
  private $auth;
  private $ventaModel;
  
  public function __construct(){
    require_once('models/M_venta.php');
    $this->ventaModel = new VentaModel();
  }

  public function index(){
    $this->auth = autenticado();
    if(!$this->auth){
      header('Location: index.php?c=login');
    }
    if(isset($_SESSION['usuario']['tipo'])){
      if($_SESSION['usuario']['tipo'] != '1'){
        header('Location: index.php?c=panel');
      }
    } else {
      header('Location: index.php?c=panel');
    }

    $fechaActual = date('Y-m-d');
    $fechaCorte = date('Y-m-d', strtotime($fechaActual . ' - 1 month'));
    
    $listaVentas = $this->ventaModel->getVentas($fechaCorte, $fechaActual);

    require_once('views/venta/V_reporteFinanciero.php');
  }
}
?>