import { getPlanes, createPreference } from "../requests";
import { errorAlert } from "@/partials/alerts"
import { showLoader } from "@/partials/loader";

export default () => ({
    planes: [],
    selectedPlan: "",

    async init() {
        await this.getPlanes();
    },

    /**
     * Obtiene los planes disponibles.
    */
    async getPlanes() {
        try {
            showLoader();
            this.planes = await getPlanes(true);
        } catch(e) {
            errorAlert();
            console.error("Get Planes: ", e);
        }
    },

    /**
     * Confirma el inicio del proceso de pago
    */
    async confirmPlan() {
        try {
            showLoader();
            const data = await createPreference( this.selectedPlan, true );
            this.$dispatch("start-checkin-process", data.id);
            this.$dispatch("next-tab");
        } catch(e) {
            errorAlert();
            console.error("Get Planes: ", e);
        }
    },

    /**
     * Ayuda a determinar que ya se han cargado los planes.
    */
    get planesLoaded() {
        return this.planes.length > 0;
    },

    /**
     * Dado que los beneficios se guardan en la base de datos como tipo texto
     * delimitado por ';' aqui lo que hacemos es convertirlos en array.
     *
     * @param {String} ben
    */
    parseBen( ben ) {
        return ben.split(";").map(b => b.trim());
    }
});
