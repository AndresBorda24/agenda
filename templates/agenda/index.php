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
    "title" => "Agendamiento Citas"
  ]) ?>

  <main class="d-flex p-1 main-container">
    <?= $this->fetch("./partials/aside.php") ?>
    <div class="flex-grow-1 p-md-4">
      <div x-data="fetchData" class="p-3 pb-1 p-md-1 mb-0 mb-md-3" x-bind="events">
        <select
        class="form-select form-select-sm rounded-0"
        @change="getData(...$event.target.value.split('@') )">
          <option selected hidden>Seleccione especialidad</option>
          <template x-for="e in Object.keys(esps)" :key="e">
            <optgroup :label="e || 'Generales'">
              <template x-for="m in esps[e]" :key="e+m.cod">
                <option
                  x-text="m.medico"
                  :value="`${e}@${m.cod}`"
                ></option>
              </template>
            </optgroup>
          </template>
        </select>
      </div>

      <section class="d-lg-flex mx-auto" style="max-width: 900px;">
        <div class="col-lg-6 p-3 p-lg-2" style="order: 2;">
          <?= $this->fetch("./agenda/partials/help-calendar.php") ?>
          <?= $this->fetch("./agenda/partials/calendar.php") ?>
        </div>
        <div class="col-lg-6 p-3 p-lg-2">
          <?= $this->fetch("./agenda/partials/help-hours.php") ?>
          <?= $this->fetch("./agenda/partials/hours.php") ?>
        </div>
        <div class="border-start border-secondary-subtle"></div>
      </section>
    </div>
  </main>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
  <?= $this->fetch("./agenda/show-day-hours.php") ?>
</body>
</html>
