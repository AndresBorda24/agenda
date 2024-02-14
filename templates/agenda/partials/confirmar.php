<div
  x-data="confirmar"
  class="mx-auto border-top p-3 mt-4"
  style="max-width: 900px;"
>
  <p
    class="mx-auto text-center"
    style="max-width: 500px;"
  >
    Esta seguro que desea agendar una cita para el día
    <span class="fw-bold" x-text="fechaAgenda"></span> a las <span x-text="$store.agenda.selectedHour" class="fw-bold"></span> para la especialidad <span x-text="$store.agenda.selectedEsp" class="fw-bold"></span> con el medico <span x-text="$store.agenda.medico" class="fw-bold"></span>?
  </p>
  <button
    @click="handleClick"
    x-show="canConfirmar" x-cloak
    class="btn btn-success mx-auto block"
  >Confirmar Agendamiento</button>
</div>
