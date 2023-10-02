import { errorAlert } from "@/partials/alerts"
import { updatePassword } from "@/profile/requests";
import { removeInvalid, setInvalid } from "@/partials/form-validation";

export default () => ({
    state: {},
    cansubmit: true,

    async update() {
        removeInvalid();
        const [data, error] = await updatePassword( this.state );

        if (error) {
            setInvalid(error.response?.data?.fields || []);
            errorAlert();
            return;
        }

        this.cansubmit = false;
        document.getElementById("logout-form")?.submit();
    }
});
