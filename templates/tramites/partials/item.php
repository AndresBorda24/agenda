<?php
$valor ??= 0
?>

<button class="p-4 !border border-dashed border-neutral-300 text-black relative bg-neutral-50 rounded text-start hover:shadow-lg transition-all duration-200 hover:border-neutral-500">
  <div class="flex items-start justify-between">
    <span class="[&>svg]:h-7 [&>svg]:w-7 text-neutral-500 !mb-3 block mr-3">
      <?= $this->fetch("icons/$icon") ?>
    </span>
    <span class="">
      <span class="font-bold"><?= $valor ? "$ $valor" : "Gratis" ?></span>
    </span>
  </div>
  <div class="flex-grow">
    <h5 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white">
      <?= $title ?>
    </h5>
    <p class="font-normal text-sm text-gray-500 dark:text-gray-400"><?= $desc ?></p>
  </div>
</button>
