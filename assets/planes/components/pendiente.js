import { deletePago } from "@/planes/requests";

export default () => ({
    pagoId: 0,
    prefId: "",
    _el: null,

    init() {
        const _ = document.getElementById("pago-pendiente-metadata");
        const meta = _?.dataset;

        this.pagoId = meta?.pagoId;
        this.prefId = meta?.prefId;
        if (_) _.remove();
        // ---------------------------------------------------------------------
        this._el = this.$el;
    },

    /**
     * Elimina el registro del pago realizado en la base de datos y retorna al
     * listado de planes.
    */
    cancelPay() {
        try {
            deletePago( this.pagoId );
            this.tab++;
            this.removeEl();
        } catch(e) {
            console.error(e);
        }
    },

    /**
     * Continua con la seleccion del "metodo" de pago.
    */
    continuePay() {
        this.tab += 2;
        this.$dispatch("start-checkin-process", {
            pago: this.pagoId,
            id: this.prefId
        });
        this.removeEl();
    },

    /**
     * Elimina el componente completamente.
    */
    removeEl() {
        this._el?.remove();
    }
})
