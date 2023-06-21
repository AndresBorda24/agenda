<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("registro-vip/app") ?>
  <title>Inicio de Sesi&oacute;n</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Panel"
  ]) ?>

  <div
  class="align-items-center container d-flex flex-wrap gap-5 justify-content-center my-5"
  style="min-height: 60vh;">

  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
