<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
$usuario = $_SESSION['usuario'];
?>

<main>
  <div class="container">
    <h1 class="text-light text-center mt-2"><strong>Rutina: </strong>
    <?php
    if ($rutinas) {
      echo $rutinas['nombre_rutina'];?> 
      <h1 class="text-light text-center mt-2">
        <strong>ID: </strong> <?php echo $rutinas['id_rutina'] . "</h1>";
    } else {
      echo "No se encontró ninguna rutina.";
    }
    ?>
    </h1>

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
          echo "<p><strong>ID de la Rutina: </strong>" . $rutinas['id_rutina'] . "</p>";
        } else {
          echo "<p>No se encontró ninguna rutina.</p>";
        } ?>
        </h6>
        </div>
      
    </div>


    
    <?php 
      if ($rutinas) {
        $dias_d = $rutinas['dias_d'];
        //$this->imprimirRutina($dias_d, $bloquesPorDia, $rutinas, $usuario);
        $pruebaMostrarBLQ = $this->imprimirRutinaVDOS($dias_d, $diasPrueba, $usuario);
        if ($pruebaMostrarBLQ){

        }
        else{
          echo "<p> No funciono la funcion obtenerDias </p>";
        }

        
      }
    ?>

    <?php

    ?>

<?php
require_once 'includes/footer.php';
?>