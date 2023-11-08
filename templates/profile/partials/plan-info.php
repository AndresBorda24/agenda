<?php /** @var \App\Abstracts\AbstractPago */ $pago = $this->user()->pago ?>
<article class="bg-secondary border border-warning rounded shadow p-3 text-light">
  <header class="d-sm-flex justify-content-between align-items-end mb-2">
    <span class="d-block">
      <span class="text-warning fs-5 mb-2 m-sm-0 d-sm-block">
        Plan: <?= $pago->nombre ?>
      </span>
      <span class="fw-light small d-sm-block">
        $ <?= number_format(
          (int) $pago->valor,
          thousands_separator: "."
        ) ?>
      </span>
    </span>

    <?php if( $pago->isValid() ): ?>
      <span class="fw-bold d-block small">
        <span class="fw-light small">Expira el:</span> <br>
        <?= $pago->expireAt()?->format("Y-m-d") ?>
      </span>
    <?php endif ?>
  </header>

  <span>Beneficios:</span>
  <ul class="small">
    <?php foreach(
      explode(";", $pago->beneficios)
      as $beneficio
    ): ?>
      <li class="small fw-light"><?= $beneficio ?>.</li>
    <?php endforeach ?>
  </ul>

  <div class="rounded overflow-hidden">
    <?= $this->fetch("./planes/partials/plan/exclusiones.php") ?>
  </div>

  <?php if($pago->tarjeta !== null): ?>
    <span class="border d-block mt-3 p-2 rounded small">
      <?= $this->fetch("./icons/card-check.php") ?> Tu Tarjeta:
      <span class="fst-italic"> <?= $pago->tarjeta ?> </span>
    </span>
  <?php endif ?>
</article>

