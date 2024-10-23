<main
  x-data="Tabs( <?= $user->pago?->isPendiente() ? 1 : 2 ?> )"
  x-bind="events"
  class="container flex-grow-1 px-md-3 overflow-auto"
  style="min-height: 60vh;"
>
  <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 mt-6" role="alert">
    <span class="[&>svg]:h-4 me-3">
      <?= $this->fetch('./icons/important.php') ?>
    </span>
    <div>
      <span class="font-bold">Importante!</span>
      Al realizar una compra, usted reconoce y acepta nuestros <?= $this->fetch("./partials/tyc.php") ?>
    </div>
  </div>

  <section
    x-cloak style="max-width: 700px;"
    x-show="tab === 1"
    class="mx-auto mt-4"
    x-transition.opacity
  >
    <span class="text-neutral-600 text-sm">
      Ya Seleccionaste un plan anteriormente...
    </span>
    <?= $this->fetch("./planes/partials/pendiente.php") ?>
  </section>

  <section x-cloak x-show="tab === 2" x-transition.opacity @show-gateways="() => tab = 3;">
    <h2 class="text-center text-primary mt-3 fw-bold">Selecciona tu plan</h2>

    <div class="max-w-4xl mx-auto">
      <?= $this->fetch("./planes/partials/plan/component.php", [
          "planes" => $planes,
          "planColaboradorId" => $planColaboradorId
      ]) ?>

      <?= $this->fetch('./planes/partials/plan/beneficios-exclusiones.php') ?>
    </div>
  </section>

  <section x-cloak x-show="tab === 3" x-transition.opacity>
    <h2 class="text-center text-primary mt-3 fw-bold">Selecciona tu medio de pago</h2>
    <div class="mx-auto max-w-3xl">
      <button
        class="text-xs text-neutral-400 hover:text-neutral-600 transition-colors duration-150 !px-3 !py-1 rounded"
        type="button"
        @click="tab = 2"
      >&#10094; Volver</button>

      <div class="d-grid">
        <?= $this->fetch(
            "./planes/partials/medios-pago/gou-micrositio-api.php"
        ) ?>
        <?= $this->fetch(
            "./planes/partials/medios-pago/gou-micrositio.php"
        ) ?>
      </div>
    </div>
  </section>
</main>
