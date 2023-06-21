<template x-for="i in 3" :key="i">
  <div
  :class="{
    'plan-selected': state.plan == 'plan' + i
  }"
  class="p-3 plan-select rounded border border-secondary small d-flex flex-column bg-white">
    <!-- "cabecera" -->
    <div class="text-center">
      <span class="d-block fw-bold">Nombre Plan</span>
      <p class="text-muted">Breve descripci&oacute;n del plan</p>
      <span class="d-block fw-bold">$ 123.312</span>
      <span class="text-muted small">Pago Anual</span>
    </div>

    <!-- Beneficios -->
    <div class="my-3 py-3">
      <ul class="list-group list-group-flush small">
        <li class="list-group-item">Agua Caliente.</li>
        <li class="list-group-item">Agua Caliente.</li>
        <li class="list-group-item">Agua Caliente.</li>
        <li class="list-group-item">Agua Caliente.</li>
        <li class="list-group-item">Agua Caliente.</li>
      </ul>
    </div>

    <!-- Boton seleccionar -->
    <div class="p-2">
      <label
      :for="'plan-' + i"
      class="btn btn-sm btn-primary d-block m-auto">
        Seleccionar
      </label>
      <input
      type="radio"
      :id="'plan-' + i"
      name="plan"
      :value="'plan' + i"
      x-model="state.plan"
      class="visually-hidden">
    </div>
  </div>
</template>
