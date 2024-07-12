<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
?>

<main>
  <div class="container">
    <h1 class="text-light text-center mt-2"><strong>Punto de venta</strong></h1>
    <div class="d-flex justify-content-between mb-3">
      <a href="index.php" class="btn btn-info">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z" />
        </svg>
      </a>
      <h4 class="text-light"><?php echo $empleado['id_empleado'] . ' - ' . $empleado['nombre'] . ' ' . $empleado['apellido_p'] . ' ' . $empleado['apellido_m']; ?></h4>
    </div>

    <?php
    if (isset($_GET['e'])) {

      $status = $_GET['e'];

      if ($status == '0') {
        echo '<div class="text-center alert alert-dismissible alert-success mb-2">
        <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
        <strong>Venta exitosa</strong>, la venta ha sido confirmada.
        </div>';
        $_SESSION['carrito'] = array();
      }
    }

    if (isset($_POST['monto'])) {
      if ($_POST['monto'] < $_POST['suma'] || $_POST['monto'] == '') {
        echo '<div class="text-center alert alert-dismissible alert-danger mb-2">
        <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
        <strong>Monto insuficiente</strong>, el monto ingresado es menor al total de la venta.
        </div>';
      }
    }

    if (isset($_POST['eliminar'])) {
      $i = 0;
      $find = false;
      foreach ($_SESSION['productos'] as $producto) {
        if ($producto['id_producto'] == $_POST['id_producto']) {
          $find = true;
          break;
        }
        $i++;
      }

      if ($find == true) {
        $_SESSION['productos'][$i]['cantidad'] += 1;
        foreach ($_SESSION['carrito'] as $key => $value) {
          if ($value['id_producto'] == $_POST['id_producto']) {
            unset($_SESSION['carrito'][$key]);
            break;
          }
        }
      }
    }

    if (isset($_POST['codigo'])) {
      if ($_POST['codigo'] != '') {
        if (strlen($_POST['codigo']) == 5) {
          $i = 0;
          $find = false;
          foreach ($_SESSION['productos'] as $producto) {
            if ($producto['id_producto'] == $_POST['codigo']) {
              $find = true;
              break;
            }
            $i++;
          }
          if ($find == true) {
            if ($_SESSION['productos'][$i]['cantidad'] > 0) {
              $_SESSION['productos'][$i]['cantidad'] -= 1;
              array_push($_SESSION['carrito'], $producto);
            } else {
              echo '<div class="text-center alert alert-dismissible alert-danger mb-2">
              <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
              <strong>Producto sin existencias</strong>, el producto ya no se encuentra en inventario.
              </div>';
            }
          } else { // No existe el producto
            echo '<div class="text-center alert alert-dismissible alert-danger mb-2">
            <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
            <strong>Producto no encontrado</strong>, el producto no se encuentra en inventario.
            </div>';
          }
        } else { // Codigo no valido
          echo '<div class="text-center alert alert-dismissible alert-danger mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Código no válido</strong>, el código debe ser de 5 dígitos.
          </div>';
        }
      } else { // Si está vacío
        echo '<div class="text-center alert alert-dismissible alert-danger mb-2">
          <button type="button" class="btn-close " data-bs-dismiss="alert"></button>
          <strong>Código vacío</strong>, ingresa un código de producto válido.
          </div>';
      }
    }
    ?>

    <div class="d-flex justify-content-between">
      <div class="col-6 me-2">
        <table class="table table-dark table-striped table-bordered table-hover text-center">
          <thead>
            <tr>
              <th scope="col" class="col-1">Código</th>
              <th scope="col" class="col-2">Nombre</th>
              <th scope="col" class="col-3">Descripcion</th>
              <th scope="col" class="col-1">Cantidad</th>
              <th scope="col" class="col-1">Precio</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($_SESSION['productos'] as $producto) : ?>
              <tr class="table-default">
                <th scope="row"><?php echo $producto['id_producto']; ?></th>
                <td><?php echo $producto['nombre']; ?></td>
                <td><?php echo $producto['descripcion']; ?></td>
                <td><?php echo $producto['cantidad']; ?></td>
                <td><?php echo '$' . $producto['precio']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="col-5">
        <form action="#" method="POST" class="d-flex">
          <input class="form-control me-sm-2" type="text" placeholder="Introduce código" id="codigo" name="codigo" autocomplete="off">
          <button class="btn btn-info my-2 my-sm-0" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-plus-fill" viewBox="0 0 16 16">
              <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM9 5.5V7h1.5a.5.5 0 0 1 0 1H9v1.5a.5.5 0 0 1-1 0V8H6.5a.5.5 0 0 1 0-1H8V5.5a.5.5 0 0 1 1 0z" />
            </svg></button>
        </form>
        <?php if (count($_SESSION['carrito']) > 0) : ?>
          <div class="mt-2">
            <h4 class="text-center text-light">Carrito de compras</h4>
            <table class="table table-dark table-striped table-hover text-center">
              <thead>
                <tr>
                  <th scope="col" class="col-1">Código</th>
                  <th scope="col" class="col-1">Nombre</th>
                  <th scope="col" class="col-1">Precio</th>
                  <th scope="col" class="col-1">Remover</th>
                </tr>
              </thead>
              <tbody>
                <?php $sumaTotal = 0;
                $i = 0;
                foreach ($_SESSION['carrito'] as $producto) : ?>
                  <tr class="table-default">
                    <th scope="row"><?php echo $producto['id_producto']; ?></th>
                    <td><?php echo $producto['nombre']; ?></td>
                    <td><?php echo '$' . $producto['precio']; ?></td>
                    <td>
                      <form action="#" method="POST">
                        <input type="hidden" name="eliminar" value="1">
                        <input type="hidden" name="id_producto" value="<?php echo $producto['id_producto']; ?>">
                        <button type="submit" class="btn btn-warning">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart-dash-fill" viewBox="0 0 16 16">
                            <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zM6.5 7h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1 0-1z" />
                          </svg>
                        </button>
                      </form>
                    </td>
                  </tr>
                <?php $sumaTotal += $producto['precio'];
                  $i++;
                endforeach; ?>
                <tr>
                  <td></td>
                  <td class="text-end"><strong>Total:</strong> </td>
                  <td>$<?php echo $sumaTotal; ?></td>
                  <td></td>
                </tr>
              </tbody>
            </table>

            <form action="#" method="POST" class="d-flex justify-content-center">
              <input type="hidden" name="suma" value="<?php echo $sumaTotal; ?>">
              <input class="form-control w-50 input-sm text-end" min="0" step="0.01" type="number" name="monto" value="<?php if (isset($_POST['monto'])) echo $_POST['monto'] ?>">
              <div>
                <button class="btn btn btn-success ms-2" type="submit">Ingresar monto</button>
              </div>
            </form>

            <?php if (isset($_POST['monto']) && $_POST['monto'] != '') $cambio = $_POST['monto'] - $sumaTotal; ?>

            <?php if (isset($cambio) && $cambio >= 0) : ?>
              <div class="d-flex justify-content-center">
                <h5 class="text-center text-light mt-2 mb-2"><strong>Cambio:</strong> $<?php echo $cambio; ?></h5>
              </div>
              <form action="index.php?c=venta&a=confirmar" method="POST">
                <input type="hidden" name="id_empleado" value="<?php echo $empleado['id_empleado']; ?>">
                <?php $i = 0;
                foreach ($_SESSION['carrito'] as $producto) : ?>
                  <input type="hidden" name="<?php echo $i; ?>" value="<?php echo $producto['id_producto']; ?>"></input>
                <?php $i++;
                endforeach; ?>
                <input type="hidden" name="fecha_venta" value="<?php echo date('Y-m-d'); ?>">
                <input type="hidden" name="monto_venta" value="<?php echo $sumaTotal; ?>">
                <div class="d-grid">
                  <button class="btn btn btn-success" type="submit">Confirmar pago</button>
                </div>
              </form>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</main>

<?php require_once 'includes/footer.php' ?>