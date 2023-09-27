import axios, { AxiosError } from "axios";
import { showLoader, hideLoader } from "@/partials/loader";
import { successAlert, errorAlert } from "@/partials/alerts";
import { setInvalid, removeInvalid } from "@/partials/form-validation";

export default () => ({
    show: false,
    state: {},
    bindings: {
        "x-show": "show",
        "x-cloak": "",
        "x-transition.opacity.300ms": ""
    },

    /**
     * Abre el modal y realiza el focus al primer input
    */
    open() {
        this.show = true;
        this.state = {};
        setTimeout(() =>{
            document.getElementById("tipo_doc")?.focus()
        } , 20);
    },

    /**
    * Guarda el registro en la base de datos.
    */
    async save() {
        try {
            removeInvalid();
            showLoader();

            const { data } = await axios.post(
                process.env.API + "/auth/beneficiario",
                this.state
            ).finally(hideLoader);

            this.$dispatch("added-beneficiario", { ...this.state, id: data.id });
            this.show = false;
            successAlert();
        } catch(e) {
            if (e instanceof AxiosError) setInvalid(e.response.data.fields);

            console.error(e);
            errorAlert();
        }
    },

});
