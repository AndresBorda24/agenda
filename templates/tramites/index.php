<main class="flex-grow-1 p-3">
  <section class="mx-auto max-w-3xl">
    <h1 class="fs-5 text-primary mb-6">Trámites Virtuales</h1>
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

    <div class="grid [grid-template-columns:repeat(auto-fill,minmax(300px,1fr))]">
      <?= $this->fetch('tramites/partials/item.php', [
        'title' => 'Certificado Atenciones Policial',
        'desc'  => 'Esta es una descripción temporal',
        'icon'  => 'paper-fill.php',
        'valor' => number_format(30000, thousands_separator: '.')
      ]) ?>
    </div>
  </section>
</main>
