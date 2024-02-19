<li x-data="Cita(cita)" class="shadow-sm">
  <span
    class="small badge text-bg-warning position-absolute top-0 end-0 m-1"
    x-text="data.tipo.nombre"
  ></span>
  <h3 class="fs-6 fw-bold" x-text="data.especialidad"></h3>
  <ul class="borde-top borde-bottom py-2 mb-2 mt-1 flex-grow-1">
    <li>
      <span class="fw-bold">Dia:</span>
      <span class="" x-text="fecha"></span>
    </li>
    <li>
      <span class="fw-bold">Hora:</span>
      <span x-text="data.hora" class=""></span>
    </li>
    <li>
      <span class="fw-bold">Medico:</span>
      <span x-text="data.medico" class="">
      </li>
    <li>
      <span class="fw-bold">Lugar:</span>
      <span x-text="data.consultorio"></span>
    </li>
  </ul>
  <template x-if="data.tipo.cod == 1">
    <div>
      <p
        class="p-2 m-0 rounded border mb-2 text-dark bg-light"
        style="border-style: dashed !important;"
      >
        <span class="fw-bold d-inline-block me-2">Nota:</span>La fecha u hora pueden cambiar una vez la cita esté <span class="text-decoration-underline">Agendada</span>
      </p>
      <button
        type="button"
        class="btn btn-danger d-block w-100 btn-small"
      >Cancelar Cita</button>
    </div>
  </template>
</li>
