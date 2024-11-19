<?php 

class AsistenciaController{
  private $auth;
  private $listaInterna;
  private $historialModel;

  public function __construct(){
    $this->auth = autenticado();
    if(!$this->auth){
      header('Location: index.php');
    }
    require_once('models/M_asistencia.php');
    require_once('models/M_usuario.php');
    require_once('models/M_historial_peso.php');

    $usuarios = new UsuarioModel();
    $this->historialModel = new HistorialPesoModel();
    $this->listaInterna = $usuarios->getAll();
  }
  
  public function guardar(){
    if(isset($_POST)){
      $asistencia = new AsistenciaModel();
      $existe = $asistencia->existeDia($_POST['fecha']);

      if(!$existe){
        for($i = 0; $i < count($this->listaInterna); $i++){
          $asistenciaInicial [$i] = array(
            'id_usuario' => $this->listaInterna[$i]['id_usuario'],
            'fecha_asistencia' => $_POST['fecha'],
            'estado' => 0
          );
          $asistencia->setDia($asistenciaInicial[$i]);
        }
        $this->guardar();
      } else {
        $asistenciaActual = array(
          'id_usuario' => $_POST['id'],
          'fecha_asistencia' => $_POST['fecha'],
          'estado' => 1
        );
        $asistencia->updateDia($asistenciaActual);
      }

      header('Location: index.php?c=login&a=cerrar&e=0');
    }
  }

  public function historial() {
    if (isset($_GET['id'])) {
        $id_usuario = $_GET['id'];

        $historial = $this->historialModel->getHistorialByUsuario($id_usuario);
        if ($historial) {
            require_once('views/usuario/V_historialPeso.php');
        } else {
            header('Location: index.php?c=usuario&e=7');
        }
    }
  }
}

?>