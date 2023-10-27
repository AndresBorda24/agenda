<div
  id="medios-de-pago"
  x-data="mp" x-bind="events"
  class="d-flex flex-column gap-3 my-4 mx-auto"
  style="max-width: 400px;"
>
  <div
    style="max-width: 280px;"
    class="info-plan bg-dark rounded small mx-auto shadow mb-2 px-5"
  ></div>
  <hr>

  <div id="mercadopago"></div>
  <?php if( $user->isFromIntranet() ): ?>
    <button
      class="planes-next-btn py-2 text-bg-primary w-100"
      @click="nomina"
    > Descuento de Nómina
    </button>
  <?php endif ?>

  <button
  class="planes-next-btn py-2 text-bg-danger"
  @click="cancelPay">Cancelar</button>
</div>
