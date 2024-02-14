<div
  x-data
  class="mx-auto border-top p-3"
  style="max-width: 900px;"
>
  <span
    for="tipo-atencion"
    class="form-label fw-bold"
  >Selecciona el tipo de atención que necesitas:</span>
  <section
    class="select-tipo-atencion p-3"
    id="tipo-atencion"
    name="tipo-atencion"
  >
    <?php foreach([
      'EPS' => 'EPS',
      'ARL' => 'ARL',
      'SOAT' => 'SOAT',
      'POL' => 'Póliza',
      'MED_PREP' => 'Medicina Prepagada'
    ] as $cod => $name): ?>
      <label :class="['d-block shadow', ($store.agenda.selectedTipo == '<?= $cod ?>') && 'active']">
        <input
          type="radio"
          name="tipo-atencion"
          class="visually-hidden"
          x-model="$store.agenda.selectedTipo"
          value="<?= $cod ?>"
          data-name="<?= $name ?>"
        >
        <?= $name ?>
      </label>
    <?php endforeach ?>

    <?php if ($this->user()->getPago()?->isValid()): ?>
      <label :class="['d-block shadow', ($store.agenda.selectedTipo == 'PARTIC') && 'active']">
        <input
          type="radio"
          name="tipo-atencion"
          class="visually-hidden"
          x-model="$store.agenda.selectedTipo"
          value="PARTIC"
          data-name="Particular"
        > Particular
      </label>
    <?php endif ?>
  </select>
</div>
