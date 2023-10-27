import { createPreference } from "../requests";
import { errorAlert } from "@/partials/alerts"
import { showLoader } from "@/partials/loader";

export default () => ({
    state: {
        plan: "",
        tarjeta: false
    },

    init() {
        this.$watch("state.plan", () => {
            const plan = document.querySelector(".planes-item-checked div");
            document.querySelectorAll(".info-plan").forEach(el =>
                el.innerHTML = `
                    <span class="badge">Plan seleccionado:</span>
                    <div class="pb-2"> ${plan.innerHTML} </div>
                `);
        })
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
