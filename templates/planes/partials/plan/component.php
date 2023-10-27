<hr>
<form
x-data="Planes"
x-transition
@submit.prevent="confirmPlan">
  <div class="planes-container row-cols-12 row-cols-md-4  p-4">
    <?php foreach($planes as $plan): ?>
      <?= $this->fetch("./planes/partials/plan/plan.php", [
        "plan" => $plan
      ]) ?>
    <?php endforeach ?>
  </div>
  <hr>
  <?= $this->fetch("./planes/partials/checks.php") ?>

  <div class="mt-3">
    <div
      style="max-width: 280px;"
      class="info-plan bg-dark rounded small mx-auto shadow mb-2"
    ></div>
    <button
    type="submit"
    class="planes-next-btn">
      Continuar
    </button>
  </div>
</form>
