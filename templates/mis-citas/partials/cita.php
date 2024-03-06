<li x-data="Cita(cita)" :id="`cita-${cita.id}`" :class="['shadow-sm overflow-auto', data.estado === 'C' && 'canceled', isPast && 'past']">
  <span
    x-text="data.tipo.nombre"
    class="position-absolute top-0 start-0 m-1 badge border"
    :class="isPast ? 'text-bg-secondary' : data.tipo.cod == 1 ? 'border-warning-subtle text-bg-warning' : 'border-success-subtle text-bg-success'"
  ></span>

  <div class="d-flex flex-column justify-content-start mt-3 flex-fill">
    <span class="fs-6 fw-bold" x-text="data.especialidad"></span>
    <span class="fw-bold mb-2">
      <span x-text="data.fecha.toJSON().substring(0,10)"></span>
      <span x-text="data.hora"></span>
    </span>
    <span class="fw-bold small text-capitalize" x-text="`Med. ${data.medico.toLowerCase()}`"></span>
    <span class="small" x-text="data.consultorio"></span>

    <template x-if="canCancel">
      <div class="mt-3">
        <button
          type="button" @click="confirm"
          class="btn btn-danger block w-100 btn-small"
        >Cancelar Cita</button>
  
        <div
          x-show="showCancel" x-transition
          class="text-dark bg-white confirmar-cancelacion-cita"
        >
          <div class="text-dark">
            <p class="mb-4">Estás seguro de que deseas <span class="fw-bold">CANCELAR</span> esta cita pre-agendada?</p>
            <div class="d-flex justify-content-between">
              <button
                class="btn btn-sm btn-link text-dark"
                @click="showCancel = false"
              > Volver </button>
              <button
                class="confirmar-btn btn btn-danger"
                @click="cancel"
              > Confirmar </button>
            </div>
          </div>
        </div>
      </div>
    </template>
  </div>


  <template x-if="data.estado == 'N'">
    <div
      style="writing-mode: vertical-rl; text-orientation: mixed; margin-inline: -0.75rem; margin-right: -0.75rem;"
      class="p-1 small border-start border-danger text-dark text-center bg-danger-subtle"
    >No Cumplida</div>
  </template>
  <template x-if="data.estado == 'C'">
    <div
      style="writing-mode: vertical-rl; text-orientation: mixed; margin-inline: -0.75rem; margin-right: -0.75rem;"
      class="p-1 small border-start border-danger text-dark text-center bg-danger-subtle"
    >Cancelada</div>
  </template>
  <template x-if="data.estado == 'P' && data.tipo.cod == 2">
    <div
      style="writing-mode: vertical-rl; text-orientation: mixed; margin-inline: -0.75rem; margin-right: -0.75rem;"
      class="p-1 small border-start border-warning text-dark text-center bg-warning-subtle"
    >Pendiente</div>
  </template>
  <template x-if="data.estado == 'P' && data.tipo.cod == 1">
    <div
      style="writing-mode: vertical-rl; text-orientation: mixed; margin-inline: -0.75rem; margin-right: -0.75rem;"
      class="p-1 small border-start border-warning text-dark text-center bg-warning-subtle"
    >Pendiente <br /> Agendamiento</div>
  </template>
  <template x-if="data.estado == 'A'">
    <div
      style="writing-mode: vertical-rl; text-orientation: mixed; margin-inline: -0.75rem; margin-right: -0.75rem;"
      class="p-1 small border-start border-success text-dark text-center bg-success-subtle"
    >Cumplida</div>
  </template>
</li>
