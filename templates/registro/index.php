<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("registro/app") ?>
  <title>Registro Usuarios Fidelizados</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Registro"
  ]) ?>

  <div
  class="d-lg-flex align-items-baseline my-4 container"
  style="min-height: 70vh;">
    <div class="col-lg-6 p-3 p-md-5 sticky-lg-top z-0">
      <span class="p-2 text-center mt-2 text-muted small d-block">
        Trabajamos por tu bienestar y el bienestar de tu familia, por eso en
        la Cl&iacute;nica Asotrauma trabajamos para ti y para todos.
      </span>
      <div class="w-100 h-100 overflow-hidden rounded shadow registro-usuario-image">
        <img
        x-data="Img"
        x-bind="bindings"
        data-src="<?= $this->asset("img/Derecho-01.jpg") ?>"
        class="object-fit-cover w-100 h-100"
        alt="Cl&iacute;nica Asotrauma Imagen Registro">
      </div>
      <span class="small d-block text-center pt-2">
        ¿Ya tienes una cuenta? Inicia Sesi&oacute;n
        <a
        href="<?= $this->link("login") ?>"
        style="font-size: .75rem;"
        class="btn btn-warning btn-sm m-auto">
          Aqu&iacute;!
        </a>
      </span>
    </div>

    <main class="main-container col-lg-6 p-2 p-md-3 p-lg-4">
      <?= $this->fetch("./registro/components/form.php") ?>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
