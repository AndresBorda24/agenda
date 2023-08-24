<div class="p-4 border-top bg-primary">
  <input
  name="plan"
  required
  type="radio"
  :value="plan.id"
  :id="`plan-${plan.id}`"
  x-model="selectedPlan"
  class="visually-hidden">

  <label
  :for="`plan-${plan.id}`"
  role="button"
  class="btn btn-warning btn-sm d-block w-100 mx-auto shadow rounded-5">
    Elegir
  </label>
</div>
