<?php
require_once 'includes/header.php';
require_once 'includes/navLogueado.php';
?>

<main>
  <div class="container">
    <h1 class="text-light text-center mt-4"><strong>Panel de entrenador</strong></h1>
    <div class="d-flex justify-content-center mt-5">
      <div class="col card text-white bg-dark mt-3 me-3" style="max-width: 20rem; text-align: center;">
        <div class="card-header ">
          <h4>Gestión de usuarios</h4>
        </div>
        <div class="card-body">
          <a href="index.php?c=usuario" class="link-light">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
              <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
            </svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</main>

<?php
require_once 'includes/footer.php';
?>