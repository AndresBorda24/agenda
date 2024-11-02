<?php
/** @var \App\DataObjects\OrderItem[] $orderItems   */
?>
<main class="flex-grow-1 p-3 flex">
  <section class="mx-auto max-w-3xl">
    <h1 class="fs-5 text-primary !mb-4">Trámites Virtuales</h1>
    <div class="flex items-center !p-4 !mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert" >
      <span class="[&>svg]:h-4 me-3">
        <?= $this->fetch('./icons/important.php') ?>
      </span>
      <div>
        <span class="font-bold">Importante!</span>
        <p> Al realizar una compra, usted reconoce y acepta nuestros <?= $this->fetch("./partials/tyc.php") ?> </p>
      </div>
    </div>
    <div id="tramites-list-button-container" class="mb-4 flex items-center gap-3">
      <div class="flex items-center gap-2 -mt-0.5">
        <span class="text-sm">Revisa: </span>
        <?= $this->fetch('partials/pasarela-faq-modal.php') ?>
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
      <template x-teleport="body">
        <div
          x-show="showConfirmation"
          @click.self="showConfirmation = false"
          class="fixed top-0 left-0 bg-black/50 w-screen h-screen grid place-content-center z-[1021]"
        >
          <div class="bg-white rounded-sm overflow-hidden !p-5 max-w-sm">
            <span class="block font-bold !mb-4">Trámite pendiente por cerrar.</span>
            <p class="text-neutral-700 text-sm !mb-4">Parece que ya tienes un trámite pendiente para la compra de este item. Por favor revisa tu listado de trámites o ve a la opción <b>Mis Compras</b> del menú.</p>
            <p class="text-neutral-700 text-sm !mb-4">Podrás comprar nuevamente este item cuando la compra sea <b>Aceptada</b> o <b>Rechazada</b>.</p>
            <button
              @click="showConfirmation = false"
              class="bg-aso-secondary px-7 py-1.5 text-sm rounded text-white ml-auto block hover:bg-teal-900"
            >Ok</button>
          </div>
        </div>
      </template>
    </div>
  </section>

  <?= $this->fetch('tramites/partials/order-list.php') ?>
</main>
