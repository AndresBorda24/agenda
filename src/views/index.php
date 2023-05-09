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

      <div x-data="fetchData" class="p-1">
        <select class="form-select rounded-0" @change="getData( $el.value )">
          <option selected hidden>Seleccione especialidad</option>
          <option value="143">CIRUGIA PLASTICA</option>
          <option value="514">ORTOPEDIA Y TRAUMATOLOGIA</option>
          <option value="133">CIRUGIA DE LA MANO</option>
        </select>
      </div>

      <?= $this->fetch("./agenda/show-available-doctors.php") ?>
    </div>

    <div class="d-flex flex-column border-start position-relative">
      <!-- Controles -->
      <?= $this->fetch("./agenda/calendar/controllers.php") ?>

      <!-- Encabezado - Dias de la semana -->
      <?= $this->fetch("./agenda/calendar/header.php") ?>

      <div class="d-grid calendar-grid flex-fill position-relative" x-data="calendar" x-bind="events">
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

  <?= $this->fetch("./loader.php") ?>
  <?= $this->fetch("./agenda/show-day-hours.php") ?>
</body>
</html>
