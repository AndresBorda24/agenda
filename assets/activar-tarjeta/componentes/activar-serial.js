import { successAlert } from "@/partials/alerts";
import { hideLoader, showLoader } from "@/partials/loader";
import { activarTarjeta } from "@/activar-tarjeta/requests";

export default () => ({
    serial: "",
    error: null,

    /**
     * Funcion que se ejecuta al escanear correctamente el QR.
    */
    async activar() {
        showLoader();
        const [e, _data] = await activarTarjeta( this.serial );
        hideLoader();

        if (e) {
            this.error = "No se ha conseguido activar la tarjeta. "
                + "Intenta luego. "
                + "Scanned QR: "
                + this.serial;
            return;
        }

        successAlert("Tarjeta Activada");
        this.$dispatch("tarjeta-activada");
    },
});
