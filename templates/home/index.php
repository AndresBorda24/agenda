<main
  class="flex-grow-1 mx-auto px-4 overflow-auto"
  style="max-width: 1000px;"
>
  <section class="pt-5">
    <span class="d-block mb-5 fw-bold text-primary fs-1 text-center">Programa de Fidelización</span>
    <div
      class="d-flex d-lg-grid p-4 bg-blue-800 p-5 flex-column gap-4 rounded justify-content-center mx-auto align-items-center"
      style="grid-template-columns: 1fr 1fr; justify-items: center"
    >
      <p class="text-center m-0 fs-5 fw-light" style="text-wrap: balance; color: var(--blue-50)">
        Es un programa pensado para un momento de la vida, en el que se quiera acceder a nuestros servicios directamente sin intermediarios, de manera oportuna y personalizada brindando una atención segura, efectiva y con calidad.
      </p>
      <div class="flex flex-column align-items-center gap-4">
        <span style="font-size: 10rem" class="text-warning flex-1 lh-1"><?= $this->fetch('./icons/heart.php') ?></span>
        <?php if(! $this->user()->pago?->isValid()): ?>
          <a
            href="<?= $this->link('planes') ?>"
            class="d-block mx-auto btn btn-warning shadow-lg px-5"
          >Ver los Planes</a>
        <?php else: ?>
          <span class="d-block mx-auto fw-bold fs-5 text-center text-warning p-1 rounded">
            Gracias por confiar en el <br>
            Programa de Fidelización.
          </span>
        <?php endif ?>
      </div>
    </div>
  </section>
  <div class="table-responsive">
    <?= $this->fetch('./index/partials/section-beneficios.php') ?>
  </div>

  <hr class="my-5">

  <div
    class="mb-4 p-2 p-md-4 p-lg-5 rounded-2 text-light bg-blue-800 shadow"
    style="width: fit-content;"
  >
    <?= $this->fetch('./home/partials/folleto.php') ?>
    <?= $this->fetch('./home/partials/slider-info.php') ?>
  </div>
</main>
