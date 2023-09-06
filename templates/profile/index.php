<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("profile/app") ?>
  <title>Perfil</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Configuraci&oacute;n Perfil"
  ]) ?>

  <div class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>
    <main class="flex-grow-1 p-3">
      <section class="mx-auto" style="max-width: 700px;">
        <section class="mb-5">
          <?= $this->fetch("./profile/partials/basic.php") ?>
        </section>

        <section>
          <?= $this->fetch("./profile/partials/password.php") ?>
        </section>
      </section>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
