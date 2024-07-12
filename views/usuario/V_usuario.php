<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
?>

<main>
  <div class="container">
    <h1 class="text-light text-center mt-2"><strong><?php echo  $usuario['id_usuario'] . ' - ' . $usuario['nombre'] . ' ' . $usuario['apellido_p'] . ' ' . $usuario['apellido_m']; ?></strong></h1>

    <div class="d-flex justify-content-between mb-3">
      <a href="index.php?c=usuario" class="btn btn-info">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
        </svg>
      </a>
      <?php if ($usuario['tipo_suscripcion'] == '1') {
        $costo = 300;
      } else if ($usuario['tipo_suscripcion'] == '2') {
        $costo = 855;
      } else if ($usuario['tipo_suscripcion'] == '3') {
        $costo = 1620;
      } else if ($usuario['tipo_suscripcion'] == '4') {
        $costo = 2880;
      }
      ?>
      <a class="btn btn-light me-1" href="index.php?c=usuario&a=renovar&id=<?php echo $usuario['id_usuario']  . '&em=' . $_SESSION['usuario']['id_empleado'] . '&m=' . $costo; ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
          <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
        </svg> Renovar suscripción
      </a>

      <a class="btn btn-primary me-1 text-light" href="index.php?c=usuario&a=editar&id=<?php echo $usuario['id_usuario']; ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
          <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
        </svg> Editar información
      </a>

      <a class="btn btn-danger me-1 text-light" href="index.php?c=usuario&a=cambiarEstado&id=<?php echo $usuario['id_usuario'] . '&s=' . $usuario['estado']; ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
        </svg> Cambiar estado del usuario
      </a>

      <a class="btn btn-warning text-light" href="index.php?c=usuario&a=eliminar&id=<?php echo $usuario['id_usuario']; ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
          <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
        </svg> Eliminar usuario
      </a>
    </div>
  </div>

  <h2 class="text-light text-center mt-2"><strong>Detalles de usuario</strong></h2>

  <div class="d-flex justify-content-center text-center">
    <div class="col-3 card bg-dark text-light mt-1 me-3">
      <div class="card-header">
        <h3 class="card-title">Somatometría</h3>
      </div>
      <div class="card-body">
        <p class="card-text"><strong>Peso: </strong><?php echo $usuario['peso'] . 'kg'; ?></p>
        <p class="card-text"><strong>Estatura: </strong><?php echo $usuario['altura'] . 'mts'; ?></p>
        <p class="card-text"><strong>IMC: </strong><?php echo $usuario['imc']; ?></p>
      </div>
    </div>

    <div class="col-3 card bg-dark text-light mt-1">
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
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-center">
    <div class="col-4 card bg-dark text-light mt-3 mb-3 ">
      <div class="card-header">
        <h3 class="card-title text-center">Datos personales</h3>
      </div>
      <div class="card-body">
        <p class="card-text"><strong>Estado: </strong><?php echo $estado = ($usuario['estado'] == '1') ? 'Activo ' : 'Inactivo '; ?>
          <?php
          if ($usuario['estado'] == '1') {
            echo '<span class="text-success"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/></svg></span>';
          } else if ($usuario['estado'] == '0') {
            echo '<span class="text-warning"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-dash-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
              </svg></span>';
          }
          ?></p>
        <p class="card-text"><strong>Código: </strong><?php echo $usuario['id_usuario']; ?></p>
        <p class="card-text"><strong>Nombre: </strong><?php echo $usuario['nombre'] . ' ' . $usuario['apellido_p'] . ' ' . $usuario['apellido_m']; ?></p>
        <p class="card-text"><strong>Sexo: </strong><?php echo $sexo = ($usuario['sexo'] == 'M') ? 'Masculino' : 'Femenino' ?></p>
        <p class="card-text"><strong>Fecha de nacimiento: </strong><?php echo date("d-m-Y", strtotime($usuario['fecha_nac'])); ?></p>
        <p class="card-text"><strong>Domicilio: </strong><?php echo $usuario['domicilio']; ?></p>
        <p class="card-text"><strong>Teléfono: </strong><?php echo $usuario['telefono']; ?></p>
        <p class="card-text"><strong>Miembro desde: </strong> <?php echo date("d-m-Y", strtotime($usuario['inscrito'])); ?></p>
      </div>
    </div>
  </div>
  </div>
</main>

<?php require_once 'includes/footer.php' ?>