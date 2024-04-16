<?php
  /** @var \App\Contracts\UserInterface $user  */

  $fechaPago = new \DateTimeImmutable($user->pago?->created_at ?? 'now');
?>
<div class="p-3 rounded border border-dashed border-dark-subtle bg-body-tertiary">
  <header class="border-bottom ">
    <img
      src="<?= $this->asset("/img/logo-gou.webp") ?>"
      alt="logo-gou"
      class="object-fit-contain d-block mx-auto"
    >
    <h5 class="text-center">
      Pago realizado mediante <span class="fw-bold">Micrositio Gou</span>
    </h5>
  </header>
  <div class="pt-4 text-muted">
    <p>
      Parece que has elegido la opción <i>Micrositio Gou</i> para realizar un pago el <b><?= $fechaPago->format("Y-m-d") ?></b> a las <b><?= $fechaPago->format("H:i") ?></b>. Recuerda que con esta opción el pago <b>puede tarde un poco</b> en procesarse.
    </p>
    <p>Si <b>NO COMPLETASTE EL PAGO</b> puedes cancelarlo dando clic en el siguiente botón:</p>

    <details
      class="position-relative mx-auto"
      style="max-width: 300px"
      id="info-pago-micrositio"
    >
      <summary class="btn btn-dark btn-sm d-block mx-auto">Cancelar Pago</summary>
      <div
        @click.outside="() => document.querySelector('#info-pago-micrositio')?.removeAttribute('open')"
        class="position-absolute bottom-100 mx-auto p-4 rounded border bg-body shadow-lg mb-2"
      >
        <span class="text-bg-warning rounded px-2 d-block mb-2" style="width: fit-content;">Importante:</span>
        <p class="text-muted border-bottom pb-2">
          Si has realizado el pago, el dinero <b>NO</b> se reembolsará automáticamente, tendrás que realizar una solicitud a: <a class="fw-bold text-dark text-decoration-none" href="mailto:programadefidelizacion@asotrauma.com.co">programadefidelizacion@asotrauma.com.co</a>
        </p>
        <button
          class="d-block btn btn-danger btn-sm mx-auto"
          @click="cancelPay"
        > Confirmar </button>
      </div>
    </details>
  </div>
</div>