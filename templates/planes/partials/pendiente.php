<div x-data="PagoPendiente">
  <section class="mb-3 small">
    <?= $this->fetch("./profile/partials/plan-info.php") ?>
  </section>

  <?php if ($user->plan("status") === \App\Models\Pago::ASO_PENDIENTE ): ?>
    <template
    id="pago-pendiente-metadata"
    data-pref-id="<?= $pref?->id ?>"
    data-pago-id="<?= $user->plan("id") ?>"
    ></template>

    <div class="d-flex gap-2 align-items-between small">
      <button
      class="planes-next-btn small p-2 text-bg-danger"
      @click="cancelPay">Seleccionar Otro</button>

      <?php if($pref): ?>
        <button
        class="planes-next-btn small p-2 text-bg-primary"
        @click="continuePay">Continuar</button>
      <?php endif ?>
    </div>
  <?php elseif($pref): // Esto ya no es una preferencia sino un pago   ?>
    <section class="bg-body p-2 border rounded shadow small mb-4">
      <h3 class="fs-5">Informaci&oacute;n de Tu Pago</h3>
      <ul class="list-group list-group-flush small">
        <li class="list-group-item">
          <span class="fw-bold">
            Estado:
          </span>
          <?= \App\Enums\MpStatus::tryFrom($pref->status ?? "")?->publicName() ?>
        </li>
        <li class="list-group-item">
          <span class="fw-bold">Fecha de Expiraci&oacute;n:</span>
          <?= date("Y-m-d h:i:s a", strtotime($pref->date_of_expiration)) ?>
        </li>
        <?php if($pref->transaction_details?->external_resource_url): ?>
          <li class="list-group-item">
            <span class="fw-bold">Info. Transacci&oacute;n:</span>
            <a
              class="btn btn-sm btn-link py-0"
              style="font-size: 1em;"
              target="_blank"
              href="<?= $pref->transaction_details->external_resource_url ?>"
            > Aqu&iacute; </a>
          </li>
        <?php endif ?>
      </ul>
    </section>
  <?php endif ?>
</div>
