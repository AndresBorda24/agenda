import { createPreference } from "../requests";
import { errorAlert } from "@/partials/alerts"
import { showLoader } from "@/partials/loader";

export default () => ({
    state: {
        plan: "",
        tarjeta: false
    },

    /**
     * Confirma el inicio del proceso de pago
    */
    async confirmPlan() {
        showLoader();
        const [error, data] = await createPreference( this.state, true );

        if (error) {
            errorAlert();
            console.error("Get Planes: ", error);
            return;
        }

        this.$dispatch("start-checkin-process", data);
        this.$dispatch("next-tab");
    }
});
