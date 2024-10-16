<section
  style="max-width: 700px;"
  class="mx-auto p-2 d-flex flex-column gap-3"
>
  <div class="d-flex flex-column flex-sm-row gap-2 small align-items-center">
    <div class="p-2 d-flex flex-column align-items-center" style="min-width: 132px;">
      <img width="80" class="object-fit-contain" src="<?= $this->asset("/img/logo-gou.webp") ?>" alt="logo-gou">
      <span class="fw-bold text-nowrap">
        Importante
        <span
          data-tippy-content="Con esta opción tu pago puede tardar un tiempo en verse reflejado en la plataforma mientras se realizan las validaciones."
          id="alerta-gow-micrositio"
          class="text-bg-warning badge"
        >!</span>
      </span>
    </div>
    <button
      x-data
      @click="() => window.location.href = '<?= $this->link('pago.gow-micrositio') ?>'"
      class="p-4 !border border-dashed border-neutral-300 text-black relative bg-neutral-50 rounded text-start hover:shadow-lg transition-all duration-200 hover:border-neutral-500"
      style="border-style: dashed !important;"
    >
      <h5 class="mb-3">Opción Micrositio Gou</h5>
      <p class="m-0 text-muted text-sm leading-snug">
        Únicamente debes llenar el formulario con tus datos, seleccionar el plan que quieras, digitar tu información de pago y <b>¡listo!</b>
      </p>
      <span class="position-absolute top-0 end-0 m-1 lh-1 fs-5"><?= $this->fetch("./icons/link.php") ?></span>
    </button>
  </div>
</section>
