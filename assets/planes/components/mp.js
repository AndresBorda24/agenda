import { showLoader, hideLoader } from "@/partials/loader";

export default () => ({
    events: {
        ["@start-checkin-process.document.stop"]: "showButton"
    },

    async showButton($e) {
        const mp = new MercadoPago(process.env.MP_PUBLIC, {
            locale: "es-CO"
        });
        const bricksBuilder = mp.bricks();

        showLoader();
        await bricksBuilder.create("wallet", "mercadopago", {
           initialization: {
               preferenceId: $e.detail
           },
        });
        hideLoader();
    }
})
