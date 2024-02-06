import Alpine from "alpinejs";

/**
 * Los `stores` son objetos (o cualquier tipo de dato) a los
 * que puedo acceder desde cualquier script (JS) del proyecto.
 * Son algo asi como variables globales.
 *
 * Para acceder a un `store`
 *
 *  - Alpine.store("llave") -- Globalmete
 *  - $store["llave"] -- desde 'dentro' de un componente
*/
document.addEventListener('alpine:init', () => {
    /**
     * Aqui se almacena la informacion de la agenda
    */
    Alpine.store("agenda", {
        data: {},
        selectedDay: null,
        get days() {
            return Object.keys(this.data);
        }
    });
    /**
     * Doctores relacionados con la especialidad seleccionada
    */
    Alpine.store("doctores", {});
    /**
     * Esta es la fecha que aparece arriba en el calendario
    */
    Alpine.store("ctrlDate", undefined);
    /**
     * La especialidad que esta seleccionada actualmente en el panel
    */
    Alpine.store("selectedEsp", "");

    Alpine.store("loader", {
        _: document.getElementById('loader'),
        show() {
            this._.classList.remove('d-none');
        },
        hide() {
            this._.classList.add('d-none');
        }
    });
});
