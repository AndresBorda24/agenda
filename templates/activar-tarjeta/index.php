<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("activar/app") ?>
  <title>Activar Tarjeta</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Activar Mi Tarjeta"
  ]) ?>

  <div class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>

    <main class="flex-grow-1 mx-auto" style="max-width: 700px;">
      <?= $this->fetch("./activar-tarjeta/partials/activar.php") ?>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
