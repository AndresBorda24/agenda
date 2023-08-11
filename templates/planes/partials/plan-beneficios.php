<ul class="d-flex flex-column my-4 small flex-grow-1 p-0">
  <template x-if="index > 0">
    <li
    class="px-3 py-1 d-flex gap-1 text-muted small">
      (Incluye todos los beneficios del plan anterior)
    </li>
  </template>
  <template x-for="b in parseBen(plan.beneficios)">
    <li class="px-3 py-1 d-flex gap-1 small">
      <span class="text-primary">
        <?= $this->fetch("./icons/dbl-check.php") ?>
      </span>
      <span
      x-text="b"
      class="flex-grow-1 text-muted"></span>
    </li>
  </template>
</ul>
