<?php

class BitacoraController{
  private $auth;
  private $asistenciaModel;
  private $usuarioModel;

  public function __construct(){
    require_once('models/M_asistencia.php');
    require_once('models/M_usuario.php');
    $this->asistenciaModel = new AsistenciaModel();
    $this->usuarioModel = new UsuarioModel();
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
    
    $usuarios = $this->usuarioModel->getAll();
    $fechaActual = date('Y-m-d');
    $fechaCorte = date('Y-m-d', strtotime($fechaActual . ' - 1 month'));

    foreach($usuarios as $usuario){//por cada uno de estos hacer un foreach
      $asistencias = $this->asistenciaModel->getAsistencias($usuario['id_usuario'], $fechaCorte, $fechaActual );
    }
    
    $sumaAsistencia = 0;

    foreach($usuarios as $usuario){
      foreach($asistencias as $asistencia){
        if($usuario['id_usuario'] == $asistencia['id_usuario']){
          if($asistencia['estado'] == '1'){
            $sumaAsistencia++;
          }
        }
      }
      $lista [] = array(
        'id_usuario' => $usuario['id_usuario'],
        'asistencia' => round($sumaAsistencia / 30 * 100, 2)
      );
      $sumaAsistencia = 0;
    }

    require_once('views/bitacora/V_bitacoraDeIngreso.php');
  }
}
?>