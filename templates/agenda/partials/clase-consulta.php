<div x-data>
  <label
    for="clase-consulta"
    class="form-label fw-bold"
  >Selecciona la clase de consulta que buscas:</label>
  <select
    class="form-select form-select-sm"
    id="clase-consulta"
    x-model="$store.agenda.selectedClase"
    name="clase-consulta"
  >
    <option hidden selected value=""> Selecciona </option>
    <?php foreach([
      'N' => 'Nueva Cita',
      'P' => 'Primera Cita',
      'C' => 'Control'
    ] as $cod => $name): ?>
      <option value="<?= $cod ?>"> <?= $name ?> </option>
    <?php endforeach ?>
  </select>
</div>
