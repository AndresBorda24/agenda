<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("planes/app") ?>
  <title>Planes</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Redimir Código de Regalo"
  ]) ?>
  <div class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>
    <section
      class="container flex-grow-1 px-md-2 overflow-auto"
      style="min-height: 60vh;"
    >
      <section style="max-width: 700px;" class="mx-auto py-4 px-3">
        <h3>Códigos de regalo Fidelización</h3>
        <p class="text-muted">
          Si tienes un código de regalo para uno de los planes del "<b>Programa de Fidelización</b>" solamente debes digitar el código y luego redimir:
        </p>
        <?= $this->fetch("./planes/partials/regalo.php") ?>
      </section>
    </section>
  </div>
  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
