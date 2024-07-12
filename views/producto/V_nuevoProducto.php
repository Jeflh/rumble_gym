<?php require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
?>

<main>

  <div class="container">
    <h1 class="text-light text-center mt-2"><strong>Agregar producto</strong></h1>

    <div class="d-flex justify-content-between">
      <a href="index.php?c=producto" class="btn btn-info mb-1">
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
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Nombre no válido</strong>, por favor introduce un nombre menor a 45 caracteres.
          </div>';
          break;
        case "2":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Cantidad vacía  </strong>, por favor introduce una cantidad.
          </div>';
          break;
        case "3":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Precio vacío</strong>, por favor introduce un precio.
          </div>';
          break;
        case "4":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Descripción no válida</strong>, por favor introduce una descripción de maximo 200 caracteres.
          </div>';
          break;
      }
    }
  }
  ?>

    <div class="container d-flex justify-content-center">
      <form class="col-4" action="index.php?c=producto&a=insertar" method="POST">
        <fieldset>
          <div class="form-group">
            <label for="nombre" class="form-label mt-2">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="cantidad" class="form-label mt-2">Cantidad</label>
            <input type="number" min="0" class="form-control" id="cantidad" name="cantidad" placeholder="Cantidad de productos" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="precio" class="form-label mt-2">Precio</label>
            <input type="number" min="0" step="0.01" class="form-control" id="precio" name="precio" placeholder="Precio del producto" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="descripcion" class="form-label mt-2">Decripcion</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" data-dl-input-translation="true" placeholder="Descripcion del producto" autocomplete="off"></textarea>
            <deepl-inline-translate style="z-index: 1999999999;"></deepl-inline-translate>
          </div>

          <div class="d-flex justify-content-center mt-2 mb-3">
            <button type="submit" class="btn btn-primary mt-2">Agregar producto</button>
          </div>
        </fieldset>
      </form>
    </div>

  </div>

</main>

<?php require_once 'includes/footer.php' ?>