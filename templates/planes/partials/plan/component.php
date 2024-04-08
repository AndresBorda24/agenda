<hr>

<button
  @click="tab = 4"
  class="btn btn-sm btn-warning d-block mx-auto shadow"
>Tengo un c&oacute;digo de regalo!</button>

<form
x-data="Planes"
x-transition
@submit.prevent="() => false && confirmPlan()">
  <div class="planes-container align-items-baseline p-4 pb-5">
    <?php foreach($planes as $plan): ?>
      <?= $this->fetch("./planes/partials/plan/plan.php", [
        "plan" => $plan
      ]) ?>
    <?php endforeach ?>
  </div>
  <hr>

  <?php if(false): ?>
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
  <?php else: ?>
    <section class="mx-auto d-flex align-items-center mb-4 p-2 small border-start border-5 border-danger rounded-end shadow" style="background-color: #ffdede; max-width: 700px;">
      <?= $this->fetch("./icons/sign.php", [
        "props" => 'style="min-width: 55px; height:60px;"'
      ]) ?>
      <span class="fs-6 px-4">
        Para realizar la compra de tu plan, por favor dirígete <span class="fw-bold">directamente a la Clínica</span>. Lamentamos las molestias.
      </span>
    </section>
  <?php endif ?>
</form>
