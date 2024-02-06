<div x-data class="mx-3">
  <template x-if="$store.selectedItems.med">
    <p class="small">Los dias que cuenten con horas de agendamiento disponibles estarán resaltados de color amarillo.</p>
  </template>

  <template x-if="$store.selectedItems.med === null">
    <p class="small">Selecciona un médico del listado desplegable de arriba.</p>
  </template>
</div>
