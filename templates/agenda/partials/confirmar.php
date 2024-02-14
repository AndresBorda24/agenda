<div
  x-data="confirmar"
  class="mx-auto border-top p-3 mt-4"
  style="max-width: 900px;"
>
  <template x-if="!canConfirmar">
    <p
      class="mx-auto text-center"
      style="max-width: 500px;"
    >
      Por favor termina de seleccionar todas las opciones para continuar. 😊
    </p>
  </template>

  <template x-if="canConfirmar">
    <div style="max-width: 500px;" class="mx-auto mt-4 p-4 bg-secondary text-light shadow-lg rounded">
      <p class="mx-auto text-center fw-bold fs-5 fw-bold"> Agendamiento: </p>
      <ul class="py-3 border-top border-bottom">
        <li>
          <span class="fw-bold">Dia:</span>
          <span class="" x-text="fechaAgenda"></span>
        </li>
        <li>
          <span class="fw-bold">Hora:</span>
          <span x-text="$store.agenda.selectedHour" class=""></span>
        </li>
        <li>
          <span class="fw-bold">Medico:</span>
          <span x-text="$store.agenda.medico" class="">
          </li>
        <li>
          <span class="fw-bold">Especialidad:</span>
          <span x-text="$store.agenda.selectedEsp"></span>
        </li>
        <li>
          <span class="fw-bold">Tipo Atención:</span>
          <span x-text="selectedTipo"></span>
        </li>
      </ul>
      <button
        @click="handleClick"
        x-show="canConfirmar" x-cloak
        class="btn btn-warning mx-auto block"
      >Confirmar Agendamiento</button>
    </div>
  </template>
</div>
