<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php if ($_ENV["APP_ENV"] !== "dev") {
      echo $this->loadAssetsVite("src/main.js");
  } ?>
  <title>Planes</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
      "title" => "Planes",
  ]) ?>
  <div class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>
    <section
      x-data="Tabs( <?= $user->pago?->isPendiente() ? 1 : 2 ?> )"
      x-bind="events"
      class="container flex-grow-1 px-md-3 overflow-auto"
      style="min-height: 60vh;"
    >
      <p class="text-center px-2 py-3 rounded bg-primary-subtle small mt-4 shadow-sm"> Al realizar una compra, usted reconoce y acepta nuestros <?= $this->fetch(
          "./partials/tyc.php"
      ) ?> </p>

      <section
        x-cloak style="max-width: 700px;"
        x-show="tab === 1"
        class="mx-auto mt-4"
        x-transition.opacity
      >
        <h3 class="text-center text-primary mt-3">
          Ya Seleccionaste un plan anteriormente...
        </h3>
        <?= $this->fetch("./planes/partials/pendiente.php") ?>
      </section>

      <section x-cloak x-show="tab === 2" x-transition.opacity @show-gateways="() => tab = 3;">
        <h2 class="text-center text-primary mt-3 fw-bold">Selecciona tu plan</h2>
        <?= $this->fetch("./planes/partials/plan/component.php", [
            "planes" => $planes,
        ]) ?>
      </section>

      <section x-cloak x-show="tab === 3" x-transition.opacity>
        <h2 class="text-center text-primary mt-3 fw-bold">Selecciona tu medio de pago</h2>
        <button class="btn btn-sm text-muted" type="button" @click="tab = 2;">< Volver</button>
        <div class="mx-auto" style="max-width: 800px;">
          <div class="d-grid" style="font-size: 13px;">
            <?= $this->fetch(
                "./planes/partials/medios-pago/gou-micrositio-api.php"
            ) ?>
            <?= $this->fetch(
                "./planes/partials/medios-pago/gou-micrositio.php"
            ) ?>
          </div>
        </div>
      </section>
    </section>
  </div>

  <template id="exclusiones-tmp">
    <ul class="my-3 ps-3">
      <li>Ayudas diagn&oacute;sticas especializadas.</li>
      <li>Material de osteos&iacute;ntesis.</li>
      <li>Medicamentos.</li>
      <li>Dispositivos M&eacute;dicos.</li>
    </ul>
  </template>

  <?php if ($_ENV["APP_ENV"] == "dev"): ?>
    <script type="module" src="http://localhost:5173/@vite/client"></script>
    <script type="module" src="http://localhost:5173/assets/planes/index.js"></script>
  <?php endif; ?>
  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
