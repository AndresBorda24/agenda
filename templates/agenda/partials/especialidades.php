<div
  x-data="fetchData"
  x-bind="events"
  style="grid-column: 1 / -1;"
>
  <template x-if="espsLoaded">
    <div>
      <label
        for="select-medico"
        class="form-label fw-bold"
      >Selecciona el medico:</label>
      <p id="select-medico-desc" class="small text-muted">Los médicos están agrupados por especialidades. Por favor revisa bien la especialidad del médico que elegiste.</p>

      <p
        class="m-0"
        style="font-weight: 800; font-size: .75rem;"
        x-text="$store.agenda.selectedEsp
          ? `Especialidad seleccionada: ${$store.agenda.selectedEsp}` : ''"
      ></p>
      <select
        id="select-medico"
        name="select-medico"
        aria-describedby="select-medico-desc"
        class="form-select form-select-sm rounded-0"
        @change="getData(...$event.target.value.split('@') )"
      >
        <option selected hidden>Selecciona</option>
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
    <p class="flex items-center gap-3 m-0 !p-4 rounded bg-amber-50 text-amber-900 text-sm" >
      <?= $this->fetch("./icons/wait.php", ["props" => 'height=20 width=20']) ?>
      Cargando medicos y especialidades. Por favor espera. :)
    </p>
  </template>
</div>
