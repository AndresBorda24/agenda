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
        <div x-data="Citas('<?= $this->user()->info->documento ?>')">
          <div class="form-check">
            <input class="form-check-input" x-model="previous" type="checkbox" id="show-prev">
            <label class="form-check-label" for="show-prev" role="button">
              Mostrar Citas Anteriores
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" x-model="canceled" type="checkbox" id="show-canceled">
            <label class="form-check-label" for="show-canceled" role="button">
              Mostrar Canceladas
            </label>
          </div>

          <ul class="citas-list my-3 p-0 px-2 px-md-3" >
            <template x-for="cita in citasActivas" :key="cita.id">
              <?= $this->fetch("./mis-citas/partials/cita.php") ?>
            </template>
          </ul>
        </div>
      </section>
    </main>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
