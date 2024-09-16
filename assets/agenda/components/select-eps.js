import Alpine from "alpinejs";
import { getListadoEPS } from "../requests";
import { errorAlert } from "@/partials/alerts";

export default () => ({
    eps: [],
    fetched: false,

    init() {
        this.$watch("$store.agenda.selectedTipo", () => {
            Alpine.store("agenda").selectedEps = null;
        });
        this.loadEPS()
    },

    async loadEPS() {
        const {error, data} = await getListadoEPS()
        if (error) return errorAlert('No se han cargado las EPS.');

        this.eps = data
        this.fetched = true
    }
});
