import { AxiosError } from "axios";
import { saveRegistro } from "@/registro/requests";
import { successAlert, errorAlert } from "@/partials/alerts";
import { setInvalid, removeInvalid } from "@/partials/form-validation";

export default () => ({
    state: {},

    init() {
        setTimeout( () =>
            this.$el.querySelector("input")?.focus(),
            20
        );
    },

    async save() {
        removeInvalid();
        if( !this.checkPass() ) return;

        const [ res, error ] = await saveRegistro( this.state );

        if (error) return this.handleError(error);

        successAlert("Registro realizado.");
        if (res.redirect) window.location.replace(res.redirect);
    },

    handleError( e ) {
        if (e instanceof AxiosError) setInvalid(e.response.data.fields);

        console.error(e);
        errorAlert();
    },

    /**
     * Revisa que las claves coincidan.
    */
    checkPass() {
        if (this.state.clave === this.state.clave_confirm) return true;

        setInvalid({
            clave: ["No Coinciden"],
            clave_confirm: ["No Coinciden"]
        });
        return false;
    }
});
