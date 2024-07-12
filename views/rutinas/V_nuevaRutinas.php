<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
$usuario = $_SESSION['usuario'];
?>


<main>
  <div class="container">
    <h1 class="text-light text-center mt-2"><strong><?php echo $usuario['nombre'] . ' ' . $usuario['apellido_p'] . ' ' . $usuario['apellido_m'];?></strong></h1>
    <!-- col-1  -->
    <div class="d-flex card bg-dark text-light mt-3">
        <div class="card-header text-center justify-content-center">
          <h3 class="card-title">NUEVA RECOMENDACION DE RUTINA SEMANAL</h3>
        </div>
        
        <div class="card-body">
          <form class="mt-2" action="" method="">

            <!-- Campo 1 -->
            <div class="form-group mt-3">
              <label for="nombre" class="form-label ">Nombre</label>
              <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej. Rutina 1" autocomplete="off">
            </div>
            <!-- Campo 2 -->
            <div class="form-group mt-3">
              <label for="tipo" class="form-label">Tipo de Rutina</label>
              <select class="form-select" id="tipo" name="tipo">
                <option value="1">Cardio</option>
                <option value="2">Fuerza y Resistencia</option>
                <option value="3">Flexibilidad</option>
              </select>
            </div>
            <!-- Campo 3 -->
            <div class="form-group mt-3">
              <label for="dias" class="form-label">Dias Disponibles por Semana</label>
              <select class="form-select" id="tipo" name="tipo">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
              </select>
            </div>

            <!-- Campo 4 -->
            <div class="form-group mt-3">
              <label for="duracion" class="form-label">Duración de las Sesiones de Entrenamiento (Por Día)</label>
              <select class="form-select" id="tipo" name="tipo">
                <option value="1">30 Minutos</option>
                <option value="2">45 Minutos</option>
                <option value="3">60 Minutos</option>
                <option value="4">Más de 60 Minutos</option>
              </select>
            </div>
            <!-- Campo 5 -->
            <div class="form-group mt-3">
              <label for="tipo" class="form-label">Dificultad</label>
              <select class="form-select" id="tipo" name="tipo">
                <option value="1">Principiante</option>
                <option value="2">Intermedio</option>
                <option value="3">Avanzado (Atleta)</option>
              </select>
            </div>

            <!-- Boton Rutinas -->
            <div class="d-flex justify-content-center mt-5 mb-7">
              <button type="submit" class="btn btn-primary">Crear rutina</button>
            </div>
          </form>
        </div>

   
    </div>
    <!-- me-5 -->
    <div class="d-flex text-center justify-content-center mt-5">
      <a href="index.php?c=panel" class="btn btn-light">VOLVER A PANEL</a>
    </div>
  </div>
</main>

<?php
require_once 'includes/footer.php';
?>