import axios from "axios";
import iziToast from "izitoast";
import { showLoader, hideloader } from "../../partials/loader";

export default () => ({
    state: {},

    /**
    * Guarda el registro en la base de datos.
    */
    async save() {
        try {
            showLoader();
            await axios.post(
                process.env.API + "/usuarios/registro",
                this.state
            ).finally(hideloader);
        } catch(e) {
            console.error(e);

            iziToast.error({
                title: "Error",
                message: "Error al guardar la informacion"
            });
        }
    }
});
