<div x-data="showDayHours" x-bind="events" x-show="show"
class="show-selected-day-hours p-3 bg-body shadow overflow-auto border-secondary">
  <button class="btn btn-sm btn-close position-absolute top-0 end-0 m-1" @click="close"></button>
  <h5 x-text="getFormatDate( key )" class="text-center text-capitalize"></h5>
  <ul class="list-group small rounded-0 overflow-auto">
    <template x-for="h in Object.keys(hours)">
      <li class="list-group-item d-flex p-0"
      :class="{
        'list-group-item-primary': hours[ h ],
        'list-group-item-danger': ! hours[ h ]
      }">
        <div class="p-2 bg-body-tertiary">
          <span x-text="h"></span>
        </div>
        <div class="d-flex flex-fill">
          <span x-text="hours[ h ] ? 'Libre' : 'Reservada'" class="m-auto"></span>
        </div>
        <template x-if="hours[ h ]">
          <button class="btn btn-light rounded-0" title="Agendar">
            <i class="bi bi-bookmark-check-fill text-primary"></i>
          </button>
        </template>
      </li>
    </template>
  </ul>
</div>
