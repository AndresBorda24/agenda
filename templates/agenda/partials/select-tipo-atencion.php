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
      <select
        id="atencion-eps"
        name="atencion-eps"
        class="form-select form-select-sm"
        x-model="$store.agenda.selectedEps"
      >
        <option hidden selected value=""> Selecciona </option>
        <?php foreach($epsList as $eps): ?>
          <option value="<?= $eps["codigo"] ?>"><?= $eps["nombre"] ?></option>
        <?php endforeach ?>
      </select>
    </div>
  </template>
</div>
