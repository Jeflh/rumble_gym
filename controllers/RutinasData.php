
<?php
class RutinasDataController{
  private $auth;
  private $rutinaModel;
  private $usuarioModel;

  public function __construct(){
    require_once('models/M_rutinas.php');
    require_once('models/M_usuario.php');
    $this->rutinaModel = new RutinasModel();
    $this->usuarioModel = new UsuarioModel();
  }

  public function index(){
    $this->auth = autenticado();
    $usuarios = $this->usuarioModel->getAll();
    //$fechaActual = date('Y-m-d');
    //$fechaCorte = date('Y-m-d', strtotime($fechaActual . ' - 1 month'));

    foreach($usuarios as $usuario){//por cada uno de estos hacer un foreach
      $userRutinas = $this->rutinaModel->getRutinasUser($usuario['id_usuario']);
    }
    
    $sumaAsistencia = 0;

    foreach($usuarios as $usuario){
      foreach($userRutinas as $userRutina){
        if($usuario['id_usuario'] == $userRutina['id_usuario']){

          if($userRutina['estado'] == '1'){
            $sumaAsistencia++;
          }
        }
      }
      $lista [] = array(
        'id_usuario' => $usuario['id_usuario'],
        'nombreRutina' => $userRutinas['nombre_rutina'],
        'tipoRutina' => $userRutinas['tipo_rutina'],
        'dias_d' => $userRutinas['dias_d'],
        'duracion' => $userRutinas['duracion']
      );
      $sumaAsistencia = 0;
    }

    //require_once('views/bitacora/V_bitacoraDeIngreso.php');
  }
}
  

    
?>