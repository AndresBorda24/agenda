<div style="grid-column: 1 / -1;" x-data="selectUser">
  <label
    for="usuario-cita"
    class="form-label fw-bold"
  >Selecciona para quien será la cita:</label>
  <select
    class="form-select form-select-sm"
    id="usuario-cita"
    x-model="user"
    name="usuario-cita"
    required
  >
    <option hidden selected value=""> Selecciona </option>
    <option value="<?= $this->user()->info->documento ?>" data-tipo="T">
      <?= $this->user()->fullName() ?>
    </option>
    <optgroup label="Beneficiarios">
      <?php foreach ($beneficiarios as $b): ?>
        <option data-tipo="B" value="<?= $b['documento'] ?>"><?= implode(" ", [
          $b['nom1'],
          $b['nom2'],
          $b['ape1'],
          $b['ape2'],
        ])?></option>
      <?php endforeach ?>
    </optgroup>
  </select>
</div>