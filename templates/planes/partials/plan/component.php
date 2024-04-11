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
  <hr>

  <?php if(false):  // En este bloque se hacia lo de mercado libre :( ?>
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
  <?php endif ?>
  </form>

  <div class="mx-auto" style="max-width: 800px;">
    <h5 class="fw-bold text-center">Elige una forma de pago</h5>
    <?= $this->fetch("./planes/partials/plan/gou-micrositio-ayuda.php") ?>
  </div>