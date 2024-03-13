import axios from "axios";

export default () => ({
    list: [],
    error: undefined,
    fetched: false,
    events: {
        ["@added-beneficiario.document.stop"]: "add($event.detail)",
        ["@edited-beneficiario.document.stop"]: "update($event.detail)"
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

    update( data ) {
        const beneficiario = this.list.find(b => b.id == data.id);
        if (! beneficiario) return;

        beneficiario.id = data.id
        beneficiario.nom1 = data.nom1
        beneficiario.nom2 = data.nom2
        beneficiario.ape1 = data.ape1
        beneficiario.ape2 = data.ape2
        beneficiario.sexo = data.sexo
        beneficiario.tipo_doc = data.tipo_doc
        beneficiario.documento = data.documento
        beneficiario.fecha_nac = data.fecha_nac
        beneficiario.parentesco = data.parentesco
    },

    get isEmpty() {
        return this.list.length === 0;
    }
});
