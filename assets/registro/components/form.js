import axios from "axios";
import { showLoader, hideLoader } from "../../partials/loader";
import { successAlert, errorAlert } from "../../partials/alerts";
import { setInvalid, removeInvalid } from "../../partials/form-validation";

export default () => ({
    state: {},

    /**
    * Guarda el registro en la base de datos.
    */
    async save() {
        try {
            removeInvalid();
            if (! this.checkPass()) return;

            showLoader();

            await axios.post(
                process.env.API + "/pacientes-vip/registro",
                this.state
            ).finally(hideLoader);
            this.clearState();

            successAlert();
        } catch(e) {
            if (e instanceof AxiosError) {
                this.setErros(e.response.data);
            }
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
    },

    /**
     * Remarca los campos con error
    */
    setErros(data) {
        try {
            setInvalid(data.fields);
        } catch(e) {
            console.error("E", e);
        }
    },

    /**
     * Revisa que las claves coincidan.
    */
    checkPass() {
        if (this.state.clave === this.state.clave_confirm) {
            return true;
        }

        setInvalid({
            clave: ["No Coinciden"],
            clave_confirm: ["No Coinciden"]
        });
    }
});
