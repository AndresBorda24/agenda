<section
  style="max-width: 700px;"
  x-data="GouWebCheckout"
  class="mx-auto p-2 d-flex flex-column gap-3"
>
  <div class="d-flex flex-column flex-sm-row gap-2 small align-items-center">
    <div class="p-2 d-flex flex-column align-items-center" style="min-width: 132px;">
      <img width="80" class="object-fit-contain" src="<?= $this->asset("/img/logo-gou.webp") ?>" alt="logo-gou">
    </div>
    <button
      @click="generateLink"
      class="p-4 border border-dark-subtle text-dark text-decoration-none position-relative bg-body-tertiary rounded"
      style="border-style: dashed !important;"
    >
      <h5>Opción WEB Checkout</h5>
      <p class="m-0 text-muted">
        Serás redirigido a la pasarela de GOU. Una vez completes el pago seras redireccionado de vuelta a nuestro sitio.
      </p>
      <span class="position-absolute top-0 end-0 m-1 lh-1 fs-5"><?= $this->fetch("./icons/link.php") ?></span>
    </button>
  </div>
</section>
