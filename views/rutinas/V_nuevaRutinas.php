<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
$usuario = $_SESSION['usuario'];
?>


<main>
  <div class="container">
    <h1 class="text-light text-center mt-2"><strong><?php echo $usuario['nombre'] . ' ' . $usuario['apellido_p'] . ' ' . $usuario['apellido_m'];?></strong></h1>

  <?php
  if (isset($_GET['e'])) {
    $status = $_GET['e'];
    $arrayValues = str_split($status);
    // Se convierte el string en un array para poder evaluar cada caso.
    for ($i = 0; $i < count($arrayValues); $i++) {
      switch ($arrayValues[$i]) { // Se evalua cada caso y muestra la alerata correspondiente
        case "1":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Nombre no válido</strong>, por favor introduce un nombre menor a 45 caracteres.
          </div>';
          break;
      }
    }
  }

?>
    <div class="d-flex card bg-dark text-light mt-3">
        <div class="card-header text-center justify-content-center">
          <h3 class="card-title">NUEVA RECOMENDACION DE RUTINA SEMANAL</h3>
        </div>
        <div class="card-body">
          <form class="mt-2" action="index.php?c=rutinas&a=insertar"  method="POST"> 
            <fieldset>
              <!-- Campo 1 -->
              <div class="form-group mt-3">
                <label for="nombre_rutina" class="form-label ">Nombre</label>
                <input type="text" class="form-control" id="nombre_rutina" name="nombre_rutina" placeholder="Ej. Rutina 1" autocomplete="off">
              </div>
              <!-- Campo 2 -->
              <div class="form-group mt-3">
                <label for="tipo_rutina" class="form-label">Tipo de Rutina</label>
                <select class="form-select" id="tipo_rutina" name="tipo_rutina">
                  <option>Cardio</option>
                  <option>Fuerza</option>
                  <option>Flexibilidad</option>
                </select>
              </div>
              <!-- Campo 3 -->
              <div class="form-group mt-3">
                <label for="dias" class="form-label">Dias Disponibles por Semana</label>
                <select class="form-select" id="dias" name="dias">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                </select>
              </div>

              <!-- Campo 4 -->
              <div class="form-group mt-3">
                <label for="duracion" class="form-label">Duración de las Sesiones de Entrenamiento (Por Día)</label>
                <select class="form-select" id="duracion" name="duracion">
                  <option>30 Minutos</option>
                  <option>45 Minutos</option>
                  <option>60 Minutos</option>
                  <option>Más de 60 Minutos</option>
                </select>
              </div>




              <!-- Boton CREAR Rutinas -->
              <div class="d-flex text-center justify-content-center mt-5 mb-7">
                <!-- <form action="index.php?c=rutinas&a=inicio" method="POST"> 
                <button type="submit" class="btn btn-primary">Crear rutinaaaaaaaaaaa</button>  -->
                <button type="submit" class="btn btn-primary">Ingresar datos a rutinauser</button>

              </div>


              <!-- <BOTON PRUEBA PARA VER ELEMENTOS EN LISTA> -->
              <div class="d-flex text-center justify-content-center mt-4 mb-2">                
                <a href="index.php?c=rutinas&a=inicio" class="btn btn-primary">Ver Lista</a>
              </div>

              <!-- BOTON PRUEBAS PARA NUEVO PANEL DE RECOMENDACION DE RUTINAS -->
              <div class="d-flex text-center justify-content-center mt-4 mb-2">                
                <a href="index.php?c=rutinas&a=recomendacion" class="btn btn-primary">PRUEBA Recomendar Rutina</a>
              </div>

            </fieldset> 
          </form>
        </div>

   






    </div>
    <!-- me-5 -->
    <div class="d-flex text-center justify-content-center mt-5">
      <a href="index.php?c=panel" class="btn btn-light">VOLVER A PANEL</a>
    </div>
  </div>
</main>

<?php
require_once 'includes/footer.php';
?>