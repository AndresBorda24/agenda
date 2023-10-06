<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("login/app") ?>
  <title> <?= match(@$data["status"]) {
      \App\Enums\MpStatus::PENDIENTE->value => "Pendiente Confirmaci&oacute;n",
      \App\Enums\MpStatus::RECHAZADO->value => "Pago Rechazado",
      "error" => "Error en la compra",
      default => "Compra Finalizada"
  } ?></title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Compra Finalizada"
  ]) ?>

  <div class="d-flex p-3 main-container">
    <?= $this->fetch("./partials/aside.php") ?>
    <main class="flex-grow-1 p-3">
      <section class="mx-auto" style="max-width: 700px;">
          <?= $this->fetch( match(@$data["status"]) {
            \App\Enums\MpStatus::APROVADO->value
                    => "./planes/partials/pago-aprobado.php",
            \App\Enums\MpStatus::PENDIENTE->value,
            \App\Enums\MpStatus::EN_PROCESO->value,
            \App\Enums\MpStatus::EN_MEDIACION->value
                    => "./planes/partials/pago-pendiente.php",
            \App\Enums\MpStatus::RECHAZADO->value,
            \App\Enums\MpStatus::NULO->value
                    => "./planes/partials/pago-rechazado.php",
            "error" => "./planes/partials/pago-error.php",
            default => "./planes/partials/pago-pendiente.php"
          }) ?>
      </section>

    </main>


  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
