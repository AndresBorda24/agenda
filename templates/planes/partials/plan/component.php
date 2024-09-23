<form
x-data="Planes"
x-transition
@submit.prevent="() => false && confirmPlan()">
  <div class="planes-container d-flex flex-wrap d-lg-grid align-items-baseline p-4 pt-2">
    <?php foreach($planes as $plan): ?>
      <?= $this->fetch("./planes/partials/plan/plan.php", [
        "plan" => $plan
      ]) ?>
    <?php endforeach ?>
  </div>
</form>
<hr>
<div class="mx-auto" style="max-width: 800px;">
  <h5 class="fw-bold text-center">Elige una forma de pago</h5>
  <div class="d-grid">
    <?= $this->fetch("./planes/partials/medios-pago/gou-micrositio-api.php") ?>
    <?= $this->fetch("./planes/partials/medios-pago/gou-micrositio.php") ?>
  </div>
</div>
