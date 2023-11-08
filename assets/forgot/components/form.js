import { startResetPasswd } from "@/forgot/requests";
import { showLoader, hideLoader } from "@/partials/loader"


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

    action() {
        this.error = null;
        if (this.state.tel === null) {
            this.startProcess();
            return;
        }
    }
});
