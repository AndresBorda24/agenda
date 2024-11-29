<main class="flex-grow-1 p-3 p-md-4">
  <header class="mx-auto mb-3" style="max-width: 900px;">
    <h1 class="fs-5 fw-bold text-primary">Solicitud de Citas</h1>
    <p class="mb-0">Aquí puedes realizar la <span class="fw-bold">Solicitud</span> de tus citas o controles. Simplemente sigue los pasos a continuación:</p>
  </header>
  <div
    class="d-lg-grid gap-4 p-3 agemdamiento-container"
    style="max-width: 900px; grid-template-columns: 1fr 1fr;"
  >
    <?= $this->fetch("./agenda/partials/select-user.php", [
      "beneficiarios" => $beneficiarios
    ]) ?>
    <?= $this->fetch("./agenda/partials/select-tipo-atencion.php") ?>
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
    <?= $this->fetch("./agenda/partials/observacion.php") ?>
    <?= $this->fetch("./agenda/partials/confirmar.php") ?>
  </div>
</main>
