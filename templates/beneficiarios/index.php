<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("beneficiarios/app") ?>
  <title>Gesti&oacute;n Beneficiarios</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Mis Beneficiarios"
  ]) ?>

  <div class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
