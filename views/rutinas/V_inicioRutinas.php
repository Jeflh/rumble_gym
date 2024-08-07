<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
$usuario = $_SESSION['usuario'];
//$rutina = $_SESSION['rutina'];
?>

<main>
  <div class="container">
    <h1 class="text-light text-center mt-4"><strong>Rutinas</strong></h1>
    <h2 class="text-light text-center mt-2">Tipo de rutina: Pendiente
    <?php 
    ?>

    
    </h2>
      <!-- Dia 1 -->
      <h4> <strong> Día 1 </strong> </h4>
      <div class="d-flex justify-content-center mt-4">
        <!-- IMAGEN Ejercicio 1 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 30rem; text-align: center;">
          <div class="card-header ">
            <h4>Ejercicio 1</h4>
          </div>
          <div class="card-body ">
            
              <img src="<?php echo $rutinas['imagen_url'] ?>" width="100" height="100" class="bi bi-person-vcard" viewBox="0 0 16 16">
                <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
                <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
              </svg>
            </a>
          </div>
        </div>


        <!-- DESCRIPCION Ejercicio 1 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 90rem; text-align: center;">
          <div class="card-header ">
            <h4>Descripción</h4>
          </div>
          <div class="card-body">
            <div class="card-text">
            <strong>Descripcion: </strong><?php echo $usuario['id_usuario']; ?>
            </div>
              

          </div>
        </div>
      </div>
    
      <!-- Dia 2 -->
      <div class="d-flex justify-content-center mt-4">
        <!-- IMAGEN Ejercicio 1 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 30rem; text-align: center;">
          <div class="card-header ">
            <h4>Ejercicio 2</h4>
          </div>
          <div class="card-body">
              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
              </svg>
            </a>
          </div>
        </div>
    
        <!-- DESCRIPCION Dia 2 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 95rem; text-align: center;">
          <div class="card-header ">
            <h4>Descripción</h4>
          </div>
          <div class="card-body">
            <div class="card-text">
              <strong>Descripcion: </strong><?php echo $usuario['id_usuario']; ?>
            </div>
          </div>
        </div>
      </div>

    
      <!-- Dia 3 -->
      <div class="d-flex justify-content-center mt-4">
        <!-- IMAGEN Ejercicio 1 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 30rem; text-align: center;">
          <div class="card-header ">
            <h4>Ejercicio 3</h4>
          </div>
          <div class="card-body">
              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
              </svg>
            </a>
          </div>
        </div>
    
        <!-- DESCRIPCION Ejercicio 3 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 95rem; text-align: center;">
          <div class="card-header ">
            <h4>Descripción</h4>
          </div>
          <div class="card-body">
            <div class="card-text">
              <strong>Descripcion: </strong><?php echo $usuario['id_usuario']; ?>
            </div>
          </div>
        </div>
      </div>



    <!-- Dia 4 -->
      <div class="d-flex justify-content-center mt-4">
        <!-- IMAGEN Ejercicio 1 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 30rem; text-align: center;">
          <div class="card-header ">
            <h4>Ejercicio 4</h4>
          </div>
          <div class="card-body">
              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
              </svg>
            </a>
          </div>
        </div>
    
        <!-- DESCRIPCION Ejercicio 4 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 95rem; text-align: center;">
          <div class="card-header ">
            <h4>Descripción</h4>
          </div>
          <div class="card-body">
            <div class="card-text">
              <strong>Descripcion: </strong><?php echo $usuario['id_usuario']; ?>
            </div>
          </div>
        </div>
      </div>
  
    <h4 class="mt-3"> <strong> Día 2</strong> </h4>
    <!-- Dia 5 -->
      <div class="d-flex justify-content-center mt-4">
        <!-- IMAGEN Ejercicio 1 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 30rem; text-align: center;">
          <div class="card-header ">
            <h4>Ejercicio 5</h4>
          </div>
          <div class="card-body">
              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
              </svg>
            </a>
          </div>
        </div>
    
        <!-- DESCRIPCION Ejercicio 5 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 95rem; text-align: center;">
          <div class="card-header ">
            <h4>Descripción</h4>
          </div>
          <div class="card-body">
            <div class="card-text">
              <strong>Descripcion: </strong><?php echo $usuario['id_usuario']; ?>
            </div>
          </div>
        </div>
      </div>
    



    <!-- Dia 6 -->
      <div class="d-flex justify-content-center mt-4">
        <!-- IMAGEN Ejercicio 1 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 30rem; text-align: center;">
          <div class="card-header ">
            <h4>Ejercicio 6</h4>
          </div>
          <div class="card-body">
              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
              </svg>
            </a>
          </div>
        </div>
    
        <!-- DESCRIPCION Ejercicio 6 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 95rem; text-align: center;">
          <div class="card-header ">
            <h4>Descripción</h4>
          </div>
          <div class="card-body">
            <div class="card-text">
              <strong>Descripcion: </strong><?php echo $usuario['id_usuario']; ?>
            </div>
          </div>
        </div>
      </div>
    
    

    <!-- Dia 7 -->
      <div class="d-flex justify-content-center mt-4">
        <!-- IMAGEN Ejercicio 1 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 30rem; text-align: center;">
          <div class="card-header ">
            <h4>Ejercicio 7</h4>
          </div>
          <div class="card-body">
              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
              </svg>
            </a>
          </div>
        </div>
    
        <!-- DESCRIPCION Ejercicio 7 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 95rem; text-align: center;">
          <div class="card-header ">
            <h4>Descripción</h4>
          </div>
          <div class="card-body">
            <div class="card-text">
              <strong>Descripcion: </strong><?php echo $usuario['id_usuario']; ?>
            </div>
          </div>
        </div>
      </div>


      <!-- Día 3 -->
      <h4> <strong> Día 3 </strong> </h4>
      <div class="d-flex justify-content-center mt-4">
        <!-- IMAGEN Ejercicio 1 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 30rem; text-align: center;">
          <div class="card-header ">
            <h4>Ejercicio 1</h4>
          </div>
          <div class="card-body ">
            
              <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-vcard" viewBox="0 0 16 16">
                <path d="M5 8a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm4-2.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5ZM9 8a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4A.5.5 0 0 1 9 8Zm1 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5Z" />
                <path d="M2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H2ZM1 4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H8.96c.026-.163.04-.33.04-.5C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1.006 1.006 0 0 1 1 12V4Z" />
              </svg>
            </a>
          </div>
        </div>


        <!-- DESCRIPCION Ejercicio 1 -->
        <div class="col card text-white bg-dark me-2" style="max-width: 90rem; text-align: center;">
          <div class="card-header ">
            <h4>Descripción</h4>
          </div>
          <div class="card-body">
            <div class="card-text">
              <strong>Descripcion: </strong><?php echo $usuario['id_usuario']; ?>
            </div>
          </div>
        </div>
      </div>



  </div>


    <div class="d-flex text-center justify-content-center mt-5">
      <a href="index.php?c=panel" class="btn btn-light">VOLVER A PANEL</a>
    </div>

  </div>
</main>

<?php
require_once 'includes/footer.php';
?>