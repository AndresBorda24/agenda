<div x-data="selectHours" class="mt-1">
  <template x-if="$store.agenda.selectedDay !== null">
    <div>
      <span
        class="badge text-bg-primary d-block mb-3"
        x-text="selectedDay"
      ></span>
      <div class="d-flex gap-4 flex-wrap justify-content-center">
        <template x-for="h in horas">
          <button
            @click="handleClick(h)"
            :class="['bg-transparent border-0 hour-btn', ($store.agenda.selectedHour === h) && 'hour-selected']"
            x-text="h"
          > </button>
        </template>
      </div>
    </div>
  </template>
</div>
