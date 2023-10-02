<form
x-data="Planes"
x-show="planesLoaded"
x-transition
@submit.prevent="confirmPlan">
  <div class="planes-container row-cols-12 row-cols-md-4  p-4">
    <template x-for="(plan, index) in planes" :key="plan.id">
      <?= $this->fetch("./planes/partials/plan/plan.php") ?>
    </template>
  </div>

  <div class="mt-5">
    <button
    type="submit"
    class="planes-next-btn">
      Continuar
    </button>
  </div>
</form>
