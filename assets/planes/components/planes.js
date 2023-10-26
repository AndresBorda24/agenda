import { createPreference } from "../requests";
import { errorAlert } from "@/partials/alerts"
import { showLoader } from "@/partials/loader";

export default () => ({
    planes: [],
    state: {
        plan: "",
        tarjeta: false
    },

    /**
     * Confirma el inicio del proceso de pago
    */
    async confirmPlan() {
        try {
            showLoader();
            const data = await createPreference( this.selectedPlan, true );
            this.$dispatch("start-checkin-process", data);
            this.$dispatch("next-tab");
        } catch(e) {
            errorAlert();
            console.error("Get Planes: ", e);
        }
    }
});
