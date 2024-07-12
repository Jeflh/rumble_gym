<?php require_once 'includes/header.php';
require_once 'includes/navUsuario.php';
?>

<main>
  <div class="container">
    <div class="mb-1"></div> <!-- Ayuda a que los erroes se meustren con buen espacio -->
    <?php
    if (isset($_GET['e'])) {

      $status = $_GET['e'];
      $arrayValues = str_split($status);
      // Se convierte el string en un array para poder evaluar cada caso.
      for ($i = 0; $i < count($arrayValues); $i++) {
        switch ($arrayValues[$i]) { // Se evalua cada caso y muestra la alerata correspondiente
          case "0":
            echo '<div class="text-center alert alert-dismissible alert-success mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Ingreso confirmado</strong>, la asistencia ha sido guardada correctamente.
          </div>';
            break;
          case "1":
            echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Código vacío</strong>, por favor introduce tu código.
          </div>';
            break;
          case "2":
            echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Fecha de nacimiento vacía</strong>, por favor introduce tu fecha de nacimiento.
          </div>';
            break;
          case "3":
            echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Código o fecha de nacimiento incorrectos</strong>, por favor vuelte a intentarlo.
          </div>';
            break;
        }
      }
    }
    ?>

    <h1 class="text-light text-center mt-5"><strong>Inicio de sesión</strong></h1>
    <div class="text-center">
      <p class="text-muted">Usuarios del gimnasio</p>
    </div>
    <div class="container d-flex justify-content-center">
      <form class="col-sm-3" action="index.php?c=login&a=autenticarCliente" method="POST">
        <fieldset>
          <div class="form-group">
            <label for="codigo" class="form-label mt-5">Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Introduce tu código" maxlength="5" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="fecha_nac" class="form-label mt-3">Fecha de nacimiento</label>
            <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" placeholder="Introduce tu contraseña" autocomplete="off" min="1950-01-01" max="<?php $actual = date('Y-m-d'); $nueva = strtotime ('-15 year' , strtotime($actual)); echo date ('Y-m-d', $nueva);?>">
          </div>
          <div class="d-flex justify-content-center mt-4 mb-3">
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</main>

<?php require_once 'includes/footer.php'; ?>