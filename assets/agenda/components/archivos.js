import Alpine from "alpinejs";
import { errorAlert } from "@/partials/alerts";

export default () => ({
    maxSize: 5120, // 5mb
    acceptedTypes: ["application/pdf"],
    files: {
        formula: null,
        auto: null
    },

    init() {
        this.$watch("files.formula", () =>
            Alpine.store("agenda").files.formula = this.files.formula
        );
        this.$watch("files.auto", () =>
            Alpine.store("agenda").files.auto = this.files.auto
        );
    },

    /**
     * @param file {File | undefined} El archivo seleccionado por el usuario. Puede ser undefined
     * @param tipo {String} Correspone a 'formula' o 'auto'
    */
    async onChange( file, tipo ) {
        if (! Boolean(file) || !(file instanceof File))
            return this.files[tipo] = null;

        if (file.size / 1024 > this.maxSize) {
            errorAlert("El tamaño del archivo supera el máximo permitido.");
            return this.files[tipo] = null;
        }

        if (! this.acceptedTypes.includes( file.type )) {
            errorAlert("Tipo de archivo no permitido.");
            return this.files[tipo] = null;
        }

        this.files[tipo] = file;
    },

    get required() {
        return Alpine.store("agenda").selectedTipo !== "PARTIC";
    }
});
