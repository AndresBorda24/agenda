<?php /** @var \App\Contracts\UserInterface $user */ ?>
<div x-data="PagoPendiente">
  <?php if ($user->hasPago()): ?>
    <section class="mb-3 small">
      <?= match ($user->pago->detail) {
        "GOW_MICROSITIO" => $this->fetch("./planes/partials/pendientes/gou-micrositio.php"),
        default => $this->fetch("./profile/partials/plan-info.php")
      } ?>
    </section>
  <?php endif ?>

  <template
    id="pago-pendiente-metadata"
    data-pago-id="<?= $user->pago?->id ?>"
  ></template>
</div>
