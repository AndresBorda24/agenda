import QrScanner from "qr-scanner";
import { successAlert } from "@/partials/alerts";
import { activarTarjeta } from "@/activar-tarjeta/requests";
import { hideLoader, showLoader } from "@/partials/loader";

export default () => ({
    qReader: null,
    error: null,

    init() {
        this.qReader = new QrScanner(
            document.getElementById("qr-reader"),
            ( res ) => this.qdRead(res),
            {
                returnDetailedScanResult: true,
                highlightScanRegion: true,
                highlightCodeOutline: true
            }
        );
    },

    /**
     * Funcion que se ejecuta al escanear correctamente el QR.
    */
    async qdRead({ data }) {
        this.stopReader();
        showLoader();
        const [e, _data] = await activarTarjeta( data );
        hideLoader();

        if (e) {
            const ms = e.response?.data?.fields?.serial[0];
            this.error = "No se ha conseguido activar la tarjeta. \n\n";

            if (ms) this.error += ms;
            else this.error += `Scanned: ${data}`

            return;
        }

        successAlert("Tarjeta Activada");
        this.$dispatch("tarjeta-activada");
    },

    /** Activa la camara, si la hay */
    async startReader() {
        this.error = null;
        if (! await QrScanner.hasCamera()) {
            this.error = "No se encontró una cámara en el dispositivo.";
            return;
        }

        this.qReader?.start();
    },

    /** Detiene la camara */
    stopReader() {
        this.qReader?.stop();
    }
});
