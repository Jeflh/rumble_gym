<?php 
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
?>
<main class="container mt-4">

  <div class="d-flex justify-content-between mb-3">
    <a href="index.php?c=panel" class="btn btn-info">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
      </svg>
    </a>
  </div>
  <div class="row">
    <div class="col-12 text-center">
      <h1 class="text-light"><strong>Historial de Peso</strong></h1>
    </div>
    <div class="col-12 mt-5">
      <!-- Tabla con los datos del historial -->
      <table class="table table-bordered table-striped">
        <thead class="thead-dark text-center">
          <tr>
            <th scope="col">Peso (kg)</th>
            <th scope="col">Fecha</th>
          </tr>
        </thead>
        <tbody class="text-center">
          <?php 
          $firstRow = true; // Variable para identificar el primer registro
          foreach ($historial as $registro): 
            // Si es el primer registro, agregar una clase especial
            $rowClass = $firstRow ? 'table-info' : ''; 
            $firstRow = false;
          ?>
            <tr class="<?php echo $rowClass; ?>">
              <td><?php echo htmlspecialchars($registro['peso']); ?></td>
              <td><?php echo htmlspecialchars($registro['fecha']); ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php require_once 'includes/footer.php'; ?>
