<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("login/app") ?>
  <title>Compra Finalizada</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Compra Finalizada"
  ]) ?>

  <div
  x-data="Planes"
  class="container my-5"
  style="min-height: 60vh;">
    <pre>
      <?= print_r($data) ?>
    </pre>
    <?php if($data["status"] === \App\Enums\MpStatus::APROVADO->value): ?>
      <?= $this->fetch("./planes/partials/pago-aprobado.php") ?>
    <?php elseif($data["status"] === \App\Enums\MpStatus::PENDIENTE->value): ?>
      <?= $this->fetch("./planes/partials/pago-pendiente.php") ?>
    <?php elseif($data["status"] === \App\Enums\MpStatus::RECHAZADO->value): ?>
      <?= $this->fetch("./planes/partials/pago-rechazado.php") ?>
    <?php else: ?>
    <?php endif ?>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
