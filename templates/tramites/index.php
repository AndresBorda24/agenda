<?php
/** @var \App\DataObjects\OrderItem[] $orderItems   */
?>
<main class="flex-grow-1 p-3 flex">
  <section class="mx-auto max-w-3xl">
    <h1 class="fs-5 text-primary mb-6">Trámites Virtuales</h1>
    <div id="tramites-list-button-container"></div>
    <div
      class="max-w-xl flex items-center !p-4 !mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 mt-6" role="alert"
    >
      <span class="[&>svg]:h-4 me-3">
        <?= $this->fetch('./icons/important.php') ?>
      </span>
      <div>
        <span class="font-bold">Importante!</span>
        <p>
          Para los items que apliquen: Al dar click serás redireccionado a la pasarela de pagos para que completes el proceso.
        </p>
      </div>
    </div>

    <div
      x-data="ItemsList"
      class="grid [grid-template-columns:repeat(auto-fill,minmax(300px,1fr))] !gap-5"
    >
      <?php foreach($orderItems as $item): ?>
        <?= $this->fetch('tramites/partials/item.php', [
          'item' => $item
        ]) ?>
      <?php endforeach ?>
    </div>
  </section>

  <?= $this->fetch('tramites/partials/order-list.php') ?>
</main>
