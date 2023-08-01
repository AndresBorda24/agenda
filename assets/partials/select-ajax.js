import axios from "axios";
import { errorAlert } from "./alerts";

export default () => ({
    show: false,
    options: [],
    endpoint: null,
    bindings: {
        ["x-show"]: "show",
        ["x-transition"]: ""
    },

    async init() {
        try {
            this.endpoint = this.$el.dataset.selectEp || null;
            await this.getOptions();
        } catch(e) {
            console.error(e);
        }
    },

    async getOptions() {
        try {
            if (! this.endpoint) return;

            const {data} = await axios
                .get(process.env.API + this.endpoint);

            this.options = data.eps;
            this.show = true;
        } catch(e) {
            errorAlert("No se cargaron las EPS. Intenta luego.");
            console.error("Get Eps:", e);
        }
    }
});
