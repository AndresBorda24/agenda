import { deletePago } from "@/planes/requests";
import { showLoader, hideLoader } from "@/partials/loader";

export default () => ({
    button: undefined,
    pagoId: 0,
    events: {
        ["@start-checkin-process.document.stop"]: "setUp"
    },

    setUp($e) {
        this.pagoId = $e.detail.pago;
        this.showButton($e.detail.id);
    },

    /**
     * Crea el boton de "Mercado pago". para esto es necesario el ID de una
     * preferencia. Este id es el que se pasa por el evento:
     * start-checkin-process.
    */
    async showButton( preference ) {
        // Si el boton ya ha sido creado necesitamos eliminarlo y generarlo
        // de nuevo.
        if (this.button !== undefined) {
            this.button.unmount();
        }

        const mp = new MercadoPago(process.env.MP_PUBLIC, {
            locale: "es-CO"
        });

        showLoader();
        this.button = await mp.bricks().create("wallet", "mercadopago", {
           initialization: {
               preferenceId: preference
           },
        }).finally(hideLoader);
    },

    /**
     * Elimina el registro del pago realizado en la base de datos y retorna al
     * listado de planes.
    */
    cancelPay() {
        try {
            deletePago( this.pagoId );
            this.tab--;
        } catch(e) {
            console.error(e);
        }
    }
})
