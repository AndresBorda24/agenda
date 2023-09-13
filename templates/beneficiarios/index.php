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
    <main class="flex-grow-1 p-3">
      <section class="mx-auto" style="max-width: 700px;">
        <h1  class="fs-5 text-primary">Listado de beneficiarios</h1>
        <div id="new-beneficiario-container" class="mb-3"> </div>

        <ul class="list-group list-group-flush">
          <li class="list-group-item">An item</li>
          <li class="list-group-item">A second item</li>
          <li class="list-group-item">A third item</li>
          <li class="list-group-item">A fourth item</li>
          <li class="list-group-item">And a fifth one</li>
        </ul>
      </section>
    </main>
  </div>

  <?= $this->fetch("./beneficiarios/partials/form.php") ?>
  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
