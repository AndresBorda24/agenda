import { deletePago, setNominaPago } from "@/planes/requests";
import { showLoader, hideLoader } from "@/partials/loader";
import { errorAlert, questionAlert } from "@/partials/alerts";

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
    },

    /**
     * Actualiza la informacion del pago y lo setea a nomina.
    */
    nomina() {
        const callback = async (i, t) => {
            showLoader();
            const [e, data] = await setNominaPago(this.pagoId,  false);

            if (! e) {
                location.reload();
                return;
            }

            hideLoader();
            errorAlert("Intenta con otro medio de pago.");
            i.hide({ transitionOut: 'fadeOut' }, t, 'button')
        };

        questionAlert({
            message: `Realmente deseas pagar por medio de <br />
            <span class="fw-bold">descuentos</span> en
            <span class="fw-bold">N&oacute;mina?</span>`,
            yesAction: callback
        });
    }
})
