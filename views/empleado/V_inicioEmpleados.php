<?php require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
?>

<main>
  <div class="container">
    <h1 class="text-light text-center mt-2"><strong>Gestión de empleados</strong></h1>

    <div class="d-flex justify-content-between mb-3">
      <a href="index.php" class="btn btn-info">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/></svg>
      </a>
      <a href="index.php?c=empleado&a=nuevo" class="btn btn-info">Agregar empleado</a>
    </div>

    <?php
      if (isset($_GET['e'])) {

        $status = $_GET['e'];

        if ($status == '0') {
          echo '<div class="text-center alert alert-dismissible alert-success mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Empleado registrado</strong>, el empleado ha sido registrado correctamente.
          </div>';
        }
        if ($status == '1') {
          echo '<div class="text-center alert alert-dismissible alert-success mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Empleado actualizado</strong>, el empleado ha sido actualizado correctamente.
          </div>';
        }
        if ($status == '2') {
          echo '<div class="text-center alert alert-dismissible alert-success mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Empleado eliminado</strong>, el empleado ha sido eliminado correctamente.
          </div>';
        }
      }
    ?>
    <table class="table table-dark table-striped table-bordered table-hover text-center">
      <thead>
        <tr>
          <th scope="col" class="col-1">Código</th>
          <th scope="col" class="col-4">Nombre</th>
          <th scope="col" class="col-1">Nacimiento</th>
          <th scope="col" class="col-2">Domicilio</th>
          <th scope="col" class="col-1">Telefono</th>
          <th scope="col" class="col-1">Tipo</th>
          <th scope="col" class="col-2">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($empleados as $empleado) : ?>
          <tr class="table-default">
            <th scope="row"><?php echo $empleado['id_empleado']; ?></th>
            <td><?php echo $empleado['nombre'] . ' ' . $empleado['apellido_p'] . ' ' . $empleado['apellido_m']; ?></td>
            <td><?php echo date('d/m/Y', strtotime($empleado['fecha_nac'])); ?></td>
            <td><?php echo $empleado['domicilio']; ?></td>
            <td><?php echo $empleado['telefono']; ?></td>
            <td>
              <?php 
                if($empleado['tipo'] == '1'){
                  echo 'Administrador';
                } else if($empleado['tipo'] == '2'){
                  echo 'Recepcionista';
                } else {
                  echo 'Entrenador';
                }
              ?>
            </td>
            <td>
              <a class="btn btn-primary btn-sm me-2 text-light" href="index.php?c=empleado&a=editar&id=<?php echo $empleado['id_empleado']; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                </svg>
              </a>
      
              <a class="btn btn-warning btn-sm text-light" href="index.php?c=empleado&a=eliminar&id=<?php echo $empleado['id_empleado']; ?>">
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
</main>

<?php require_once 'includes/footer.php' ?>