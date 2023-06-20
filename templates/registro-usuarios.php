<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("registro-usuario/app") ?>
  <title>Registro Usuarios</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php") ?>

  <div class="d-lg-flex align-items-center my-4 container" style="min-height: 70vh;">
    <div class="col-lg-6 p-3 p-md-5">
      <div class="w-100 h-100 overflow-hidden rounded shadow registro-usuario-image">
        <img
        loading="lazy"
        src="https://asotrauma.com.co/wp-content/uploads/2022/05/Derecho-01.jpg"
        class="object-fit-cover w-100 h-100"
        alt="">
      </div>
      <span class="p-2 text-center mt-2 text-muted small d-block">
        Trabajamos por tu bienestar y el bienestar de tu familia, por eso en
        la Cl&iacute;nica Asotrauma trabajamos para ti y para todos.
      </span>
    </div>

    <main class="main-container col-lg-6 p-2 p-md-3 p-lg-4">
      <?= $this->fetch("./registro-usuarios/form.php") ?>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
