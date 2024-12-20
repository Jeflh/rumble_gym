<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';

$usuario = $_SESSION['usuario'];
?>

<main>
<div class="panel-usuario">
  <div class="container">
  <link rel="stylesheet" href="src/css/responsive.css">
    <h1 class="text-light text-center mt-2"><strong><?php echo $usuario['nombre'] . ' ' . $usuario['apellido_p'] . ' ' . $usuario['apellido_m']; ?></strong></h1>

    <div class="d-flex justify-content-center">
      <form action="index.php?c=asistencia&a=guardar" method="POST">
        <input type="hidden" id="id" name="id" value="<?php echo $usuario['id_usuario']; ?>">
        <input type="hidden" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>">
        <button type="submit" class="btn btn-info">Confirmar asistencia</button>
      </form>
    </div>

    <!-- Bloque 1 -->
    <div class="d-flex justify-content-center text-center">
      <div class="col-3 card bg-dark text-light mt-3 me-3">
        <div class="card-header">
          <h3 class="card-title">Somatometría</h3>
        </div>
        <div class="card-body">
          <p class="card-text"><strong>Peso: </strong><?php echo $usuario['peso'] . 'kg'; ?></p>
          <p class="card-text"><strong>Estatura: </strong><?php echo $usuario['altura'] . 'mts'; ?></p>
          <p class="card-text"><strong>IMC: </strong><?php echo $usuario['imc']; ?></p>
          <div class="d-flex justify-content-center">
            <a href="index.php?c=asistencia&a=historial&id=<?php echo $usuario['id_usuario']; ?>" class="btn btn-light"> Consultar historial</a>
          </div>
        </div>
      </div>

      <!-- Bloque 2 -->
      <div class="col-3 card bg-dark text-light mt-3">
        <div class="card-header">
          <h3 class="card-title text-center">Suscripción
            <?php $status = fechaEnRango($usuario['fecha_inicio'], $usuario['fecha_fin']);
            if ($status == true) {
              echo '<span class="text-success"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/></svg></span>';
            } else {
              echo '<span class="text-warning"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/></svg></span>';
            }
            ?>
          </h3>
        </div>
        <div class="card-body text-center">
          <h5 class="card-text text-center text-primary">
            <?php
            if ($usuario['tipo_suscripcion'] == '1') {
              echo '<strong>Mensual</strong>';
            } else if ($usuario['tipo_suscripcion'] == '2') {
              echo '<strong>Trimestral</strong>';
            } else if ($usuario['tipo_suscripcion'] == '3') {
              echo '<strong>Semestral</strong>';
            } else if ($usuario['tipo_suscripcion'] == '4') {
              echo '<strong>Anual</strong>';
            }
            ?>
          </h5>
          <p class="card-text"><strong>Inicio: </strong><?php echo date("d-m-Y", strtotime($usuario['fecha_inicio'])); ?></p>
          <p class="card-text"><strong>Fin: </strong><?php echo date("d-m-Y", strtotime($usuario['fecha_fin'])); ?></p>
          <p class="card-text"><strong>Miembro desde: </strong> <?php echo date("d-m-Y", strtotime($usuario['inscrito'])); ?></p>
        </div>
      </div>
    </div>

    <!-- Bloque 3 -->
    <div class="d-flex justify-content-center mb-3">
      <div class="col-2 card bg-dark text-light mt-3 me-3 text-center justify-content-center">
        <div class="card-header">
          <h3 class="card-title">Rutinas</h3>
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-center">
            <a href="index.php?c=rutina&a=crear" class="btn btn-light">Crear rutina</a>
          </div>
          <div class="d-flex justify-content-center mt-4">
            <a href="index.php?c=rutina" class="btn btn-light">Ver mis rutinas</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</main>

<?php require_once 'includes/footer.php' ?>