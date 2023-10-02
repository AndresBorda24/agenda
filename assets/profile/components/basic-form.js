import { successAlert, errorAlert } from "@/partials/alerts"
import { getUserData, updateUser } from "@/profile/requests";
import { removeInvalid, setInvalid } from "@/partials/form-validation";

export default () => ({
    state: {},

    async init() {
        this.state = await getUserData();
    },

    async update() {
        removeInvalid();
        const [data, error] = await updateUser( this.state );

        if (error) {
            setInvalid(error.response?.data?.fields || []);
            errorAlert();
            return;
        }

        successAlert("Informaci&oacute;n atualizada!");
    }
})
