<div
  x-data="fetchData"
  x-bind="events"
  class="mx-auto border-top p-3"
  style="max-width: 900px;"
>
  <template x-if="espsLoaded">
    <div>
      <p
        class="m-0 ms-2"
        style="font-weight: 800; font-size: .7rem;"
        x-text="$store.agenda.selectedEsp"
      ></p>
      <select
        name="select-medico"
        class="form-select form-select-sm rounded-0"
        @change="getData(...$event.target.value.split('@') )"
      >
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
  </template>

  <template x-if="! espsLoaded">
    <p class="bg-warning-subtle border-4 border-warning border-start px-3 py-2 rounded shadow" >
      <?= $this->fetch("./icons/wait.php", ["props" => 'height=20 width=20']) ?>
      Cargando medicos y especialidades. Por favor espera. :)
    </p>
  </template>
</div>
