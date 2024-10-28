<?php
/** @var \App\DataObjects\OrderItem $item */
$icon = $item->icon ? "$item->icon.php" : "paper-fill.php"
?>

<button
  data-order-item-id="<?= $item->id ?>"
  @click="startProcess"
  class="p-4 !border border-dashed border-neutral-300 text-black relative bg-neutral-50 rounded text-start hover:shadow-lg transition-all duration-200 hover:border-neutral-500"
>
  <div class="flex items-start justify-between">
    <span class="[&>svg]:h-7 [&>svg]:w-7 text-neutral-500 !mb-3 block mr-3">
      <?= $this->fetch("icons/$icon") ?>
    </span>
    <span class="">
      <span class="font-bold">
        <?= $item->price ? "$ ".number_format($item->price, thousands_separator: '.') : "Gratis" ?>
      </span>
    </span>
  </div>
  <div class="flex-grow">
    <h5 class="text-lg font-semibold tracking-tight text-gray-900 dark:text-white">
      <?= $item->name ?>
    </h5>
    <p class="font-normal text-sm text-gray-500 dark:text-gray-400"><?= $item->desc ?></p>
  </div>
</button>
