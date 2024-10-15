<form
x-data="Planes"
x-transition
@submit.prevent="confirmPlan">
  <button
    type="submit"
    :disabled="!selectedPlan"
    class="d-block btn btn-sm btn-warning m-auto shadow mb-3"
  >Continuar con el pago</button>

  <div class="planes-container d-flex flex-wrap d-lg-grid align-items-baseline p-4 pt-2">
    <?php foreach($planes as $plan): ?>
      <?= $this->fetch("./planes/partials/plan/plan.php", [
        "plan" => $plan
      ]) ?>
    <?php endforeach ?>
  </div>
</form>
