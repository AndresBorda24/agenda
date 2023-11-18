import { showLoader } from "@/partials/loader";
import { successAlert, errorAlert } from "@/partials/alerts";

export default () => ({
    code: "",
    success: false,

    async save() {
        successAlert(this.code)
    }
});
