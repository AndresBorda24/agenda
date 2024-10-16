<main
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
  <template id="exclusiones-tmp">
    <ul class="my-3 ps-3">
      <li>Ayudas diagn&oacute;sticas especializadas.</li>
      <li>Material de osteos&iacute;ntesis.</li>
      <li>Medicamentos.</li>
      <li>Dispositivos M&eacute;dicos.</li>
    </ul>
  </template>
</main>
