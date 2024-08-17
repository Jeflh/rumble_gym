<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
$usuario = $_SESSION['usuario'];
//$rutinas = $_SESSION['rutinas'];
/*$_SESSION['rutinas'] = array();
$rutinas = $_SESSION['rutinas'];*/

?>

<main>
  <div class="container">
    <h1 class="text-light text-center mt-2"><strong>Rutinas</strong></h1>
    <div class="d-flex justify-content-between mb-3">
      <a href="index.php?c=panel" class="btn btn-info">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/></svg>
      </a>
      <!-- <a href="index.php?c=producto&a=nuevo" class="btn btn-info">Agregar producto</a> -->
    </div>
    
    <!-- Info de la rutina Ingresada (rutinasuser) -->
    <div class="col card text-white bg-dark">
      
        <div class="card-body">
        <h6>
        <?php 
        if ($rutinas) {
        // Mostrar el tipo de rutina directamente

          echo "<p><strong>Nombre de la Rutina: </strong>" . $rutinas['nombre_rutina'] . "</p>";
          echo "<p><strong>Tipo de Rutina: </strong>" . $rutinas['tipo_rutina'] . "</p>";
          echo "<p><strong>Días por semana: </strong>" . $rutinas['dias_d'] . "</p>";
        } else {
          echo "<p>No se encontró ninguna rutina.</p>";
        } ?>
        </h6>
        </div>
      
    </div>


    
    <?php 
      if ($rutinas) {
        
        $dias_d = $rutinas['dias_d'];
        /*$bloquesPorDia = [
            'dia1' => $rutinas['dia1'],
            'dia2' => $rutinas['dia2'],
            'dia3' => $rutinas['dia3'],
            'dia4' => $rutinas['dia4'],
            'dia5' => $rutinas['dia5'],
            'dia6' => $rutinas['dia6'],
            'dia7' => $rutinas['dia7']
        ];*/
        $this->imprimirRutina($dias_d, $bloquesPorDia, $rutinas, $usuario);
        
        






        /*
        $dias_d = $rutinas['dias_d'];
        if (is_numeric($dias_d) && $dias_d >= 1 && $dias_d <= 7) {
          // Convertimos a entero por seguridad
          $dias_d = (int)$dias_d;
          
          // Iteramos desde 1 hasta el número de días
          for ($dia = 1; $dia <= $dias_d; $dia++) {

              echo "<h4 class=\"mt-5\"> <strong> Día $dia </strong> </h4>";
              
              $bloquesPorDia = rand(3, 4);
              for ($bloqueNum = 1; $bloqueNum <= $bloquesPorDia; $bloqueNum++) {
                  imprimirBloque($dia, $usuario, $bloqueNum);
              }

              echo "<p> Día $dia </p>";
          }
        } else {
            // Manejo de errores: valor fuera de rango
            echo "<p>Error: el número de días debe estar entre 1 y 7.</p>";
        }
            
        
        
        function mostrarRutina() {
          $usuario = $_SESSION['usuario'];
          $rutina = obtenerRutinaConBloques($usuario['id_usuario']);
      
          if ($rutina) {
              $dias_d = $rutina['dias_d'];
              echo "<h3>Rutina para {$dias_d} días</h3>";
      
              for ($dia = 1; $dia <= $dias_d; $dia++) {
                  $numBloques = $rutina["dia$dia"];
                  echo "<h4 class=\"mt-5\"><strong>Día $dia</strong></h4>";
                  
                  for ($bloque = 1; $bloque <= $numBloques; $bloque++) {
                      imprimirBloque($dia, $bloque);
                  }
              }
          } else {
              echo "No se encontró una rutina para este usuario.";
          }
          
      
        }
          
        
        */
      }
    ?>
      <!-- Dia 1 -->


    <?php
    
    

    
    
    
    
    
    
    
    
    /*


       
      
    
    function imprimirBloque($dia, $usuario) {
      echo "<div class=\"d-flex justify-content-center mt-4\">";
      echo "<div class=\"col card text-white bg-dark me-2\" style=\"max-width: 30rem; text-align: center;\">";
      echo "<div class=\"card-header\">";
      echo "<h4>Ejercicio 1</h4>";
      echo "</div>";
      echo "<div class=\"card-body\">";
      
      // Asegúrate de que $rutinas['imagen_url'] esté definido y seguro para uso directo
      //echo "<img src=\"{$rutinas['imagen_url']}\" width=\"100\" height=\"100\" class=\"bi bi-person-vcard\">";
      
      // Icono SVG, asegúrate de que se necesita, ya que no parece estar correctamente definido
      /*echo "<svg viewBox=\"0 0 16 16\">";
      echo "<path d=\"M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z\" />";
      echo "<path d=\"M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z\" />";
      echo "</svg>";
      echo "Aqui va la imagen";
      echo "</div>";
      echo "</div>";
  
      // DESCRIPCIÓN Ejercicio 1
      echo "<div class=\"col card text-white bg-dark me-2\" style=\"max-width: 90rem; text-align: center;\">";
      echo "<div class=\"card-header\">";
      echo "<h4>Descripción</h4>";
      echo "</div>";
      echo "<div class=\"card-body\">";
      echo "<div class=\"card-text\">";
      
      // Asegúrate de que $usuario['id_usuario'] esté definido
      echo "<strong>Descripción: </strong>{$usuario['id_usuario']}";
      
      echo "</div>";
      echo "</div>";
      echo "</div>";
      echo "</div>";
    } */

    ?>





<!--
      <h4 class="mt-5"> <strong> Día 1 </strong> </h4>
      
      <div class="d-flex justify-content-center mt-4">

        <div class="col card text-white bg-dark me-2" style="max-width: 30rem; text-align: center;">
          <div class="card-header ">
            <h4>Ejercicio 1</h4>
          </div>
          <div class="card-body ">
            
              <img src="<?php echo $rutinas['imagen_url'] ?>" width="100" height="100" class="bi bi-person-vcard" viewBox="0 0 16 16">
                <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
                <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
              </svg>
            </a>
          </div>
        </div>


        DESCRIPCION Ejercicio 1
        <div class="col card text-white bg-dark me-2" style="max-width: 90rem; text-align: center;">
          <div class="card-header ">
            <h4>Descripción</h4>
          </div>
          <div class="card-body">
            <div class="card-text">
            <strong>Descripcion: </strong><?php echo $usuario['id_usuario']; ?>
            </div>
              

          </div>
        </div>
      </div>
    



  </div>


    <div class="d-flex text-center justify-content-center mt-5">
      <a href="index.php?c=panel" class="btn btn-light">VOLVER A PANEL</a>
    </div>

  </div>
</main>

<?php
require_once 'includes/footer.php';
?>