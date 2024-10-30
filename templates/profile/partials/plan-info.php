<?php /** @var \App\Abstracts\AbstractPago */ $pago = $this->user()->pago ?>
<article class="border rounded shadow p-4 bg-gradient-to-b from-cyan-50 via-yellow-50 to-neutral-50 border-aso-primary/20">
  <header class="flex flex-col mb-4">
    <div class="flex gap-2 items-center">
      <span class="text-aso-primary fs-5 font-bold">
        Plan: <?= $pago->nombre ?>
      </span>
      <span class="[&>svg]:h-6 [&>svg]:w-6"><?= $this->fetch('icons/dot.php') ?></span>
      <span>
        $ <?= number_format(
          (int) $pago->valor,
          thousands_separator: "."
        ) ?>
      </span>
    </div>

    <?php if( $pago->isValid() ): ?>
      <div class="text-sm">
        <span>Expira el:</span>
        <span class="font-bold"> <?= $pago->expireAt()?->format("Y-m-d") ?> </span>
      </div>
    <?php endif ?>
  </header>

  <span class="font-bold text-aso-primary">Beneficios:</span>
  <ul class="pl-6 mb-6 flex flex-col space-y-1">
    <?php foreach(explode(";", $pago->beneficios) as $beneficio): ?>
      <li class="text-sm list-disc text-neutral-700"><?= $beneficio ?>.</li>
    <?php endforeach ?>
  </ul>

  <div class="rounded overflow-hidden">
    <?= $this->fetch("./planes/partials/plan/beneficios-exclusiones.php") ?>
  </div>

  <?php if($pago->tarjeta !== null): ?>
    <span class="border d-block mt-3 p-2 rounded small">
      <?= $this->fetch("./icons/card-check.php") ?> Tu Tarjeta:
      <span class="fst-italic"> <?= $pago->tarjeta ?> </span>
    </span>
  <?php endif ?>
</article>
