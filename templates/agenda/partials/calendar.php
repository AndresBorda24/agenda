<section
  class="flex-fill bg-secondary position-relative overflow-hidden border px-2 text-light rounded-3 shadow-lg pb-3 mx-auto"
  style="max-width: 400px;"
  x-data="calendar"
>
  <!-- Esta es la pelicula que pasa sobre el calendario al cambiar de mes -->
  <section id="calendar-days-loader" style="z-index: 1; left: 100%;"
  class="position-absolute bg-white h-100 w-100 top-0"></section>

  <div class="d-flex pt-3 pb-2 align-items-center">
    <button
      type="button"
      @click="change(false)"
      class="bg-transparent text-white p-1 text-center border-0 fw-bold rounded-full"
    > <?= $this->fetch("./icons/left.php") ?> </button>
    <span class="text-center flex-fill fw-light">
      <span x-text="visualMonth"></span>
      <span x-text="visualYear"></span>
    </span>
    <button
      type="button"
      @click="change(true)"
      class="bg-transparent text-white p-1 text-center border-0 fw-bold rounded-full"
    > <?= $this->fetch("./icons/right.php") ?> </button>
  </div>

  <div
    class="d-grid position-relative overflow-hidden py-4 px-2"
    style="grid-template-columns: repeat(7, 1fr); gap: 20px 5px;"
  >
    <template x-for="day in ['D','L','M','M','J','V','S']">
      <span
        class="bg-transparent text-center small fw-bold"
        x-text="day"
      ></span>
    </template>

    <template x-for="_ in blankSpaces">
      <div class="w-100 h-100" style="transition: all ease-out;"></div>
    </template>

    <template x-for="day in totalSpaces" :key="getFullDate(day)">
      <button
        x-data="calendarDay(getFullDate(day))"
        x-text="day"
        @click="handleSelect"
        type="button"
        :class="['bg-transparent position-relative text-white text-center small border-0 fw-light rounded-full', hasDate && 'tiene-agenda', (date == $store.agenda.selectedDay) &&    'dia-seleccionado']"
      ></button>
    </template>

    <template x-for="_ in blankSpacesBtm">
      <div class="w-100 h-100" style="transition: all ease-out;"></div>
    </template>
  </div>
</section>
