import axios from "axios";
import { errorAlert } from "./alerts";

export default () => ({
    show: false,
    bindings: {
        ["x-show"]: "show",
        ["x-transition"]: ""
    },

    async getOptions() {
        try {
            const {data} = await axios
                .get(import.meta.env.VITE_APP_API + '/get-all-eps');

            return data.eps;
        } catch(e) {
            errorAlert("No se cargaron las EPS. Intenta luego.");
            console.error("Get Eps:", e);
        }
    }
});
