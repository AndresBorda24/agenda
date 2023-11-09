import { AxiosError } from "axios";
import { showLoader, hideLoader } from "@/partials/loader"
import { successAlert, errorAlert } from "@/partials/alerts";
import { startResetPasswd, resetPasswd } from "@/forgot/requests";
import { setInvalid, removeInvalid } from "@/partials/form-validation";


export default () => ({
    state: {
        doc: "",
        tel: null,
        cod: null,
        password: "",
        confirm_password: ""
    },
    error: null,

    /**
     * Se genera el codigo en el backend y se obtiene el telefono al que se
     * envio el codigo.
    */
    async startProcess() {
        showLoader();
        const [e, data] = await startResetPasswd(this.state.doc);
        hideLoader();

        if (e) {
            this.error = e.response?.data?.message;
            return;
        }

        this.state.tel = data.tel;
        setTimeout(() => {
            document.querySelector('[x-model="state.cod"]')?.focus();
        }, 10);
    },

    /**
     * Realiza la solicitud para actualizar definitivamente la contrasenia.
    */
    async resetPass() {
        showLoader();
        const [e, data] = await resetPasswd(this.state);
        hideLoader();

        if (e) {
            if (e instanceof AxiosError) setInvalid(e.response.data.fields || {});
            errorAlert();
            return;
        }

        if (data) successAlert("Contraseña actualizada!");
    },

    /**
     * Determina que solicitud realizar.
    */
    action() {
        this.error = null;
        removeInvalid();
        if (this.state.tel === null) {
            this.startProcess();
            return;
        }

        this.resetPass();
    }
});
