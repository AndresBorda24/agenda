<div x-data x-cloak
class="my-2 p-2 small bg-primary rounded"
x-show="Object.keys( Alpine.store('doctores') )[0]">
  <h6 class="text-center text-light">Medicos:</h6>
  <div
  class="d-grid gap-1 small">
    <template x-for="med in Object.keys( Alpine.store('doctores') )">
      <div class="d-flex align-items-center small">
        <div
        class="rounded-bottom m-1 p-2 border bg-opacity-75"
        style="aspect-ratio: 1;"
        :class="`bg-${Alpine.store('doctores')[ med ].color} `
        + `border-${Alpine.store('doctores')[ med ].color}`
        "></div>
        <span
        class="text-light"
        x-text="Alpine.store('doctores')[ med ].nombre"></span>
      </div>
    </template>
  </div>
</div>
