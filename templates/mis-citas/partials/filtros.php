<div class="d-flex flex-wrap gap-2 align-items-end mb-1">
  <div class="flex-fill" style="max-width: 400px;">
    <label for="select-user" class="form-label mb-0 small">Ver citas de:</label>
    <select
      class="form-select form-select-sm"
      id="select-user"
      name="select-user"
      x-model="user"
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

  <div>
    <div class="form-check small m-0">
      <input class="form-check-input" x-model="previous" type="checkbox" id="show-prev">
      <label class="form-check-label" for="show-prev" role="button">
        Mostrar Citas Anteriores
      </label>
    </div>
    <div class="form-check small mb-0">
      <input class="form-check-input" x-model="canceled" type="checkbox" id="show-canceled">
      <label class="form-check-label" for="show-canceled" role="button">
        Mostrar Canceladas
      </label>
    </div>
  </div>
</div>