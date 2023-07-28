<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?= $this->loadAssets("agenda/app") ?>
  <title>Agendamiento Web</title>
</head>
<body>
  <?= $this->fetch("./partials/header.php", [
    "title" => "Inicio de Sesi&oacute;n"
  ]) ?>

  <div
  class="container-fluid d-flex flex-wrap gap-3 my-5"
  style="min-height: 60vh;">
    <div class="col-5">
        <div class="d-flex flex-column" style="min-width: 380px;">
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
    </div>

    <div
    class="d-flex flex-column border position-sticky flex-grow-1"
    style="top: 3rem; max-height: 550px;">
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
    </div>  </div>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
  <?= $this->fetch("./agenda/show-day-hours.php") ?>
</body>
</html>
