<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("agenda/app") ?>
  <title>Agendamiento Web</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Agendamiento Citas"
  ]) ?>

  <main class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>
    <div class="flex-grow-1 p-3 p-md-4">
      <header class="mx-auto mb-3" style="max-width: 900px;">
        <h1 class="fs-5 fw-bold text-primary">(Pre) Agendamiento </h1>
        <p class="mb-0">Aquí puedes realizar el <span class="fw-bold">(pre)</span>Agendamiento de tus citas o controles. Simplemente sigue los pasos a continuación:</p>
      </header>
      <div
        class="d-lg-grid gap-4 p-3 agemdamiento-container"
        style="max-width: 900px; grid-template-columns: 1fr 1fr;"
      >
        <?= $this->fetch("./agenda/partials/select-user.php", [
          "beneficiarios" => $beneficiarios
        ]) ?>
        <?= $this->fetch("./agenda/partials/select-tipo-atencion.php", [
          "epsList" => $epsList
        ]) ?>
        <?= $this->fetch("./agenda/partials/clase-consulta.php") ?>
        <?= $this->fetch("./agenda/partials/especialidades.php") ?>

        <div>
          <?= $this->fetch("./agenda/partials/help-calendar.php") ?>
          <?= $this->fetch("./agenda/partials/calendar.php") ?>
        </div>

        <div>
          <?= $this->fetch("./agenda/partials/help-hours.php") ?>
          <?= $this->fetch("./agenda/partials/hours.php") ?>
        </div>

        <?= $this->fetch("./agenda/partials/subir-archivos.php") ?>
        <?= $this->fetch("./agenda/partials/confirmar.php") ?>
      </div>
    </div>
  </main>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
  <?= $this->fetch("./agenda/show-day-hours.php") ?>
</body>
</html>
