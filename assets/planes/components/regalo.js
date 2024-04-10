import { AxiosError } from "axios"
import { redimir } from "@/planes/requests";
import { showLoader, hideLoader } from "@/partials/loader";
import { successAlert, errorAlert } from "@/partials/alerts";
import { removeInvalid, setInvalid } from "@/partials/form-validation";

export default () => ({
    code: ['','','','','',''],
    success: false,

    async save() {
        removeInvalid();
        showLoader();
        const [e, data] = await redimir(this.code.join(""));
        hideLoader();

        if (e) {
            this.handleError(e);
            return;
        }

        successAlert("Código redimido correctamente!");
        this.success = true;
    },

    /**
     * @param {KeyboardEvent} e
     */
    onkeydown(e) {
        const index = parseInt(e.target.getAttribute("data-index"));

        if (e.keyCode === 8) {
            e.preventDefault();
            if (this.code[ index ] == "")
                document.querySelector(`[data-index="${index - 1}"]`)?.focus();

            this.code[ index ] = "";
            return;
        }

        if (/[\w\n]/.test(e.key) && e.key.length === 1) {
            e.preventDefault();
            this.code[ index ] = e.key;
            document.querySelector(`[data-index="${index + 1}"]`)?.focus();
        }
    },

    handleError(e) {
        if (e instanceof AxiosError) {
            setInvalid(e.response?.data?.fields ?? {});
        }

        errorAlert("Error al redimir el código.");
    }
});
