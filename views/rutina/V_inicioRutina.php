<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
$usuario = $_SESSION['usuario'];
?>

<main>
<link rel="stylesheet" href="src/css/responsive.css">
<div class="panel-tabla-rutinas">
  <div class="container">
    <h1 class="text-light text-center mt-2"><strong>RUTINAS</strong></h1>
    <h1 class="text-light text-center mt-2"><strong><?php echo $usuario['nombre'] . ' ' . $usuario['apellido_p'] . ' ' . $usuario['apellido_m']; ?></strong></h1>
    <h1 class="text-light text-center mt-2">ID: <?php echo $usuario['id_usuario'] ?></h1>

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

      if ($status == '1') {
        echo '<div class="text-center alert alert-dismissible alert-success mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Rutina añadida</strong>, la rutina ha sido generada correctamente.
          </div>';
      }
      /*
      if ($status == '2') {
        echo '<div class="text-center alert alert-dismissible alert-success mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Rutina actualizada</strong>, la rutina ha sido actualizada correctamente.
          </div>';
      }
      */
      if ($status == '3') {
        echo '<div class="text-center alert alert-dismissible alert-success mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Rutina eliminada</strong>, la rutina ha sido eliminada correctamente.
          </div>';
      }
    }
    ?>
    <div class="table-responsive"> <!-- Tabla con scroll en pantallas pequeñas -->
    <table class="table table-dark table-striped table-bordered table-hover text-center">
      <thead>
        <tr>
          <th scope="col">ID Rutina</th>
          <th scope="col">Nombre</th>
          <th scope="col">Tipo de Rutina</th>
          <th scope="col">Dias</th>
          <th scope="col">Duración</th>
          <th scope="col">Eliminar</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rutinas as $rutina) : ?>
          <tr class="table-default">
            <th scope="row"> <a class="text-info" href="index.php?c=rutina&a=ver&id=<?php echo $rutina['id_rutina']; ?>"><?php echo $rutina['id_rutina']; ?></th>
            <td><?php echo $rutina['nombre_rutina']; ?></td>
            <td><?php echo $rutina['tipo_rutina']; ?></td>
            <td><?php echo $rutina['dias_d']; ?></td>
            <td><?php echo $rutina['duracion_sesiones']; ?></td>
            <td>

              <a class="btn btn-warning btn-sm text-light" href="index.php?c=rutina&a=eliminar&id=<?php echo $rutina['id_rutina']; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                  <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                </svg>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  </div>
</div>
</main>

<?php require_once 'includes/footer.php' ?>