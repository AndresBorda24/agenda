<div
x-data="showDayHours"
x-bind="events"
x-show="show"
x-cloak id="show-day-hours"
class="show-selected-day-hours light-pattern-bg flex m-md-3 flex-column flex-fill rounded-top bg-body overflow-auto shadow border border-primary-subtle">
  <div class="p-2 header-bg border-bottom d-flex justify-content-between text-white">
    <span class="small fw-bold">Horas Disponibles</span>
    <button
    class="btn btn-sm btn-close d-block ms-auto text-bg-light"
    @click="close"></button>
  </div>
  <h6
  x-text="getFormatDate( key )"
  class="text-center text-capitalize fw-bold text-muted border-bottom p-2 m-0"></h6>

  <div class="overflow-auto py-3 px-1" style="max-height: 400px;">
    <template x-for="med in Object.keys(hours)">
      <div class="mb-3">
        <div class="border" :class="`border-${$store.doctores[ med ].color}`"></div>
        <ul class="list-group shadow-sm">
          <template x-for="h in hours[ med ]">
            <li
            :class="`list-group-item-${$store.doctores[ med ].color}`"
            class="p-0 list-group-item small flex gap-2 align-items-center">
              <span x-text="h" class="small p-2 text-bg-light"></span>
              <span x-text="'Med: ' + $store.doctores[ med ].nombre" class="flex-grow-1"></span>
              <button class="btn btn-light btn-sm rounded-0" title="Agendar para esta hora">
                <i class="bi bi-patch-check"></i>
              </button>
            </li>
          </template>
        </ul>
      </div>
    </template>
  </div>
</div>
