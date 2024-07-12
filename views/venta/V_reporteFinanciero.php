<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
?>

<main>
  <div class="container">
    <h1 class="text-light text-center mt-2"><strong>Reporte financiero</strong></h1>

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
    <div class="d-flex justify-content-center">
      <div class="col-10">
      <table class="table table-dark table-striped table-bordered table-hover text-center">
        <thead>
          <tr>
            <th scope="col" class="col-1">ID venta</th>
            <th scope="col" class="col-1">Código del encargado</th>
            <th scope="col" class="col-1">Origen</th>
            <th scope="col" class="col-1">Fecha de venta</th>
            <th scope="col" class="col-1">Monto de venta</th>
          </tr>
        </thead>
        <tbody>
          <?php $ingresos = 0;
          foreach ($listaVentas as $venta) : ?>
            <tr class="table-default">
              <th scope="row"><?php echo $venta['id_venta']; ?></th>
              <td><?php echo $venta['id_empleado']; ?></td>
              <td><?php echo $tipo = $venta['tipo'] == 1 ? 'Venta' : 'Suscripción'; ?></td>
              <td><?php echo $venta['fecha_venta']; ?></td>
              <td><?php echo '$' . $venta['monto_venta']; ?></td>
            </tr>
          <?php $ingresos += $venta['monto_venta'];
          endforeach; ?>
        </tbody>
      </table>
      </div>
    </div>

    <h3 class="text-center text-success"><strong class="text-light">Ingresos totales: </strong><?php echo '$' . round($ingresos, 2); ?></h3>

    <p class="text-center">Esta información está basada en los ingresos registrados durante los últimos 30 días.</p>
  </div>
</main>

<?php require_once 'includes/footer.php' ?>