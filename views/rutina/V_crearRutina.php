<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
$usuario = $_SESSION['usuario'];
?>


<main>
  <div class="container">
    <h1 class="text-light text-center mt-2"><strong><?php echo $usuario['nombre'] . ' ' . $usuario['apellido_p'] . ' ' . $usuario['apellido_m']; ?></strong></h1>

    <div class="d-flex justify-content-between mb-3">
      <a href="index.php?c=panel" class="btn btn-info">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
        </svg>
      </a>
    </div>
    <?php
    if (isset($_GET['e'])) {
      $status = $_GET['e'];
      $arrayValues = str_split($status);
      // Se convierte el string en un array para poder evaluar cada caso.
      for ($i = 0; $i < count($arrayValues); $i++) {
        switch ($arrayValues[$i]) { // Se evalua cada caso y muestra la alerata correspondiente
          case "1":
            echo '<div class="text-center alert alert-dismissible alert-warning mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Error al enviar el formulario</strong>, todos los campos son obligatorios.
          </div>';
            break;
          case "2":
            echo '<div class="text-center alert alert-dismissible alert-warning mb-1">
            <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
            <strong>Nombre de rutina invalido</strong>, introduce un nombre de rutina menor a 45 caracteres.
            </div>';
            break;
          case "3":
            echo '<div class="text-center alert alert-dismissible alert-warning mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Error al generar rutina</strong>, ha ocurrido un error al crear la rutina.
          </div>';
            break;
        }
      }
    }

    ?>
    <div class="d-flex card bg-dark text-light mt-3 mb-3">
      <div class="card-header text-center justify-content-center">
        <h3 class="card-title">Nueva recomendación de rutina</h3>
      </div>
      <div class="card-body">
        <form class="mt-2" action="index.php?c=rutina&a=generar" method="POST">
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

            <div class="d-flex justify-content-center mt-3">
              <button type="submit" class="btn btn-success">Generar Rutina</button>
            </div>

          </fieldset>
        </form>
      </div>
    </div>
  </div>
</main>

<?php
require_once 'includes/footer.php';
?>