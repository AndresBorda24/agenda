<div
x-data="showDayHours"
x-bind="events"
x-show="show"
x-cloak id="show-day-hours"
class="fixed-top vh-100 vw-100 flex bg-black bg-opacity-75">
  <div
  class="light-pattern-bg m-auto flex flex-column flex-fill rounded bg-body overflow-auto border border-primary-subtle"
  style="max-width: 440px;">
    <div class="p-2 header-bg border-bottom d-flex justify-content-between text-white">
      <span class="small fw-bold">Horas Disponibles</span>
      <button
      class="btn btn-sm btn-close d-block ms-auto text-bg-light"
      @click="close"></button>
    </div>
    <h5
    x-text="getFormatDate( key )"
    class="text-center text-capitalize fw-bold text-muted border-bottom p-2 m-0"></h5>

    <div class="overflow-auto py-3 px-1" style="max-height: 400px;">
      <template x-for="med in Object.keys(hours)">
        <div class="mb-3">
          <h6 x-text="'M&eacute;dico: ' + $store.doctores[ med ].nombre" class="text-center small muted"></h6>
          <ul class="list-group shadow-sm">
            <template x-for="h in hours[ med ]">
              <li
              :class="`list-group-item-${$store.doctores[ med ].color}`"
              class="p-0 list-group-item small flex gap-2 align-items-center">
                <span x-text="h" class="p-2 flex-grow-1 fw-bold"></span>
                <button class="btn btn-light btn-sm border-dark-subtle mx-1" title="Agendar para esta hora">
                  Agendar <i class="bi bi-patch-check"></i>
                </button>
              </li>
            </template>
          </ul>
        </div>
      </template>
    </div>
  </div>

</div>
