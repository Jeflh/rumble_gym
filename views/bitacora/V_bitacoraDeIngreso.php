<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
?>

<main>
  <div class="container">
    <h1 class="text-light text-center mt-2"><strong>Bitacora de Asistencia</strong></h1>

    <div class="d-flex justify-content-between mb-3">
      <a href="index.php" class="btn btn-info">
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
          <strong>Estado actualizado</strong>, el estado del usuario ha sido actualizado.
          </div>';
      }
    }
    ?>
    <h4 class="text-center"><?php echo 'Del ' . date("d-m-Y", strtotime($fechaCorte)) . ' al ' . date("d-m-Y", strtotime($fechaActual));?></h4>
    <table class="table table-dark table-striped table-bordered table-hover text-center">
      <thead>
        <tr>
          <th scope="col" class="col-1">Código</th>
          <th scope="col" class="col-3">Nombre</th>
          <th scope="col" class="col-1">Inscrito</th>
          <th scope="col" class="col-1">Estatus</th>
          <th scope="col" class="col-4">Asistencia en los ultimos 30 días</th>
          <th scope="col" class="col-1">Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=0; foreach ($usuarios as $usuario) : ?>
          <tr class="table-default">
            <th scope="row"><?php echo $usuario['id_usuario']; ?></th>
            <td><?php echo $usuario['nombre'] . ' ' . $usuario['apellido_p'] . ' ' . $usuario['apellido_m']; ?></td>
            <td><?php echo date("d-m-Y", strtotime($usuario['inscrito'])); ?></td>
            <td><?php
                if ($usuario['estado'] == '1') {
                  echo '<h5><span class="badge bg-success">Activo</span></h5>';
                } else if ($usuario['estado'] == '0') {
                  echo '<h5><span class="badge bg-danger">Inactivo</span></h5>';
                }
                ?>
            </td>

            <td class="text-primary">
              <div class="progress">
                <div class="progress-bar progress-bar-striped <?php echo $estado = $usuario['estado'] == '1' ? 'bg-info' : 'bg-secondary';?> progress-bar-animated" role="progressbar" style="width: <?php echo $lista[$i]['asistencia']?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><span class="text-light text-center"><strong><?php echo $lista[$i]['asistencia'] . '%'?></strong></span></div>
              </div>
            </td>
            <td>
              <a class="btn btn-danger btn-sm me-1 text-light" href="index.php?c=usuario&a=cambiarEstado&id=<?php echo $usuario['id_usuario'] . '&s=' . $usuario['estado'] . '&b=1'; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                </svg>
              </a>
            </td>
          </tr>
        <?php $i++; endforeach; ?>
      </tbody>
    </table>
    <p class="text-center">Estos datos no toman en cuenta la fecha de registro del usuario, solo las asistencias registradas durante los últimos 30 días.</p>
  </div>
</main>

<?php require_once 'includes/footer.php' ?>