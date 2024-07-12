<?php 
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
?>

<main>

  <div class="container">
    <h1 class="text-light text-center mt-2"><strong>Actualizando empleado</strong></h1>

    <div class="d-flex justify-content-between">
      <a href="index.php?c=empleado" class="btn btn-info mb-1">
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
          <strong>Nombre no válido</strong>, por favor introduce un nombre válido.
          </div>';
          break;
        case "2":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Apellido paterno no válido</strong>, por favor introduce un apellido paterno valido.
          </div>';
          break;
        case "3":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Apellido materno no válido</strong>, por favor introduce un apellido materno valido.
          </div>';
          break;
        case "4":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Fecha no válida</strong>, la fecha no puede estar vacia.
          </div>';
          break;
        case "5":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Domicilio no válido</strong>, por favor introduce una domicilio valido.
          </div>';
          break;
        case "6":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Teléfono no válido</strong>, por favor introduce un Teléfono valido.
          </div>';
          break;
        case "7":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Tipo de empleado no válido</strong>, por favor seleccione una opción.
          </div>';
          break;
        case "8":
          echo '<div class="text-center alert alert-dismissible alert-danger mb-1">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Contraseña no válida</strong>, la contraseña no puede estar vacia.
          </div>';
          break;
      }
    }
  }
  ?>

    <div class="container d-flex justify-content-center">
      <form class="col-4" action="index.php?c=empleado&a=actualizar" method="POST">
        <fieldset>
          <div class="form-group">
            <label for="nombre" class="form-label mt-2">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej. Juan" autocomplete="off" value="<?php echo $empleado['nombre'] ?>">
          </div>
          <div class="form-group">
            <label for="apellido_p" class="form-label mt-2">Apellido Paterno</label>
            <input type="text" class="form-control" id="apellido_p" name="apellido_p" placeholder="Ej. Salazar" autocomplete="off" value="<?php echo $empleado['apellido_p']; ?>">
          </div>
          <div class="form-group">
            <label for="apellido_m" class="form-label mt-2">Apellido Materno</label>
            <input type="text" class="form-control" id="apellido_m" name="apellido_m" placeholder="Ej. Corona" autocomplete="off" value="<?php echo $empleado['apellido_m']; ?>">
          </div>
          <div class="form-group">
            <label for="fecha_nac" class="form-label mt-2">Fecha Nacimiento</label>
            <input type="date" class="form-control" id="fecha_nac" name="fecha_nac" min="1950-01-01" max="<?php $actual = date('Y-m-d'); $nueva = strtotime ('-18 year' , strtotime($actual)); echo date ('Y-m-d', $nueva);?>" value="<?php echo str_replace('/', '-', $empleado['fecha_nac']); ?>">
          </div>
          <div class="form-group">
            <label for="domicilio" class="form-label mt-2">Domicilio</label>
            <input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Ej. Av. Revolución 1500" autocomplete="off" value="<?php echo $empleado['domicilio'] ?>">
          </div>
          <div class="form-group">
            <label for="telefono" class="form-label mt-2">Telefono</label>
            <input type="number" min="0" class="form-control" id="telefono" name="telefono" placeholder="Ej. 3310940910" autocomplete="off" value="<?php echo $empleado['telefono'] ?>">
          </div>
          <div class="form-group">
            <label for="tipo" class="form-label mt-2">Tipo de empleado</label>
            <select class="form-select" id="tipo" name="tipo">
              <option selected disabled>-Seleccionar-</option>
              <option <?php if($empleado['tipo'] == 1) echo 'selected';?> >1- Administrador</option>
              <option <?php if($empleado['tipo'] == 2) echo 'selected';?> >2- Recepcionista</option>
              <option <?php if($empleado['tipo'] == 3) echo 'selected';?> >3- Entrenador</option>
            </select>
          </div>
          <div class="form-group">
            <label for="password" class="form-label mt-2">Contraseña</label>
            <input type="password" minlength="8" class="form-control" id="password" name="password" placeholder="Ingresa una constraseña" autocomplete="off">

            <input type="hidden" id="id_empleado" name="id_empleado" value="<?php echo $empleado['id_empleado'];?>">
          </div>
          <div class="d-flex justify-content-center mt-2 mb-3">
            <button type="submit" class="btn btn-primary mt-2">Actualizar empleado</button>
          </div>
        </fieldset>
      </form>
    </div>

  </div>

</main>

<?php require_once 'includes/footer.php' ?>