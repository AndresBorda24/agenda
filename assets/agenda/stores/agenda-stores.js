import Alpine from "alpinejs";

/**
 * Los `stores` son objetos (o cualquier tipo de dato) a los
 * que puedo acceder desde cualquier script (JS) del proyecto.
 * Son algo asi como variables globales.
*/
document.addEventListener('alpine:init', () => {
    /** Aqui se almacena la informacion de la agenda */
    Alpine.store("agenda", {
        data: {},
        selectedDay: null,
        get days() {
            return Object.keys(this.data);
        }
    });

    /** Doctores relacionados con la especialidad seleccionada */
    Alpine.store("doctores", {});

    /** Esta es la fecha que aparece arriba en el calendario */
    Alpine.store("ctrlDate", undefined);

    /** Guarda el codigo del medico y el nombre de la especialidad  */
    Alpine.store("selectedItems", {
        med: null,
        especialidad: ""
    });

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
