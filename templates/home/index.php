<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("home/app") ?>
  <title>Home</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Home"
  ]) ?>

  <div class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>

    <main class="flex-grow-1 p-3">
      <pre>
        <?= print_r($this->auth()->user()->isFromIntranet() ) ?>
      </pre>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
