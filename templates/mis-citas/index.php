<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("citas/app") ?>
  <title>Mis Citas</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Citas Agendadas"
  ]) ?>

  <div class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>
    <main class="flex-grow-1 p-3">
      <section class="mx-auto" style="max-width: 1000px;">
        <h1 class="fs-5 fw-bold text-primary">Citas Agendadas</h1>
        <?= $this->fetch("./mis-citas/partials/nota.php") ?>
        <div x-data="Citas" @cita-canceled.document="citaCanceled">
          <?= $this->fetch("./mis-citas/partials/filtros.php", [
            "beneficiarios" => $beneficiarios
          ]) ?>

          <span class="badge text-bg-warning">
            Total citas:
            <span x-text="totalCitas"></span>
          </span>

          <ul class="citas-list my-3 p-0">
            <template x-for="cita in citasActivas" :key="cita.id + cita.estado">
              <?= $this->fetch("./mis-citas/partials/cita.php") ?>
            </template>
          </ul>
        </div>
      </section>
    </main>
  </div>

  <?= $this->fetch("./mis-citas/partials/modal-cancelar.php") ?>
  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
