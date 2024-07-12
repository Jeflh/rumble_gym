<?php 
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
?>

<main>
  <div class="container">
    <h1 class="text-light text-center mt-2"><strong>Gestión de usuarios</strong></h1>

    <div class="d-flex justify-content-between mb-3">
      <a href="index.php" class="btn btn-info">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
        </svg>
      </a>
      <form action="index.php?c=usuario&a=buscar" method="POST" class="d-flex ms-5">
        <input class="form-control me-sm-2 ms-5" type="text" placeholder="Introduce código" maxlength="5" id="id" name="id" autocomplete="off">
        <button class="btn btn-info my-2 my-sm-0" type="submit">Buscar</button>
      </form>
      <a href="index.php?c=usuario&a=nuevo" class="btn btn-info">Agregar usuario</a>
    </div>

    <?php
    if (isset($_GET['e'])) {

      $status = $_GET['e'];
      $arrayValues = str_split($status);
      // Se convierte el string en un array para poder evaluar cada caso.
      for ($i = 0; $i < count($arrayValues); $i++) {
        switch ($arrayValues[$i]) { // Se evalua cada caso y muestra la alerata correspondiente
          case "0":
            echo '<div class="text-center alert alert-dismissible alert-success mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Usuario registrado</strong>, el usuario ha sido registrado correctamente.
          </div>';
            break;
          case "1":
            echo '<div class="text-center alert alert-dismissible alert-success mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Usuario actualizado</strong>, el usuario ha sido actualizado correctamente.
          </div>';
            break;
          case "2":
            echo '<div class="text-center alert alert-dismissible alert-success mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Usuario eliminado</strong>, el usuario ha sido eliminado correctamente.
          </div>';
            break;
          case "3":
            echo '<div class="text-center alert alert-dismissible alert-success mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Estado actualizado</strong>, el estado del usuario ha sido actualizado.
          </div>';
            break;
          case "4":
            echo '<div class="text-center alert alert-dismissible alert-success mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Suscripcion renovada</strong>, la suscripcion del usuario ha sido renovada.
          </div>';
            break;
          case "5":
            echo '<div class="text-center alert alert-dismissible alert-danger mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Código no válido</strong>, debes introducir un código numérico de 5 digitos.
          </div>';
            break;
          case "6":
            echo '<div class="text-center alert alert-dismissible alert-danger mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Usuario no encontrado</strong>, no se encontraron coincidencias con la busqueda.
          </div>';
            break;
        }
      }
    }
    ?>
    <table class="table table-dark table-striped table-bordered table-hover text-center">
      <thead>
        <tr>
          <th scope="col" class="col">Código</th>
          <th scope="col" class="col">Estado</th>
          <th scope="col" class="col-4">Nombre</th>
          <th scope="col" class="col">Suscripción</th>
          <th scope="col" class="col">Tipo</th>
          <th scope="col" class="col">Vence</th>
          <th scope="col" class="col-2">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($usuarios as $usuario) : ?>
          <tr class="table-default">
            <th scope="row"><a class="text-info" href="index.php?c=usuario&a=ver&id=<?php echo $usuario['id_usuario']; ?>"><?php echo $usuario['id_usuario']; ?></a></th>
            <td><?php
                if ($usuario['estado'] == '1') {
                  echo '<h5><span class="badge bg-success">Activo</span></h5>';
                } else if ($usuario['estado'] == '0') {
                  echo '<h5><span class="badge bg-danger">Inactivo</span></h5>';
                }
                ?>
            </td>
            <td><?php echo $usuario['nombre'] . ' ' . $usuario['apellido_p'] . ' ' . $usuario['apellido_m']; ?></td>
            <td><?php
                $status = fechaEnRango($usuario['fecha_inicio'], $usuario['fecha_fin']);
                if ($status == true) {
                  echo '<h5><span class="badge bg-success">Activa</span></h5>';
                } else {
                  echo '<h5><span class="badge bg-danger">Inactiva</span></h5>';
                }
                ?>
            </td>
            <td>
              <?php if ($usuario['tipo_suscripcion'] == '1') {
                $costo = 300;
                echo 'Mensual ';
              } else if ($usuario['tipo_suscripcion'] == '2') {
                $costo = 855;
                echo 'Trimestral ';
              } else if ($usuario['tipo_suscripcion'] == '3') {
                $costo = 1620;
                echo 'Semestral ';
              } else if ($usuario['tipo_suscripcion'] == '4') {
                $costo = 2880;
                echo 'Anual ';
              }
              ?>
            </td>
            <td><?php echo date("d-m-Y", strtotime($usuario['fecha_fin'])); ?></td>

            <td>
              <a class="btn btn-light btn-sm me-1" href="index.php?c=usuario&a=renovar&id=<?php echo $usuario['id_usuario']  . '&em=' . $_SESSION['usuario']['id_empleado'] . '&m=' . $costo; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
                  <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
                </svg>
              </a>

              <a class="btn btn-primary btn-sm me-1 text-light" href="index.php?c=usuario&a=editar&id=<?php echo $usuario['id_usuario']; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                  <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                </svg>
              </a>

              <a class="btn btn-danger btn-sm me-1 text-light" href="index.php?c=usuario&a=cambiarEstado&id=<?php echo $usuario['id_usuario'] . '&s=' . $usuario['estado']; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z" />
                </svg>
              </a>

              <a class="btn btn-warning btn-sm text-light" href="index.php?c=usuario&a=eliminar&id=<?php echo $usuario['id_usuario']; ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
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