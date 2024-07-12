<?php 
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
?>

<main>

  <div class="container">
    <h1 class="text-light text-center mt-2"><strong>Agregar usuario</strong></h1>

    <div class="d-flex justify-content-between">
      <a href="index.php?c=usuario" class="btn btn-info mb-1">
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
        case "0":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Nombre no válido</strong>, por favor introduce un nombre válido.
          </div>';
          break;
        case "1":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Apellido paterno no válido</strong>, por favor introduce un apellido paterno válido.
          </div>';
          break;
        case "2":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Apellido materno no válido</strong>, por favor introduce un apellido materno válido.
          </div>';
          break;
        case "3":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Sexo vacío</strong>, por favor elije una opción.
          </div>';
          break;
        case "4":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Fecha de nacimiento vácia</strong>, por favor seleccione una fecha de nacimiento.
          </div>';
          break;
        case "5":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Peso vacío</strong>, por favor introduce un peso válido.
          </div>';
          break;
        case "6":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Altura vacía</strong>, por favor introduce una altura válida.
          </div>';
          break;
        case "7":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Domicilio vacío</strong>, por favor introduce un domicilio válido.
          </div>';
          break;
        case "8":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Teléfono no válido</strong>, el télefono debe ser de 10 digitos.
          </div>';
          break;
        case "9":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Tipo de suscripción vacío</strong>, por favor elije una opción.
          </div>';
          break;
      }
    }
  }
  ?>

    <div class="container d-flex justify-content-center">
      <form class="col-4" action="index.php?c=usuario&a=insertar" method="POST">
        <fieldset>
          <div class="form-group">
            <label for="nombre" class="form-label mt-2">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej. Juan" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="apellido_p" class="form-label mt-2">Apellido Paterno</label>
            <input type="text" class="form-control" id="apellido_p" name="apellido_p" placeholder="Ej. Salazar" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="apellido_m" class="form-label mt-2">Apellido Materno</label>
            <input type="text" class="form-control" id="apellido_m" name="apellido_m" placeholder="Ej. Corona" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="sexo" class="form-label mt-2">Sexo</label>
            <select class="form-select" id="sexo" name="sexo">
              <option selected disabled>-Seleccionar-</option>
              <option>Femenino</option>
              <option>Masculino</option>
            </select>
          </div>
          <div class="form-group">
            <label for="fecha_nac" class="form-label mt-2">Fecha Nacimiento</label>
            <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" min="1950-01-01" max="<?php $actual = date('Y-m-d'); $nueva = strtotime ('-12 year' , strtotime($actual)); echo date ('Y-m-d', $nueva);?>">
          </div>
          <div class="form-group">
            <label for="peso" class="form-label mt-2">Peso</label>
            <input type="number" min="30" max="250" class="form-control" id="peso" name="peso" placeholder="Ej. 55" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="altura" class="form-label mt-2">Altura</label>
            <input type="number" min="1.00" max="2.30" step="0.01" class="form-control" id="altura" name="altura" placeholder="Ej. 1.60" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="domicilio" class="form-label mt-2">Domicilio</label>
            <input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Ej. Av. Revolución 1500" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="telefono" class="form-label mt-2">Telefono</label>
            <input type="number" min="0" class="form-control" id="telefono" name="telefono" placeholder="Ej. 3310940910" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="tipo_suscripcion" class="form-label mt-2">Tipo de suscripcion</label>
            <select class="form-select" id="tipo_suscripcion" name="tipo_suscripcion">
              <option selected disabled>-Seleccionar-</option>
              <option>1- Mensual - $300</option>
              <option>2- Trimestral - $855</option>
              <option>3- Semestral - $1620</option>
              <option>4- Anual - $2880</option>
            </select>
          </div>
          <div class="form-group">
              <input type="hidden" name="id_empleado" value="<?php echo $_SESSION['usuario']['id_empleado'];?>">
          </div>
          <div class="d-flex justify-content-center mt-2 mb-3">
            <button type="submit" class="btn btn-primary mt-2">Agregar usuario</button>
          </div>
        </fieldset>
      </form>
    </div>

  </div>

</main>

<?php require_once 'includes/footer.php' ?>