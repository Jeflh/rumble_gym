<?php

class LoginController{

  public function __construct(){
    require_once('models/M_login.php');
  }

  public function index(){    
    require_once('views/login/V_loginUsuarios.php');
  }

  public function empleados(){
    require_once('views/login/V_loginEmpleados.php');
  }

  public function autenticarCliente(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $codigo = $_POST['codigo'];
      $fecha_nac = $_POST['fecha_nac'];

      $error = "";

      if(empty($codigo)){
        $error .= "1";
      }
      if(empty($fecha_nac)){
        $error .= "2";
      }

      if($error == ""){
        $login = new LoginModel();
        $usuario = $login->autenticarCliente($codigo, $fecha_nac);

        if($usuario){ // Si la consulta devuelve un resultado (el usuario existe)
          session_start();
          $_SESSION['usuario'] = $usuario; // Guardar datos del usuario en la sesión
          $_SESSION['login'] = true;
          
          header("Location: index.php?c=panel");
        }
        else{
          header("Location: index.php?c=login&e=3"); // Código o fecha de nacimiento incorrectos
        }
      }else{
        header("Location: index.php?c=login&e=$error");
      }
    }
  }

  public function autenticarEmpleado(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $codigo = $_POST['codigo'];
      $password = $_POST['password'];

      $error = "";

      if(empty($codigo)){
        $error .= "1";
      }
      if(empty($password)){
        $error .= "2";
      }

      if($error == ""){
        $login = new LoginModel();
        $empleado = $login->autenticarEmpleado($codigo);

        if($empleado){ // Si la consulta devuelve un resultado (el usuario existe)
          if(password_verify($password, $empleado['password'])){ // Si la contraseña es correcta
            session_start();
            $_SESSION['usuario'] = $empleado; // Guardar datos del usuario en la sesión
            $_SESSION['login'] = true;

            header("Location: index.php?c=panel");
          }
          else{
            header("Location: index.php?c=login&a=empleados&e=4"); // Contraseña incorrecta
          }
        }
        else{
          header("Location: index.php?c=login&a=empleados&e=3"); // Usuario no existe
        }
      }else{
        header("Location: index.php?c=login&a=empleados&e=$error");
      }
    }
  }

  public function cerrar(){  // Función para cerrar sesión
    session_start();

    $_SESSION = [];
    
    if(isset($_GET['e'])){
      header("Location: index.php?c=login&e=".$_GET['e']);
    }else{
      header('Location: index.php');
    }
  }
}

?>