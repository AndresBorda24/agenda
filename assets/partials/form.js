import axios, { AxiosError } from "axios";
import { showLoader, hideLoader } from "./loader";
import { successAlert, errorAlert } from "./alerts";
import { setInvalid, removeInvalid } from "./form-validation";

export default () => ({
    state: {},
    endPoint: "",
    firstInput: "",

    async init() {
        await this.$nextTick();
        this.endPoint = this.$el.dataset.endPoint || "";

        const fi = this.$el.querySelector("input");
        if (fi) {
            this.firstInput = fi;
        }
    },

    /**
    * Guarda el registro en la base de datos.
    */
    async save() {
        try {
            removeInvalid();
            if (! this.checkPass()) return;

            showLoader();

            await axios.post(process.env.API + this.endPoint, this.state)
                .finally(hideLoader);
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
     * Vacia todos los inputs y hace focus al input
    */
    clearState() {
        this.state = {};

        this.$nextTick(() => {
            if(this.firstInput) {
                this.firstInput.focus();
            }
        })
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
