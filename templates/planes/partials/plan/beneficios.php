<?php $b = array_map(fn($x) => trim($x), explode(";", $beneficios)) ?>
<ul class="d-none d-lg-flex flex-column my-4 small flex-grow-1 p-0" id="lista-beneficios-<?= $planId ?>">
  <?php foreach ($b as $beneficio): ?>
    <li class="px-3 py-1 d-flex gap-1 small">
      <span class="text-primary">
        <?= $this->fetch("./icons/dbl-check.php") ?>
      </span>
      <span class="flex-grow-1 text-muted">
        <?= $beneficio ?>
      </span>
    </li>
  <?php endforeach ?>
</ul>

<div class="d-block d-lg-none p-2 text-center">
  <span class="fs-6">Beneficios </span>
  <span
    data-plan="<?=$planId?>"
    class="beneficios-tooltip text-bg-dark d-inline-block ms-2 small px-2 rounded-3 user-select-none"
  >?</span>
</div>