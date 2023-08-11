import axios from "axios";
import { errorAlert } from "@/partials/alerts"

export default () => ({
    planes: [],
    selectedPlan: "",

    async init() {
        await this.getPlanes();
    },

    /**
     * Obtiene los planes disponibles.
    */
    async getPlanes() {
        try {
            const { data } = await axios.get(
                process.env.API + "/planes/get-available"
            );

            this.planes = data;
        } catch(e) {
            errorAlert();
            console.error("Get Planes: ", e);
        }
    },

    /**
     * Dado que los beneficios se guardan en la base de datos como tipo texto
     * delimitado por ';' aqui lo que hacemos es convertirlos en array.
     *
     * @param {String} ben
    */
    parseBen( ben ) {
        return ben.split(";").map(b => b.trim());
    }
});
