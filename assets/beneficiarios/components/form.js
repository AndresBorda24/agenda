import { update, store } from "../requests";
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
        "x-transition.opacity.300ms": "",
        "@edit-beneficiario.document": "() => open($event.detail)"
    },

    init() {
        this.$watch('show', (isShowing) => {
            isShowing
                ? document.body.classList.add('overflow-hidden')
                : document.body.classList.remove('overflow-hidden')
        });
    },

    /**
     * Abre el modal y realiza el focus al primer input
    */
    open(state = {}) {
        this.show = true;
        this.state = state;
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
            const { data, error } = this.isEdit
                ? await update(this.state.id, this.state)
                : await store(this.state);
            hideLoader();

            if (error !== null) {
                if (error instanceof AxiosError) setInvalid(error.response.data.fields);
                errorAlert();
                return;
            }

            this.dispatchEvent( data );
            this.show = false;
            successAlert();
        } catch(e) {

            console.error(e);
        }
    },

    /**
     * Despachamos un evento para que se agrege el beneficiario al listado.
    */
    dispatchEvent( id ) {
        const event = this.isEdit ? "edited-beneficiario" : "added-beneficiario";

        this.$dispatch(event, {
            id: this.isEdit ? this.state.id : id,
            nom1: this.state.nom1,
            nom2: this.state.nom2,
            ape1: this.state.ape1,
            ape2: this.state.ape2,
            sexo: this.state.sexo,
            tipo_doc: this.state.tipo_doc,
            documento: this.state.documento,
            fecha_nac: this.state.fecha_nac,
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
    },

    get isEdit() {
        return Boolean(this.state?.id)
    }
});
