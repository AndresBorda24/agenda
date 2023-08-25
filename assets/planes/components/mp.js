import { showLoader, hideLoader } from "@/partials/loader";

export default () => ({
    button: undefined,
    events: {
        ["@start-checkin-process.document.stop"]: "showButton"
    },

    /**
     * Crea el boton de "Mercado pago". para esto es necesario el ID de una
     * preferencia. Este id es el que se pasa por el evento:
     * start-checkin-process.
    */
    async showButton($e) {
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
               preferenceId: $e.detail
           },
        }).finally(hideLoader);
    }
})
