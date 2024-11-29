<div x-data>
  <span class="form-label fw-bold">Selecciona la hora:</span>
  <template x-if="!$store.agenda.selectedMed">
    <p class="text-muted small">Las fechas se cargarán una vez hayas seleccionado un médico y también un día para tu cita.</p>
  </template>

  <template x-if="! $store.agenda.selectedDay && $store.agenda.days.length">
    <p class="bg-amber-50 border-l-4 border-aso-yellow px-4 py-2 rounded text-sm flex gap-3 items-center max-w-sm text-amber-900">
      <span class="text-xl">
        <?= $this->fetch("./icons/sign.php", ["props" => 'height=30 width=30']) ?>
      </span>
      Selecciona uno de los días disponibles en el calendario para cargar las horas libres.
    </p>
  </template>

  <template x-if="$store.agenda.selectedMed && $store.agenda.days.length === 0">
    <p class="bg-red-50 border-l-4 border-red-600 px-4 py-2 rounded text-sm flex gap-3 items-center max-w-sm text-red-900">
      <span class="text-xl">
        <?= $this->fetch("./icons/lock.php") ?>
      </span>
      Parece que el médico seleccionado no tiene agenda disponible. Lo sentimos.
    </p>
  </template>
</div>
