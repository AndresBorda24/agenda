<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("planes/app") ?>
  <!-- Mercado Pago -->
  <script src="https://sdk.mercadopago.com/js/v2"></script>
  <title>Planes</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Planes"
  ]) ?>
  <div class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>
    <section
    x-data="Tabs( <?= $user->pago?->isPendiente() ? 1 : 2 ?> )"
    x-bind="events"
    class="container flex-grow-1 px-md-2"
    style="min-height: 60vh;">

      <section
      x-cloak style="max-width: 700px;"
      x-show="tab === 1"
      class="mx-auto"
      x-transition.opacity>
        <h3 class="text-center text-primary mt-3">
          Ya Seleccionaste un plan anteriormente...
        </h3>
        <?= $this->fetch("./planes/partials/pendiente.php", [
          "pref" => $pref
        ]) ?>
      </section>

      <section x-cloak x-show="tab === 2" x-transition.opacity>
        <h2 class="text-center text-primary mt-3">Selecciona tu plan</h2>
        <?= $this->fetch("./planes/partials/plan/component.php", [
          "planes" => $planes
        ]) ?>
      </section>

      <section x-cloak x-show="tab === 3" x-transition.opacity>
        <h2 class="text-center text-primary">Selecciona un medio de pago.</h2>
        <?= $this->fetch("./planes/partials/medios-pago.php") ?>
      </section>

      <section
        x-show="tab === 4"
        x-cloak x-transition.opacity
        style="max-width: 700px;"
        class="mx-auto"
      >
        <button
          @click="tab = 2"
          style="font-size: 10px;"
          class="btn btn-sm btn-dark"
        > < Volver</button>
        <h2 class="text-center text-primary mt-1">Tarjeta Regalo</h2>
        <?= $this->fetch("./planes/partials/regalo.php") ?>
      </section>
    </section>
  </div>
  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
