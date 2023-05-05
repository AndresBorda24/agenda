<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="./js/index.js" defer></script>
  <link rel="stylesheet" href="./css/app.css">
  <title>Citas</title>
</head>
<body>
  <main class="main-container">
    <div class="d-flex flex-column aside light-pattern-bg ">
      <header class="d-flex align-items-center flex-wrap">
        <div class="header-bg p-3 shadow-sm w-100">
          <img src="https://asotrauma.com.co/wp-content/uploads/2021/09/Asotrauma-logo-w.svg"
          alt="aso-logo" height="30" class="d-block m-auto">
        </div>
        <h5 class="text-muted text-center m-0 fw-bold flex-fill my-2">
          Agendamiento de Citas <i class="bi bi-journal-bookmark-fill"></i>
        </h5>
      </header>

      <p class="text-center text-muted m-0 p-3 small">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolores iure vitae praesentium, ullam, eveniet iusto consequatur, molestias.</p>

      <div x-data="fetchData" class="p-1">
        <select class="form-select rounded-0" @change="getData">
          <option selected hidden>Seleccione especialidad</option>
          <option value="1">Especialidad</option>
        </select>
      </div>

      <div x-data x-cloak
      class="p-1 border-top border-bottom p-2 small bg-white"
      x-show="Object.keys( Alpine.store('doctores') )[0]">
        <h6 class="text-center text-muted">Medicos:</h6>
        <div class="d-grid gap-1" style="grid-template-columns: repeat(auto-fit, minmax(90px, 1fr));">
          <template x-for="med in Object.keys( Alpine.store('doctores') )">
            <div class="d-flex flex-column align-items-center">
              <div class="rounded-circle m-1 p-2 border bg-opacity-75" style="aspect-ratio: 1;"
              :class="`bg-${Alpine.store('doctores')[ med ].color} border-${Alpine.store('doctores')[ med ].color}`">
              </div>
              <span class="text-center small"
              :class="`text-${Alpine.store('doctores')[ med ].color}`"
              x-text="Alpine.store('doctores')[ med ].nombre"></span>
            </div>
          </template>
        </div>
      </div>

      <?= $this->fetch("./agenda/show-day-hours.php") ?>
    </div>

    <div class="d-flex flex-column border-start position-relative">
      <!-- Controles -->
      <?= $this->fetch("./agenda/calendar-controllers.php") ?>

      <!-- Encabezado - Dias de la semana -->
      <?= $this->fetch("./agenda/calendar-header.php") ?>

      <div class="d-grid calendar-grid flex-fill position-relative" x-data="calendar" x-bind="events">
        <section id="calendar-days-loader" style="z-index: 1; left: 100%;"
        class="position-absolute bg-white h-100 w-100 top-0"></section>


        <template x-for="_ in blankSpaces">
            <div class="bg-body w-100 h-100 x-days" style="transition: all ease-out;"></div>
        </template>

        <template x-for="day in totalSpaces">
          <div x-data="calendarDay( day )" @click="showHours" x-bind="events" style="transition: all ease-out;"
          class="p-2 small text-center calendar-days position-relative"
          :class="{'has-dates list-group-item list-group-item-primary': hasDate, 'bg-body': !hasDate}">
            <span x-text="day" class="d-block"></span>
            <template x-if="hasDate">
              <div>
                <i class="bi bi-bookmark-plus-fill fs-4 text-primary"></i>
                <div class="d-flex justify-content-center flex-wrap">
                  <template x-for="doc in Alpine.store('agenda')[ getDate() ]">
                    <div
                      class="rounded-circle border p-1 bg-opacity-75"
                      :class="`bg-${Alpine.store('doctores')[doc].color} border-${Alpine.store('doctores')[doc].color}`"></div>
                  </template>
                </div>
              </div>
            </template>
          </div>
        </template>

        <template x-for="_ in blankSpacesBtm">
            <div class="bg-body w-100 h-100 x-days" style="transition: all ease-out;"></div>
        </template>
      </div>
    </div>
  </main>
  <?= $this->fetch("./loader.php") ?>
</body>
</html>
