<div
  x-data="ModalCancelar"
  x-bind="events"
  x-cloak x-show="show" x-transition
  class="w-100 vh-100 bg-black bg-opacity-75 overflow-auto fixed-top flex"
>
  <div class="m-auto rounded bg-light w-100" style="max-width: 400px;">
    <header class="position-relative p-2">
      <span class="fw-bold">Cancelar Solicitud de Cita</span>
      <button
        @click="close"
        class="btn btn-sm btn-close position-absolute top-0 end-0 m-2"
      ></button>
    </header>
    <div class="p-3 pt-2">
      <span class="small fw-bold">Cita:</span>
      <div class="d-flex flex-column justify-content-start p-2 small border bg-white mb-3 rounded text-body-secondary">
        <span class="fw-bold" x-text="data.especialidad"></span>
        <span class="fw-bold mb-2">
          <span x-text="data.fecha?.substring(0,10)"></span>
          <span x-text="data.hora"></span>
        </span>
        <span class="fw-bold small text-capitalize" x-text="`Med. ${data.medico?.toLowerCase()}`"></span>
        <span class="small" x-text="data.consultorio"></span>
      </div>

      <div style="border-top: 1px dashed #aaa;" class="my-4"></div>

      <form id="cancelacion-cita" @submit.prevent="cancel">
        <label for="motivo-cancelacion" class="form-label m-0">Motivo de Cancelación</label>
        <select
          id="motivo-cancelacion"
          x-model="state.motivo"
          class="form-select form-select-sm mb-3"
          required
        >
          <option hidden value=""> Selecciona </option>
          <option value="30">Disponibilidad - No poder asistir</option>
          <option value="11">Otros</option>
        </select>

        <label for="desc-cancelacion" class="form-label m-0">Descripción:</label>
        <span id="desc-cancelacion-ayuda" class="d-block small text-muted">Longitud mínima de 5</span>
        <textarea
          id="desc-cancelacion"
          x-model="state.desc"
          aria-labelledby="desc-cancelacion-ayuda"
          placeholder="Describe un poco por qué cancelas tu cita"
          class="form-control form-control-sm mb-2"
          style="height: 100px;"
          required
          minlength="5"
        ></textarea>
      </form>
    </div>

    <footer class="d-flex justify-content-between p-2 border-top">
      <button
        class="btn btn-sm"
        @click="close"
        type="button"
      > Volver </button>
      <button
        class="btn btn-sm btn-danger"
        type="submit"
        form="cancelacion-cita"
      >Cancelar Cita</button>
    </footer>
  </div>
</div>