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
    onChange( file, tipo ) {
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

    /** @param tipo {String} Correspone a 'formula' o 'auto' */
    cleanFile( tipo ) {
        let input = document.getElementById("file-"+tipo);
        if (! input) return;

        input.value = "";
        let e = new Event("change", { bubbles: false });
        input.dispatchEvent(e);
    },

    get required() {
        return ! ['PARTIC','MED_PREP'].includes(Alpine.store("agenda").selectedTipo);
    }
});
