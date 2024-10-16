<div class="p-4 rounded-md bg-white mb-6 shadow-md text-neutral-700">
  <p class="text-lg mb-[15px]">Todos los planes incluyen:</p>
  <div class="grid gap-5 grid-cols-1 md:grid-cols-2">
    <div>
      <span class="block font-bold text-sm">Beneficios</span>
      <ul class="text-slate-600 dark:text-slate-400 text-sm space-y-1 grow">
        <?php foreach(explode(';', "Acceso a todos nuestros servicios habilitados; Atención preferencial en servicio de urgencias; Manilla distintiva; Diferentes opciones de menú durante tu estancia; Habitación unipersonal; Servicios de Streaming") as $beneficio): ?>
          <li class="flex items-center">
            <svg class="w-3 h-3 fill-emerald-500 mr-3 shrink-0" viewBox="0 0 12 12" xmlns="http://www.w3.org/2000/svg">
              <path d="M10.28 2.28L3.989 8.575 1.695 6.28A1 1 0 00.28 7.695l3 3a1 1 0 001.414 0l7-7A1 1 0 0010.28 2.28z" />
            </svg>
            <span><?= $beneficio ?></span>
          </li>
        <?php endforeach ?>
      </ul>
    </div>

    <div>
      <span class="block font-bold text-sm">Exclusiones</span>
      <ul class="text-slate-600 dark:text-slate-400 text-sm space-y-1 grow">
        <li class="flex items-center gap-[8px]">
          <span class="text-red-600 text-lg"><?= $this->fetch('./icons/close.php') ?></span>
          Ayudas diagn&oacute;sticas especializadas.
        </li>
        <li class="flex items-center gap-[8px]">
          <span class="text-red-600 text-lg"><?= $this->fetch('./icons/close.php') ?></span>
          Material de osteos&iacute;ntesis.
        </li>
        <li class="flex items-center gap-[8px]">
          <span class="text-red-600 text-lg"><?= $this->fetch('./icons/close.php') ?></span>
          Medicamentos.
        </li>
        <li class="flex items-center gap-[8px]">
          <span class="text-red-600 text-lg"><?= $this->fetch('./icons/close.php') ?></span>
          Dispositivos M&eacute;dicos.
        </li>
      </ul>
    </div>
  </div>
</div>
