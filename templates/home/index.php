<main
  class="flex-grow-1 mx-auto px-4 overflow-auto"
  style="max-width: 1000px;"
>
  <section class="pt-5 mb-6">
    <span class="d-block mb-5 fw-bold text-primary fs-1 text-center">Programa de Fidelización</span>
    <div
      class="d-flex d-lg-grid p-4 flex-column gap-4 rounded justify-content-center mx-auto align-items-center"
      style="grid-template-columns: 1fr 1fr; justify-items: center"
    >
      <div class="max-w-[350px] lg:max-w-[90%] h-auto rounded overflow-hidden">
        <img
          src="/img/Derecho-01.jpg"
          alt="Fidelización | Enfermera y paciente"
        >
      </div>
      <div class="max-w-md">
        <p class="m-0 text-base mb-4 text-pretty px-4 text-neutral-800">
          Es un programa pensado para un momento de la vida, en el que se quiera acceder a nuestros servicios directamente sin intermediarios, de manera oportuna y personalizada brindando una atención segura, efectiva y con calidad.
        </p>
        <?php if(! $this->user()->pago?->isValid()): ?>
          <a
            href="<?= $this->link('planes') ?>"
            class="flex gap-2 justify-center items-center mx-auto shadow-lg py-2 px-4 bg-yellow-400 text-neutral-800 text-sm text-center rounded-md outline-2 outline-yellow-500 outline-offset-2 hover:outline focus-within:outline focus:outline focus-visible:outline hover:shadow-none"
          >
            <span><?= $this->fetch('icons/plans.php') ?></span>
            <span>Ver Planes</span>
          </a>
        <?php else: ?>
          <span class="flex flex-col gap-2 items-center justify-center rounded shadow-[0_8px_30px_rgb(0,0,0,0.12)] bg-gradient-to-r from-yellow-100 to-cyan-100 py-4 px-8">
            <span class="[&>svg]:h-6 [&>svg]:w-6"><?= $this->fetch('icons/star.php') ?></span>
            <span class="leading-tight text-base text-center">Gracias por hacer parte del Programa de Fidelización.</span>
          </span>
        <?php endif ?>
      </div>
    </div>
  </section>

  <div class="flex flex-col gap-10">
    <div>
      <?= $this->fetch('./home/partials/folleto.php') ?>
    </div>

    <div class="table-responsive">
      <?= $this->fetch('./index/partials/section-beneficios.php') ?>
    </div>

    <div
      class="py-7 px-4 rounded mb-[100px] mx-auto"
      style="width: fit-content;"
    >
      <?= $this->fetch('./home/partials/slider-info.php') ?>
    </div>
  </div>
</main>
