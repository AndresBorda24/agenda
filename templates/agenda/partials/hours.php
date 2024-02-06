<div x-data="selectHours">
  <template x-if="$store.agenda.selectedDay !== null">
    <div>
      <h5 class="mb-1 text-center">Horas Disponibles</h5>
      <span
        class="badge text-bg-primary d-block mb-4"
        x-text="selectedDay"
      ></span>
      <div class="d-flex gap-2 flex-wrap">
        <template x-for="h in horas">
          <button
            class="bg-transparent border-0"
            x-text="h"
          > </button>
        </template>
      </div>
    </div>
  </template>
</div>
