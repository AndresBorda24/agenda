<section
  style="max-width: 700px;"
  class="mx-auto p-4 d-flex flex-column gap-3"
>
  <div class="d-flex flex-column flex-sm-row gap-2 rounded border bg-body-tertiary small align-items-center">
    <div class="p-2 d-flex flex-column pe-sm-0 p-3 align-items-center">
      <img width="80" class="object-fit-contain" src="/img/logo-gou.webp" alt="logo-gou">
      <span class="fw-bold text-nowrap">
        Importante
        <span
          data-tippy-content="Con esta opción tu pago puede tardar un tiempo en verse reflejado en la plataforma mientras se realizan las validaciones."
          id="alerta-gow-micrositio"
          class="text-bg-warning badge"
        >!</span>
      </span>
    </div>
    <a
      href="https://micrositios.goupagos.com.co/clinica-asotrauma-ma"
      class="p-3 text-dark text-decoration-none position-relative"
    >
      <h5>Opción Micrositio Gou</h5>
      <p class="m-0 text-muted">
        Únicamente debes llenar el formulario con tus datos, seleccionar el plan que quieras, digitar tu información de pago y <b>¡listo!</b>
      </p>
      <span class="position-absolute top-0 end-0 m-1 lh-1 fs-5"><?= $this->fetch("./icons/link.php") ?></span>
    </a>
  </div>
</section>