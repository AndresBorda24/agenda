<div x-data class="mx-3">
  <template x-if="! $store.agenda.selectedDay && $store.agenda.days.length">
    <p class="bg-warning-subtle border-4 border-warning border-start px-3 py-2 rounded shadow small">
      <?= $this->fetch("./icons/sign.php", ["props" => 'height=20 width=20']) ?>
      Selecciona uno de los días disponibles en el calendario para cargar las horas agendables.
    </p>
  </template>

  <template x-if="$store.agenda.selectedMed && $store.agenda.days.length === 0">
    <p class="bg-danger-subtle border-4 border-danger border-start px-3 py-2 rounded shadow small">
      <?= $this->fetch("./icons/lock.php") ?>
      Parece que el medico seleccionado no tiene agenda disponible. Lo sentimos.
    </p>
  </template>
</div>
