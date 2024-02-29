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
</div>
