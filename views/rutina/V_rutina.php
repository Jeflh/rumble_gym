<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
$usuario = $_SESSION['usuario'];
?>

<main>
<link rel="stylesheet" href="src/css/responsive.css">
<div class="panel-rutina">
  <div class="container">
    <h1 class="text-light text-center mt-2"><strong>Rutina <?php echo htmlspecialchars($rutina['nombre_rutina']); ?></strong></h1>
    <h5 class="text-light text-center mt-2"><strong><?php echo htmlspecialchars($usuario['nombre'] . ' ' . $usuario['apellido_p'] . ' ' . $usuario['apellido_m']); ?></strong></h5>
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
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <strong>Rutina añadida</strong>, la rutina ha sido añadida correctamente.
              </div>';
      }
    }
    ?>

    <div>
      <?php if (isset($rutina)) { ?>
        <div class="card bg-dark mb-3">
          <div class="card-header text-light text-center">
            <div class="d-flex flex-wrap justify-content-between mt-4">
              <h5><strong>Tipo de rutina:</strong> <?php echo htmlspecialchars($rutina['tipo_rutina']); ?></h5>
              <h5><strong>Días de ejercicio:</strong> <?php echo htmlspecialchars($rutina['dias_d']); ?></h5>
              <h5><strong>Duración de las sesiones:</strong> <?php echo htmlspecialchars($rutina['duracion_sesiones']); ?></h5>
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
                    echo "<div class='mb-5 d-flex flex-wrap justify-content-center'>"; // Comienza el contenedor para los ejercicios

                    // Itera sobre cada ejercicio
                    foreach ($ejercicios[$dia] as $ejercicio) {
                      echo "<div class='card dynamic-card ms-1 me-1 mb-2' style='flex: 1 1 25%; max-width: calc(25% - 1rem);'>"; // Ajusta el ancho según tus necesidades AJUSTE DE ANCHO
                      

                      echo "<img src='" . htmlspecialchars($ejercicio['gif_url']) . "' alt='Imagen de " . htmlspecialchars($ejercicio['nombre']) . "' class='card-img-top' style='width: 100%; height: 150px; object-fit: cover;'>";
                      echo "<div class='card-body p-2'>";
                      echo "<h6 class='card-title text-light'><strong>" . ucfirst(htmlspecialchars($ejercicio['nombre'])) . "</strong></h6>";

                      // Mostrar información del ejercicio
                      echo "<p class='card-text text-light mb-1'><strong>Objetivo:</strong> " . ucfirst(htmlspecialchars($ejercicio['musculo_principal'])) . "</p>";
                      echo "<p class='card-text text-light mb-1'><strong>Secundario:</strong> " . ucfirst(htmlspecialchars($ejercicio['musculo_secundario'])) . "</p>";
                      echo "<p class='card-text text-light mb-1'><strong>Equipo:</strong> " . ucfirst(htmlspecialchars($ejercicio['equipo'])) . "</p>";
                      echo "<p class='card-text text-light mb-1'><strong>Parte del cuerpo:</strong> " . ucfirst(htmlspecialchars($ejercicio['parte_cuerpo'])) . "</p>";
                      echo "</div>";

                       // Botón para abrir la modal con las instrucciones
                      echo "<button type='button' class='btn btn-light mt-auto' data-bs-toggle='modal' data-bs-target='#modalInstrucciones' data-ejercicio='" . htmlspecialchars(json_encode($ejercicio)) . "'>Ver Instrucciones</button>";
                      echo "</div>";
                    }

                    echo "</div>"; // Cierra el contenedor para los ejercicios
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
</div>
</main>

<!-- Modal para mostrar instrucciones -->
<div class="modal fade" id="modalInstrucciones" tabindex="-1" aria-labelledby="modalInstruccionesLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h5 class="modal-title text-light w-100 text-center fw-bold" id="modalEjercicioTitulo">Instrucciones del Ejercicio</h5> <!-- Título centrado -->
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-light">
        <img id="modalEjercicioImg" src="" alt="Imagen de ejercicio" class="img-fluid mb-3" style="max-width: 80%; height: auto; display: block; margin-left: auto; margin-right: auto;"> <!-- Imagen centrada -->
        <div id="modalEjercicioInstrucciones" style="font-size: 1.2em;"></div> <!-- Tamaño del texto aumentado -->
      </div>
    </div>
  </div>
</div>


<?php require_once 'includes/footer.php'; ?>

<script>
  function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
  }

  // Función para cargar las instrucciones en la modal
  const modalInstrucciones = document.getElementById('modalInstrucciones');
  modalInstrucciones.addEventListener('show.bs.modal', function(event) {
    const button = event.relatedTarget; // Botón que abrió la modal
    const ejercicio = JSON.parse(button.getAttribute('data-ejercicio')); // Obtener datos del ejercicio

    // Actualizar el contenido de la modal
    const modalImg = document.getElementById('modalEjercicioImg');
    const modalInstrucciones = document.getElementById('modalEjercicioInstrucciones');
    const modalTitulo = document.getElementById('modalEjercicioTitulo'); // Obtener el título de la modal

    modalImg.src = ejercicio.gif_url; // Establece la imagen
    modalTitulo.innerText = capitalizeFirstLetter(ejercicio.nombre);
    modalInstrucciones.innerHTML = ''; // Limpia contenido anterior

    // Procesar instrucciones
    const instrucciones = ejercicio.instrucciones.split('\n'); // Divide por saltos de línea
    instrucciones.forEach((instr, index) => {
      modalInstrucciones.innerHTML += `<p>${index + 1}. ${instr.trim()}</p>`; // Muestra pasos numerados
    });
  });
</script>
<?php require_once 'includes/footer.php'; ?>