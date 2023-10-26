<div
  class="m-auto small d-flex flex-column align-items-center gap-1"
  style="max-width: 500px;"
>
  <!-- Llevar tarjeta a casa -->
  <div class="align-items-center d-flex gap-2 small">
    <input
      class="form-check-input fs-5 shadow border border-dark-subtle m-0"
      type="checkbox"
      x-model="state.tarjeta"
      id="tarjeta"
    >
    <label role="button" class="form-check-label user-select-none" for="tarjeta">
      Quiero recibir mi tarjeta en casa!
    </label>
    <details
      x-data
      @click.outside="$el.removeAttribute('open')"
      class="position-relative d-inline-block small"
    >
      <summary
        role="button"
        style="font-size: 10px;"
        class="btn btn-dark btn-sm lh-1"
      >?</summary>
      <p
        style="width: 230px;"
        class="top-100 end-0 position-absolute bg-body p-2 rounded border shadow z-1"
      >
        El pago del env&iacute;o es <span class="fw-bold">contra entrega</span> y se
        concertar&aacute; el costo con el mensajero?
      </p>
    </details>
  </div>

  <!-- Terminos & condiciones  -->
  <div class="align-items-center d-flex gap-2 small">
    <input
      class="form-check-input fs-5 shadow border border-dark-subtle m-0"
      type="checkbox"
      required
      id="tyc"
    >
    <label role="button" class="form-check-label user-select-none" for="tyc">
      Acepto los <a href="#">
        Terminos y Condiciones
      </a>
    </label>
  </div>
</div>
