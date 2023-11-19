import ax from "@/partials/ax";
import { AxiosError } from "axios";
import { showLoader, hideLoader } from "@/partials/loader";
import { successAlert, errorAlert } from "@/partials/alerts";
import { setInvalid, removeInvalid } from "@/partials/form-validation";

export default () => ({
    show: false,
    state: {},
    /** Cuantos beneficiarios se pueden crear */
    limit: 8,
    bindings: {
        "x-show": "show",
        "x-cloak": "",
        "x-transition.opacity.300ms": ""
    },

    /**
     * Abre el modal y realiza el focus al primer input
    */
    open() {
        this.show = true;
        this.state = {};
        setTimeout(() =>{
            document.getElementById("tipo_doc")?.focus()
        } , 20);
    },

    /**
    * Guarda el registro en la base de datos.
    */
    async save() {
        try {
            removeInvalid();
            showLoader();

            const { data } = await ax.post(
                "/auth/beneficiario",
                this.state
            ).finally(hideLoader);

            this.dispatchAdded( data );
            this.show = false;
            successAlert();
        } catch(e) {
            if (e instanceof AxiosError) setInvalid(e.response.data.fields);

            console.error(e);
            errorAlert();
        }
    },

    /**
     * Despachamos un evento para que se agrege el beneficiario al listado.
    */
    dispatchAdded( id ) {
        this.$dispatch("added-beneficiario", {
            id: id,
            nombre: [
                this.state.nom1,
                this.state.nom2,
                this.state.ape1,
                this.state.ape2
            ].filter(x => Boolean(x)).join(" ").toUpperCase(),
            documento: this.state.documento,
            parentesco: this.state.parentesco.toUpperCase()
        });
    },

    /**
     * Determina si se pueden agregar nuevos beneficiarios.
     * @return {boolean}
    */
    get canAddMore() {
        return this.fetched // Esta propiedad sale del componente de lista
        && ! Boolean(this.error) // Esta tambien
        && this.list.length < this.limit;
    }
});
