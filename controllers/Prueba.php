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
    if($usuario['id_usuario'] == $prueba['id_usuario']){
      $prueba = $this->pruebaModel->getData($prueba['id_usuario']);
      require_once('views/usuario/V_inicioPrueba.php');
    }
      /*}
    
    }*/
  }



  public function inicio(){ // Función para mostrar la rutina personalizada del usuario
    require_once('views/rutinas/V_inicioRutinas.php');
  }


  # PRUEBA 
  public function insertar(){ // Función para insertar una rutina
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
    
              /*if($userRutina['estado'] == '1'){
                $sumaAsistencia++;
              }*/

              /*$datosRutinas = array(
                'id_usuario' => $usuario['id_usuario'],
                'nombre' => $_POST['nombre_rutina'],
                'tipo' => $_POST['tipo'],
                'dias' => $_POST['dias'],
                'duracion' => $_POST['duracion']
              );*/
      
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
  
      }
      
      
    //}
    
  }


   /*
  # ESTO FUE CREADO POR COPILOT
  public function crear(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id = $_POST['id'];
      $tipo = $_POST['tipo'];
      $dias = $_POST['dias'];
      $duracion = $_POST['duracion'];
      $sql = "INSERT INTO rutinas (id_usuario, tipo, dias, duracion) VALUES ('$id', '$tipo', '$dias', '$duracion')";
      $this->db->query($sql);
      //header("Location: index.php?c=panel");
    }
  }
  public function editar(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id = $_POST['id'];
      $sql = "SELECT * FROM rutinas WHERE id_usuario = '$id'";
      $resultado = $this->db->query($sql);
      $rutina = $resultado->fetch_assoc();
      require_once('views/rutinas/V_editarRutinas.php');
    }
  }
  public function actualizar(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id = $_POST['id'];
      $tipo = $_POST['tipo'];
      $dias = $_POST['dias'];
      $duracion = $_POST['duracion'];
      $sql = "UPDATE rutinas SET tipo = '$tipo', dias = '$dias', duracion = '$duracion', WHERE id_usuario = '$id'";
      $this->db->query($sql);
      //header("Location: index.php?c=panel");
    }
  }
  public function eliminar(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id = $_POST['id'];
      $sql = "DELETE FROM rutinas WHERE id_usuario = '$id'";
      $this->db->query($sql);
      //header("Location: index.php?c=panel");
    }
  }
    
  
  */


}
  


?>