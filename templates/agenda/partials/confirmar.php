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
      <ul class="py-3 border-top border-bottom" id="resumen-list">
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
        <li>
          <span class="fw-bold">Clase de Consulta:</span>
          <span x-text="selectedClase"></span>
        </li>
      </ul>
      <button
        @click="handleClick"
        x-show="canConfirmar" x-cloak
        class="btn btn-warning mx-auto block"
      >Confirmar Agendamiento</button>
    </div>
  </template>

  <template x-teleport="body">
    <div x-show="errorMessage" class="position-fixed flex top-0 start-0 bg-black bg-opacity-75 vh-100 w-100 z-20" style="z-index: 1100;">
      <div
        class="m-auto p-4 bg-white rounded d-flex flex-column align-items-center gap-4"
        style="max-width: 500px;"
      >
        <span class="text-dark"><?= $this->fetch("./icons/sign.php", [
          "props" => 'width="32"'
        ]) ?></span>
        <div x-html="errorMessage"></div>
      </div>
    </div>
  </template>
</div>
