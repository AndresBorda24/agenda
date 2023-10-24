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
        <?= $this->fetch("./planes/partials/plan/component.php") ?>
      </section>

      <section x-cloak x-show="tab === 3" x-transition.opacity>
        <h2 class="text-center text-primary">Selecciona un medio de pago.</h2>
        <div
        id="medios-de-pago"
        x-data="mp" x-bind="events"
        class="d-flex flex-column gap-3 my-4 mx-auto"
        style="max-width: 400px;">
          <div id="mercadopago"></div>
          <button
          class="planes-next-btn py-2 text-bg-danger"
          @click="cancelPay">Cancelar</button>
        </div>
      </section>
    </section>
  </div>
  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
