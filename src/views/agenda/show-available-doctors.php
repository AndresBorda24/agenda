<div x-data x-cloak
class="border-top border-bottom mb-2 p-2 small bg-white"
x-show="Object.keys( Alpine.store('doctores') )[0]">
    <h6 class="text-center text-muted">Medicos:</h6>
    <div class="d-grid gap-1" style="grid-template-columns: repeat(auto-fit, minmax(90px, 1fr));">
        <template x-for="med in Object.keys( Alpine.store('doctores') )">
            <div class="d-flex flex-column align-items-center">
                <div
                class="rounded-circle m-1 p-2 border bg-opacity-75"
                style="aspect-ratio: 1;"
                :class="`bg-${Alpine.store('doctores')[ med ].color} border-${Alpine.store('doctores')[ med ].color}`"></div>
                <span
                class="text-center small"
                :class="`text-${Alpine.store('doctores')[ med ].color}`"
                x-text="Alpine.store('doctores')[ med ].nombre"></span>
            </div>
        </template>
    </div>
</div>
