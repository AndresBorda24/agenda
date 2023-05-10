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
      <?= $this->fetch("./agenda/header.php") ?>

      <div x-data="fetchData" class="p-1" x-bind="events">
        <select class="form-select rounded-0" @change="getData( $el.value )">
          <option selected hidden>Seleccione especialidad</option>
          <template x-for="e in esps" :key="e.especialidad">
            <option
            x-text="e.nombre"
            :value="e.especialidad"></option>
          </template>
        </select>
      </div>

      <?= $this->fetch("./agenda/show-available-doctors.php") ?>

      <?= $this->fetch("./agenda/citas-agendadas.php") ?>
    </div>

    <div class="d-flex flex-column border-start position-relative flex-grow-1">
      <!-- Controles -->
      <?= $this->fetch("./agenda/calendar/controllers.php") ?>

      <!-- Encabezado - Dias de la semana -->
      <?= $this->fetch("./agenda/calendar/header.php") ?>

      <div
      class="d-grid calendar-grid flex-fill position-relative overflow-hidden"
      x-data="calendar"
      x-bind="events">
        <!-- Esta es la pelicula que pasa sobre el calendario al cambiar de mes -->
        <section id="calendar-days-loader" style="z-index: 1; left: 100%;"
        class="position-absolute bg-white h-100 w-100 top-0"></section>

        <template x-for="_ in blankSpaces">
            <div class="bg-body w-100 h-100 x-days" style="transition: all ease-out;"></div>
        </template>

        <template x-for="day in totalSpaces">
          <?= $this->fetch("./agenda/calendar/day.php") ?>
        </template>

        <template x-for="_ in blankSpacesBtm">
            <div class="bg-body w-100 h-100 x-days" style="transition: all ease-out;"></div>
        </template>
      </div>
    </div>
  </main>

  <?= $this->fetch("./agenda/show-day-hours.php") ?>
  <?= $this->fetch("./loader.php") ?>
</body>
</html>
