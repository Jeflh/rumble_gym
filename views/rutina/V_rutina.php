<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
$usuario = $_SESSION['usuario'];
?>

<main>
  <div class="container">
    <h1 class="text-light text-center mt-2"><strong>Rutina <?php echo $rutina['nombre_rutina']; ?></strong></h1>
    <h5 class="text-light text-center mt-2"><strong><?php echo $usuario['nombre'] . ' ' . $usuario['apellido_p'] . ' ' . $usuario['apellido_m']; ?></strong></h1>
    <div class="d-flex justify-content-between mb-3">
      <a href="index.php?c=rutina" class="btn btn-info">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
        </svg>
      </a>
    </div>

    <?php
    if (isset($_GET['e'])) {

      $status = $_GET['e'];

      if ($status == '1') {
        echo '<div class="text-center alert alert-dismissible alert-success mb-2">
      <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
      <strong>Rutina añadida</strong>, la rutina ha sido añadido correctamente.
      </div>';
      }/*
    if ($status == '1') {
      echo '<div class="text-center alert alert-dismissible alert-success mb-2">
      <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
      <strong>Producto actualizado</strong>, el producto ha sido actualizado correctamente.
      </div>';
    }
    if ($status == '2') {
      echo '<div class="text-center alert alert-dismissible alert-success mb-2">
      <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
      <strong>Producto eliminado</strong>, el producto ha sido eliminado correctamente.
      </div>';
    }*/
    }
    ?>
    <div>
      <?php if (isset($rutina)) { ?>
        <div class="card bg-dark mb-3">
          <div class="card-header text-light text-center">
            <div class="d-flex flex-wrap justify-content-between mt-4">
              <h5><strong>Tipo de rutina:</strong> <?php echo htmlspecialchars($rutina['tipo_rutina']); ?></p>
              <h5><strong>Días de ejercicio:</strong> <?php echo htmlspecialchars($rutina['dias_d']); ?></p>
              <h5><strong>Duración de las sesiones:</strong> <?php echo htmlspecialchars($rutina['duracion_sesiones']); ?></p>
            </div>
          </div>
          <div class="card-body text-light">
            <ul class="list-unstyled">
              <?php for ($i = 1; $i <= 7; $i++) {
                $dia = "dia" . $i;
                if (!empty($rutina[$dia])) { // Muestra solo los días con contenido
                  echo "<li><strong>Día $i:</strong></li>";

                  // Mostrar los ejercicios para este día
                  if (isset($ejercicios[$dia])) {
                    $numEjercicios = count($ejercicios[$dia]);
                    $cardWidth = 100 / $numEjercicios; // Calcula el ancho en porcentaje
                    echo "<div class='mb-4 d-flex flex-wrap justify-content-between'>";
                    foreach ($ejercicios[$dia] as $ejercicio) {
                      echo "<div class='card ms-1 me-1 mb-2' style='flex: 1 1 $cardWidth%; max-width: calc($cardWidth% - 1rem);'>";
                      echo "<img src='" . htmlspecialchars($ejercicio['imagen_url']) . "' alt='Imagen de " . htmlspecialchars($ejercicio['nombre_ejercicio']) . "' class='card-img-top' style='width: 100%; height: 150px; object-fit: cover;'>";
                      echo "<div class='card-body p-2'>";
                      echo "<h6 class='card-title text-light'><strong>" . htmlspecialchars($ejercicio['nombre_ejercicio']) . "</strong></h6>";
                      echo "<p class='card-text text-light'>" . htmlspecialchars($ejercicio['descripcion']) . "</p>";
                      echo "</div>";
                      echo "</div>";
                    }
                    echo "</div>";
                  }
                }
              } ?>
            </ul>
          </div>
        </div>
      <?php } else { ?>
        <div class="alert alert-warning text-center">
          <strong>No hay información de rutina disponible.</strong>
        </div>
      <?php } ?>
    </div>
  </div>
</main>

<?php require_once 'includes/footer.php' ?>