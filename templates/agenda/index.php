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
      <div x-data="fetchData" class="p-1 mb-3" x-bind="events">
        <select
        class="form-select form-select-sm rounded-0"
        @change="getData( $el.value )">
          <option selected hidden>Seleccione especialidad</option>
          <template x-for="e in Object.keys(esps)" :key="e">
            <optgroup :label="e || 'Generales'">
              <template x-for="m in esps[e]" :key="e+m.cod">
                <option
                  x-text="m.medico"
                  :value="m.cod"
                ></option>
              </template>
            </optgroup>
          </template>
        </select>
      </div>

      <section class="row align-items-baseline">
        <div class="col-6">
          <?= $this->fetch("./agenda/partials/hours.php") ?>
        </div>
        <div class="col-6">
          <p class="small">Los dias que cuenten con horas de agendamiento disponibles estarán resaltados de color amarillo.</p>
          <?= $this->fetch("./agenda/partials/calendar.php") ?>
        </div>
      </section>
    </div>
  </main>

  <?= $this->fetch("./partials/footer.php") ?>
  <?= $this->fetch("./partials/loader.php") ?>
  <?= $this->fetch("./agenda/show-day-hours.php") ?>
</body>
</html>
