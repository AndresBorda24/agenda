<div class="h-full">
  <div class="relative flex flex-col h-full p-6 rounded bg-white dark:bg-slate-900 shadow shadow-slate-950/5 overflow-hidden">
    <?php if($isColaborador): ?>
      <span class="absolute w-full top-0 left-0 z-0 h-[50%] bg-gradient-to-b from-sky-100 via-amber-100 to-transparent"></span>
    <?php endif ?>

    <div class="mb-[20px] z-10">
      <div class="text-slate-900 dark:text-slate-200 font-semibold mb-1"><?= $plan['nombre'] ?> </div>
      <div class="inline-flex items-baseline mb-2">
        <span class="text-slate-900 dark:text-slate-200 font-bold text-3xl">$</span>
        <span class="text-slate-900 dark:text-slate-200 font-bold text-4xl"><?= $plan['valor_formatted'] ?></span>
        <span class="text-slate-500 font-medium">/año</span>
      </div>
      <div class="text-sm text-slate-500 mb-[20px]">Este plan tiene una vigencia de: <?= $plan['vigencia'] ?> días.</div>
      <button
        class="w-full inline-flex justify-center whitespace-nowrap rounded-lg bg-aso-secondary px-3.5 py-2.5 text-sm font-medium text-white shadow-sm shadow-indigo-950/10 hover:bg-aso-primary focus-visible:outline-none focus-visible:ring focus-visible:ring-aso-primary/30 dark:focus-visible:ring-slate-600 transition-colors duration-150"
        @click="confirmPlan(<?= $plan['id'] ?>)"
      > Comprar este plan!  </button>
    </div>
    <div class="text-slate-900 dark:text-slate-200 font-medium mb-3">Incluye:</div>
    <ul class="text-slate-600 dark:text-slate-400 text-sm space-y-3 grow">
      <?php foreach(explode(';', $plan['beneficios']) as $beneficio): ?>
        <li class="flex items-center">
          <svg class="w-3 h-3 fill-emerald-500 mr-3 shrink-0" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
            <path d="M10.28 2.28L3.989 8.575 1.695 6.28A1 1 0 00.28 7.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 2.28z" />
          </svg>
          <span><?= $beneficio ?></span>
        </li>
      <?php endforeach ?>
    </ul>
  </div>
</div>
