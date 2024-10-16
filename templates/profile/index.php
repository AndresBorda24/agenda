<main class="flex-grow-1 p-3">
  <section class="mx-auto" style="max-width: 700px;">
    <?php if( $this->user()->hasPago() && $this->user()->getPago()->isValid() ): ?>
      <h2 class="fs-6">Informaci&oacute;n sobre tu Plan:</h2>
      <section class="mb-2 small">
        <?= $this->fetch("./profile/partials/plan-info.php") ?>
      </section>
      <p class="text-end small text-muted">
        Consultar <?= $this->fetch('./partials/tyc.php') ?>
      </p>
    <?php endif ?>

    <section class="mb-5">
      <?= $this->fetch("./profile/partials/basic.php") ?>
    </section>

    <section class="mb-5">
      <?= $this->fetch("./profile/partials/password.php") ?>
    </section>
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
