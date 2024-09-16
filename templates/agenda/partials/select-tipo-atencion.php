<div x-data>
  <label
    for="tipo-atencion"
    class="form-label fw-bold"
  >Selecciona el tipo de atención que necesitas:</label>
  <select
    class="form-select form-select-sm"
    x-model="$store.agenda.selectedTipo"
    id="tipo-atencion"
    name="tipo-atencion"
  >
    <option hidden selected value=""> Selecciona </option>
    <?php foreach([
      'EPS' => 'EPS',
      'ARL' => 'ARL',
      'SOAT' => 'SOAT',
      'POL' => 'Póliza',
      'MED_PREP' => 'Medicina Prepagada'
    ] as $cod => $name): ?>
      <option value="<?= $cod ?>"> <?= $name ?> </option>
    <?php endforeach ?>

    <?php if ($this->user()->getPago()?->isValid()): ?>
      <option value="PARTIC">Particular</option>
    <?php endif ?>
  </select>

  <template x-if="$store.agenda.selectedTipo !== 'PARTIC' && $store.agenda.selectedTipo">
    <div x-data="selectEps" class="pt-2">
      <label
        for="atencion-eps"
        class="form-label fw-bold"
      >Selecciona tu EPS:</label>
      <template x-if="fetched">
        <select
          id="atencion-eps"
          name="atencion-eps"
          class="form-select form-select-sm"
          x-model="$store.agenda.selectedEps"
        >
          <option hidden selected value=""> Selecciona </option>
          <template x-for="e in eps" :key="e.id">
            <option :value="e.codigo" x-text="e.nombre"></option>
          </template>
        </select>
      </template>

      <template x-if="!fetched">
        <span class="d-inline-block text-bg-warning text-center rounded-2 w-100 small bg-opacity-25 border-start border-3 border-warning shadow-sm">
          Cargando Listado de EPS...
        </span>
      </template>
    </div>
  </template>
</div>
