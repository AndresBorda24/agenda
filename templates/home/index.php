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

  <div class="d-flex p-3 main-container">
    <?= $this->fetch("./partials/aside.php") ?>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
