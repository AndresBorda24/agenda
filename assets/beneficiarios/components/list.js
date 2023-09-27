import axios from "axios";

export default () => ({
    list: [],
    error: undefined,
    fetched: false,

    init () {
        this.fetch()
    },

    /**
     * Obtiene el listado de los beneficiarios asociados al titular en
     * sesion.
     *
     * @return {void}
    */
    async fetch() {
        try {
            const {data} = await axios.get(
                process.env.API + "/auth/beneficiarios"
            );
            this.fetched = true;
            this.list = data;
        } catch(e) {
            this.error = e.message;
        }
    },

    get isEmpty() {
        return this.list.length === 0;
    }
});
