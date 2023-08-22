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

  <div
  x-data="Planes"
  class="container my-5"
  style="min-height: 60vh;">
    <h1 class="text-center text-primary mb-5">Selecciona tu plan</h1>

    <form
    x-show="planesLoaded"
    x-transition
    @submit.prevent>
      <div class="planes-container row-cols-12 row-cols-md-4  p-4">
        <template x-for="(plan, index) in planes" :key="plan.id">
          <section
          :class="{'planes-item-checked border-primary': (selectedPlan == plan.id) }"
          class="bg-white d-flex flex-column border rounded-1 planes-item overflow-hidden">

            <?= $this->fetch("./planes/partials/plan-header.php") ?>
            <?= $this->fetch("./planes/partials/plan-beneficios.php") ?>
            <?= $this->fetch("./planes/partials/plan-footer.php") ?>

          </section>
        </template>
      </div>

      <div class="mt-5">
        <button
        type="submit"
        class="planes-next-btn">
          Continuar
        </button>
      </div>
    </form>

    <!-- Esto es de mercado pago -->
    <div id="wallet_container"></div>

    <a
    class="text-muted small"
    href="<?= $this->link("agenda") ?>">
      Cancelar (Continuar con el plan gratuito)
    </a>
  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
</body>
</html>
