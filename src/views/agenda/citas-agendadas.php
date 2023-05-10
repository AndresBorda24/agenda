<div x-data="loadAgendadas" x-bind="events">
  <template x-if="citas[0]">
    <div class="border-top border-bottom px-3 bg-body py-3 my-2 shadow-sm user-select-none">
      <h6 class="text muted m-0 select-none" @click="show = !show" role="button">
        <span x-text="show ? 'Ocultar' : 'Mostrar'" class="border-dasshed-light border-bottom"></span>
        Citas Agendadas
      </h6>
      <ul class="list-group small overflow-auto mt-2" style="max-height: 400px;" x-show="show">
        <template x-for="c in citas">
          <li class="list-group-item list-group-item-light p-0 d-block">
            <div class="text-center">
              <span class="d-block small">Fecha:</span>
              <span x-text="c.fecha"></span>
              <span x-text="c.hora"></span>
            </div>
            <div class="list-group-item list-group-item-primary d-md-grid" style="grid-template-columns: 7fr 5fr;">
              <div class="flex-grow-1">
                <span class="d-block fw-normal" style="font-size: .7rem;">Medico:</span>
                <span x-text="c.medico" class="fw-bold"></span>
              </div>
              <div class="flex-grow-1">
                <span class="d-block fw-normal" style="font-size: .7rem;">Especialidad:</span>
                <span x-text="c.especialidad" class="fw-bold small"></span>
              </div>
            </div>
          </li>
        </template>
      </ul>
    </div>
  </template>
</div>
