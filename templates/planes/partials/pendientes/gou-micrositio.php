<?php
  /** @var \App\Contracts\UserInterface $user  */

  $fechaPago = new \DateTimeImmutable($user->pago?->created_at ?? 'now');
?>
<div>
  <div class="rounded bg-white p-6 shadow mb-7 mx-auto max-w-lg">
    <header class="!mb-4">
      <img
        src="<?= $this->asset("/img/logo-gou.webp") ?>"
        alt="logo-gou"
        class="object-fit-contain d-block mx-auto"
      >
      <h5 class="text-center font-bold text-xl text-aso-secondary">
        Pago realizado mediante Micrositio Gou
      </h5>
    </header>

    <p class="text-neutral-800 max-w-lg mx-auto text-sm">
      Parece que has elegido la opción <i>Micrositio Gou</i> para realizar un pago el <b><?= $fechaPago->format("Y-m-d") ?></b> a las <b><?= $fechaPago->format("H:i") ?></b>. Recuerda que con esta opción el pago <b>puede tarde un poco</b> en procesarse.
    </p>
  </div>

  <div class="p-6 text-sm  max-w-lg mx-auto rounded">
    <div class="flex gap-2 items-center mb-6">
      <p class="">
        Si <b>NO COMPLETASTE EL PAGO</b> puedes cancelarlo dando clic en el siguiente botón:
      </p>
    </div>

    <details
      class="position-relative mx-auto"
      style="max-width: 300px"
      id="info-pago-micrositio"
    >
      <summary class="list-none focus:outline-none text-white bg-red-700 decoration-transparent text-center hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm !px-5 py-2.5 me-2">Cancelar Pago</summary>
      <div
        @click.outside="() => document.querySelector('#info-pago-micrositio')?.removeAttribute('open')"
        class="position-absolute bottom-100 mx-auto p-4 rounded border bg-body shadow-lg mb-2"
        style="left: 50%; transform: translateX(-50%)"
      >
        <span class="text-bg-warning rounded px-2 d-block mb-3" style="width: fit-content;">Importante:</span>
        <p class="text-muted pb-2">
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
