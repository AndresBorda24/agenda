import { AxiosError } from "axios";
import { showLoader, hideLoader } from "@/partials/loader"
import { successAlert, errorAlert } from "@/partials/alerts";
import { startResetPasswd, resetPasswd } from "@/forgot/requests";
import { setInvalid, removeInvalid } from "@/partials/form-validation";


export default () => ({
    state: {
        doc: "",
        tel: null,
        cod: ['','','','',''],
        password: "",
        confirm_password: ""
    },
    error: null,
    finished: false,

    /** Obtiene el codigo bien formado a partir del array */
    get code() {
        return this.state.cod.join("");
    },

    /**
     * Se genera el codigo en el backend y se obtiene el telefono al que se
     * envio el codigo.
    */
    async startProcess() {
        showLoader();
        const [e, data] = await startResetPasswd(this.state.doc);
        hideLoader();

        if (e) {
            if (e instanceof AxiosError) setInvalid(e.response.data.fields || {});
            errorAlert();
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
        if (! this.checkPassword()) return;
        showLoader();
        const [e, data] = await resetPasswd({
            ... this.state,
            cod: this.code,
        });
        hideLoader();

        if (e) {
            if (e instanceof AxiosError) setInvalid(e.response.data.fields || {});
            errorAlert();
            return;
        }

        successAlert("Contraseña actualizada!")
        this.finished = true;
    },

    checkPassword() {
        if (this.state.password !== this.state.confirm_password) {
            setInvalid({
                "confirm_password": [
                    "Las contraseñas no coinciden"
                ]
            });

            return false;
        }
        return true;
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
    },

    /**
     * Maneja los eventos de los inputs en el apartado de codigo
     * @param {KeyboardEvent} e
     */
    onkeydown(e) {
        const index = parseInt(e.target.getAttribute("data-index"));

        if (e.keyCode === 8) {
            e.preventDefault();
            if (this.state.cod[ index ] == "")
                document.querySelector(`[data-index="${index - 1}"]`)?.focus();

            this.state.cod[ index ] = "";
            return;
        }

        if (/[\w\n]/.test(e.key) && e.key.length === 1) {
            e.preventDefault();
            this.state.cod[ index ] = e.key;
            document.querySelector(`[data-index="${index + 1}"]`)?.focus();
        }
    },
});
