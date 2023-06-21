import axios from "axios";
import { showLoader, hideLoader } from "../../partials/loader";
import { successAlert, errorAlert } from "../../partials/alerts";

export default () => ({
    state: {},

    /**
    * Guarda el registro en la base de datos.
    */
    async save() {
        try {
            showLoader();
            await axios.post(
                process.env.API + "/pacientes-vip/registro",
                this.state
            ).finally(hideLoader);
            this.clearState();

            successAlert();
        } catch(e) {
            console.error(e);
            errorAlert();
        }
    },

    /**
     * Vacia todos los inputs y hace focus al input
    */
    clearState() {
        this.state = {};

        this.$nextTick(() => {
            document.querySelector('[x-model="state.num_histo"]').focus();
        })
    }
});
