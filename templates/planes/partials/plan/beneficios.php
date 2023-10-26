<?php $b = array_map(fn($x) => trim($x), explode(";", $beneficios)) ?>
<ul class="d-flex flex-column my-4 small flex-grow-1 p-0">
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
