import axios from "axios";

export default () => ({
    list: [],
    error: undefined,
    fetched: false,
    events: {
        ["@added-beneficiario.document.stop"]: "add($event.detail)"
    },

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

    /**
     * Agrega un registro al listado.
    */
    add( data ) {
        this.list.push( data );
    },

    get isEmpty() {
        return this.list.length === 0;
    }
});
