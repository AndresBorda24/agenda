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
  <header class="p-5 border-bottom shadow text-center mb-3 header-agenda d-flex align-items-center justify-content-center flex-column">
    <img src="https://asotrauma.com.co/wp-content/uploads/2021/09/Asotrauma-logo-w.svg" alt="aso-logo" height="40">
    <div class="border border-light mt-2 mb-4 w-50"></div>
    <h3 class="text-light m-0 fw-bold">Agendamiento de Citas <i class="bi bi-journal-bookmark-fill"></i></h3>
  </header>

  <div class="p-2 p-md-3 p-lg-5 m-auto row overflow-auto g-0 mb-5"  style="max-width: 1500px;">
    <div class="col-12 col-lg-5 p-2 p-md-4">
      <p class="text-center text-muted">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dolores iure vitae praesentium, ullam, eveniet iusto sunt, temporibus odio unde rerum blanditiis ipsum fugit animi rem vel alias! Expedita, consequatur, molestias.</p>
      <select class="form-select rounded-0 mb-2" aria-label="Default select example">
        <option selected>Especialidad?</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
    </div>
    <div class="col-12 col-lg-7 overflow-auto bg-body-tertiary border">
      <!-- Controles -->
      <div class="d-flex gap-1 align-items-center border-bottom p-2">
        <button class="btn btn-outline-secondary btn-sm rounded-circle border-0" x-data="changeCalendarMonth(true)" @click="ch">
          <i class="bi bi-caret-left-fill"></i>
        </button>
        <button class="btn btn-outline-secondary btn-sm rounded-circle border-0" x-data="changeCalendarMonth" @click="ch">
          <i class="bi bi-caret-right-fill"></i>
        </button>
        <div class="flex-fill" x-data="dateName" x-bind="events">
          <span class="text-muted text-uppercase" x-text="month"></span>
          <span class="text-muted text-uppercase" x-text="year"></span>
        </div>
      </div>

      <!-- Encabezado - Dias de la semana -->
      <div class="d-grid calendar-header border-bottom">
        <div class="text-center">
          <span class="d-none d-md-inline text-uppercase small text-muted">Dom</span>
          <span class="d-inline d-md-none">D</span>
        </div>
        <div class="text-center">
          <span class="d-none d-md-inline text-uppercase small text-muted">Lun</span>
          <span class="d-inline d-md-none">L</span>
        </div>
        <div class="text-center">
          <span class="d-none d-md-inline text-uppercase small text-muted">Mar</span>
          <span class="d-inline d-md-none">M</span>
        </div>
        <div class="text-center">
          <span class="d-none d-md-inline text-uppercase small text-muted">Mi&eacute;</span>
          <span class="d-inline d-md-none">M</span>
        </div>
        <div class="text-center">
          <span class="d-none d-md-inline text-uppercase small text-muted">Jue</span>
          <span class="d-inline d-md-none">J</span>
        </div>
        <div class="text-center">
          <span class="d-none d-md-inline text-uppercase small text-muted">Vie</span>
          <span class="d-inline d-md-none">V</span>
        </div>
        <div class="text-center">
          <span class="d-none d-md-inline text-uppercase small text-muted">S&aacute;b</span>
          <span class="d-inline d-md-none">S</span>
        </div>
      </div>

      <div class="d-grid calendar-grid" x-data="calendar" x-bind="events">
        <template x-for="_ in blankSpaces">
            <div class="bg-body w-100 h-100 x-days"></div>
        </template>

        <template x-for="day in totalSpaces">
            <div x-data="calendarDay( day )" @click="console.log(day)" x-bind="events"
            class="p-2 small text-center calendar-days position-relative"
            :class="{'has-dates list-group-item list-group-item-primary': hasDate, 'bg-body': !hasDate}">
              <span x-text="day" class="d-block"></span>
              <template x-if="hasDate"><i class="bi bi-bookmark-plus-fill fs-4 text-primary"></i></template>
            </div>
        </template>

        <template x-for="_ in blankSpacesBtm">
            <div class="bg-body w-100 h-100 x-days"></div>
        </template>
      </div>
    </div>
  </div>
</body>
</html>
