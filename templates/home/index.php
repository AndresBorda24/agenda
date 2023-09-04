<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("home/app") ?>
  <title>Inicio de Sesi&oacute;n</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Panel"
  ]) ?>

  <div
  class="d-flex p-3 main-container"
  style="min-height: 60vh;">

    <aside class="bg-secondary rounded shadow-lg aside">
      <div class="d-flex flex-column gap-2 flex-grow-1">
        <a href="#" class="fs-6">
           <div class="bg-warning rounded-circle radio-1" style="height: 16px; width: 16px;"></div>
           <span>Mi perfil</span>
        </a>

        <hr class="border-light m-0">

        <a href="<?= $this->link("home") ?>" >
          <?= $this->fetch("./icons/home.php") ?> Home
        </a>
        <a href="<?= $this->link("planes") ?>">
          <?= $this->fetch("./icons/plans.php") ?> Planes
        </a>
        <a href="<?= $this->link("agenda") ?>">
          <?= $this->fetch("./icons/agenda.php") ?> Agendamiento
        </a>
      </div>

      <form action="/logout" method="post">
        <button type="submit" class="btn btn-danger border-0 btn-sm w-100">
          Cerrar Sesión!
        </button>
      </form>
    </aside>


  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
