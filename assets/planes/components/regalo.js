import { AxiosError } from "axios"
import { redimir } from "@/planes/requests";
import { showLoader, hideLoader } from "@/partials/loader";
import { successAlert, errorAlert } from "@/partials/alerts";
import { removeInvalid, setInvalid } from "@/partials/form-validation";

export default () => ({
    code: "",
    success: false,

    async save() {
        removeInvalid();
        showLoader();
        const [e, data] = await redimir(this.code);
        hideLoader();

        if (e) {
            this.handleError(e);
            return;
        }

        successAlert("Código redimido correctamente!");
        this.success = true;
    },

    handleError(e) {
        if (e instanceof AxiosError) {
            setInvalid(e.response?.data?.fields ?? {});
        }

        errorAlert("Error al redimir el código.");
    }
});
