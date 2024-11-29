<div
  x-data="Planes"
  x-transition
  class="py-6 mb-6"
>
  <div class="mx-auto grid gap-6 [grid-template-columns:_repeat(auto-fit,minmax(240px,1fr))] justify-center">
    <?php foreach($planes as $plan): ?>
      <?= $this->fetch("./planes/partials/card.php", [
        "plan" => $plan,
        "isColaborador" => ($plan['id'] == $planColaboradorId)
      ]) ?>
    <?php endforeach ?>
  </div>
</div>
