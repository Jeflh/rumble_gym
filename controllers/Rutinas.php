<?php
  
class RutinasController{
  private $db;
  private $auth;

  private $rutinaModel;

  private $usuarioModel; //

  public function __construct(){
    $this->db = Conectar::conexion();
    $this->auth = autenticado();

    require_once ('models/M_rutinas.php');
    require_once('models/M_usuario.php');
    $this->rutinaModel = new RutinasModel();
    
    $this->usuarioModel = new UsuarioModel(); //

    if(!$this->auth){
      header("Location: index.php?c=panel");
    }
  }


  
  


  /* Visualización Panel de Nuevas Rutinas*/
  public function index(){
    require_once('views/rutinas/V_nuevaRutinas.php');
    
    
  }

  public function inicio(){ // Función para mostrar la rutina personalizada del usuario
    require_once('views/rutinas/V_inicioRutinas.php');
  }


  public function editar(){ // Función para mostrar todas las rutinas del usuario
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $id_usuario = $_POST['id_usuario'];
      //$rutinasuser = $this->rutinaModel->getRutinasUser($_SESSION['id_usuario']);
      $rutinasuser = $this->rutinaModel->getRutinasUser($id_usuario);
      require_once('views/rutinas/V_editarRutinas.php');
    }
  }



  # PRUEBA 
  public function insertar(){ // Función para insertar una rutina
    //if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if(isset($_POST)){
        $usuarios = $this->usuarioModel->getAll();
        //$fechaActual = date('Y-m-d');
        //$fechaCorte = date('Y-m-d', strtotime($fechaActual . ' - 1 month'));
        
        //$userRutinas = $this->rutinaModel->getRutinasUser($usuario['id_usuario']);
        

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
      
              $insertar = $this->rutinaModel->insertRutina($userRutina);
              if($insertar){
                echo "Rutina insertada correctamente :D";
                
                //require_once('views/rutinas/V_editarRutinas.php');
              }
              else{
                echo "Error al insertar la rutina a la base de datos";
              }
            }
          }
          /*$lista [] = array(
            'id_usuario' => $usuario['id_usuario'],
            'nombreRutina' => $userRutinas['nombre_rutina'],
            'tipoRutina' => $userRutinas['tipo_rutina'],
            'dias_d' => $userRutinas['dias_d'],
            'duracion' => $userRutinas['duracion']
          );
          
          
          
          
          */





          
        }
        
        
        
        

        /*if($insertar){
          //$consulta = $this->rutinaModel->consultaRutinasUser($id_usuario);
          //$dias = $this->rutinaModel->recomendarRutinaDia($id_usuario, $diasD);
          echo "Rutina insertada correctamente :D";
          require_once('views/rutinas/V_pruebaRutinas.php');
        }
        else{
          echo "Error al insertar la rutina a la base de datos";
        }*/
        //$this->rutinaModel->insertRutina('pendiente');
        //header("Location: index.php?c=panel");
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