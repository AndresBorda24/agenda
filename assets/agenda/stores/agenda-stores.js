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
        userData: null,
        selectedDay: null,
        selectedMed: null,
        selectedEsp: null, // Especialidad
        selectedEps: null, // Eps
        selectedHour: null,
        selectedTipo: null,
        selectedClase: null,
        files: {},
        get days() {
            return Object.keys(this.data);
        },
        get lugar() {
            return (this.selectedHour === null)
                ? ""
                : this.data[ this.selectedDay ][ this.selectedHour ]
        },
        get medico() {
            return Alpine.store("medicos")[this.selectedMed] || "";
        }
    });

    /** Doctores relacionados con la especialidad seleccionada */
    Alpine.store("medicos", {});

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
