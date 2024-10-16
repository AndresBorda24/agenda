import axios, { AxiosError } from "axios";
import { showLoader, hideLoader } from "../../partials/loader";
import { errorAlert } from "../../partials/alerts";
import { setInvalid, removeInvalid } from "../../partials/form-validation";

export default () => ({
    state: {},

    async login() {
        try {
            removeInvalid();
            showLoader();

            const {data} = await axios.post(
                import.meta.env.VITE_APP_API + "/login" ,
                this.getBody()
            );

           if (data.status) {
                window.location.replace(data.redirect);
                return;
           }

            hideLoader();
        } catch(e) {
            hideLoader();
            if (e instanceof AxiosError) {
                setInvalid({
                    documento: ["Datos Invalidos..."]
                });
            }
            console.error(e);
            errorAlert();
        }
    },

    getBody() {
        return {
            documento: this.state.documento.trim(),
            clave: this.state.clave.trim()
        }
    }
});
