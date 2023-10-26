<label
  for="<?= "plan-$plan[id]" ?>"
  :class="{'planes-item-checked': (state.plan == <?= $plan["id"] ?>) }"
  class="bg-white d-flex flex-column rounded-1 planes-item overflow-hidden"
>
  <?= $this->fetch("./planes/partials/plan/header.php", [
    "valor" => $plan["valor_formatted"],
    "nombre" => $plan["nombre"],
    "vigencia" => $plan["vigencia"],
  ]) ?>

  <?= $this->fetch("./planes/partials/plan/beneficios.php", [
    "beneficios" => $plan["beneficios"]
  ]) ?>

  <div class="text-muted">
    <?= $this->fetch("./planes/partials/plan/exclusiones.php") ?>
  </div>

  <input
    required
    name="plan"
    type="radio"
    value="<?= $plan["id"] ?>"
    id="<?= "plan-$plan[id]" ?>"
    x-model="state.plan"
    class="visually-hidden"
  >
</label>
