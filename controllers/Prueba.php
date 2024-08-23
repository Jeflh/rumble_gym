<?php
  
class PruebaController{
  private $db;
  private $auth;
  private $pruebaModel;

  private $usuarioModel; //

  public function __construct(){
    $this->db = Conectar::conexion();
    $this->auth = autenticado();

    require_once ('models/M_rutinas.php');
    require_once('models/M_usuario.php');
    $this->pruebaModel = new RutinasModel();
    
    $this->usuarioModel = new UsuarioModel(); //

    $usuarios = new UsuarioModel();
    $listaInternaPrueba = $this->usuarioModel->getAll();
    
    if(!$this->auth){
      header("Location: index.php?c=panel");
    }
  }


  /* Visualización Panel de Nuevas Rutinas*/
  public function index(){

    //$prueba = $this->pruebaModel->getData($usuario);
    
    $usuarios = $this->usuarioModel->getAll();
    $pruebas = $this->pruebaModel->insertRutinaUserID();

    /*foreach($usuarios as $usuario){//por cada uno de estos hacer un foreach
      $pruebas = $this->pruebaModel->getData($usuario);
    }*/

    /*foreach($usuarios as $usuario){
      foreach($pruebas as $prueba){*/
    $usuario = $_SESSION['usuario'];
    $prueba = $this->pruebaModel->verRutinas($usuario['id_usuario']);
    if($_SESSION['usuario'] == true){
      $prueba = $this->pruebaModel->getData($prueba['id_usuario']);
      require_once('views/usuario/V_inicioPrueba.php');
    }
      /*}
    
    }*/
  }



  public function inicio(){ // Función para mostrar la rutina personalizada del usuario
    require_once('views/rutinas/V_inicioRutinas.php');
  }


  /*
  public function a(){ // Función para insertar una rutina
    //if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if(isset($_POST)){
        $usuarios = $this->usuarioModel->getAll();
        //$fechaActual = date('Y-m-d');
        //$fechaCorte = date('Y-m-d', strtotime($fechaActual . ' - 1 month'));
        foreach($usuarios as $usuario){//por cada uno de estos hacer un foreach
          $userRutinas = $this->pruebaModel->getRutinasUser($usuario['id_usuario']);
        }
        foreach($usuarios as $usuario){
          foreach($userRutinas as $userRutina){
            if($usuario['id_usuario'] == $userRutina['id_usuario']){
              $insertar = $this->pruebaModel->insertRutina($userRutina);
              if($insertar){
                echo "Rutina insertada correctamente :D";
                
                //require_once('views/rutinas/V_editarRutinas.php');
              }
              else{
                echo "Error al insertar la rutina a la base de datos";
              }
            }
        }
      }
  }*/
  
  public function insertar(){ // Función para insertar una rutina
    if(isset($_POST)){
      $usuarios = $this->usuarioModel->getAll();
      //$userRutinas = $this->rutinaModel->getRutinasUser($usuario['id_usuario']);
      //$usuarios = $this->usuarioModel->getAll();
      $pruebas = $this->pruebaModel->insertRutinaUserID();
  
      $usuario = $_SESSION['usuario'];
      $prueba = $this->pruebaModel->verRutinas($usuario['id_usuario']);
      if($_SESSION['usuario'] == true){
        $prueba = $this->pruebaModel->getData($usuario['id_usuario']);  // SOLO SE INSERTA UNA SOLA VEZ
        if ($prueba){
          
          echo "Rutina insertada correctamente :D";
          require_once('views/prueba/V_inicioPrueba.php');
        }
        else{
          echo "Error al insertar la rutina a la base de datos";
        }
        
      }
      else{
        echo "Error al cargar la vista";
      }
          
    }
        /*$lista [] = array(
          'id_usuario' => $usuario['id_usuario'],
          'nombreRutina' => $userRutinas['nombre_rutina'],
          'tipoRutina' => $userRutinas['tipo_rutina'],
          'dias_d' => $userRutinas['dias_d'],
          'duracion' => $userRutinas['duracion']
        );*/

}





}
  


?>