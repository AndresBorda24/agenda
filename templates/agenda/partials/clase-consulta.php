<div
  x-data
  class="mx-auto border-top p-3"
  style="max-width: 900px;"
>
  <span class="form-label fw-bold">Selecciona la clase de consulta que buscas:</span>
  <section
    class="select-tipo-atencion p-3"
    id="clase-consulta"
    name="clase-consulta"
  >
    <?php foreach([
      'N' => 'Nueva Cita',
      'P' => 'Primera Cita',
      'C' => 'Control'
    ] as $cod => $name): ?>
      <label :class="['d-block shadow', ($store.agenda.selectedClase == '<?= $cod ?>') && 'active']">
        <input
          type="radio"
          name="clase-consulta"
          class="visually-hidden"
          x-model="$store.agenda.selectedClase"
          value="<?= $cod ?>"
          data-name="<?= $name ?>"
        >
        <?= $name ?>
      </label>
    <?php endforeach ?>
  </select>
</div>
