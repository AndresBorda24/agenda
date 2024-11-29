import Alpine from "alpinejs";

export default () => ({
    state: {
        plan: "",
        tarjeta: false
    },

    /** Habilita la seleccion de la forma de pago */
    confirmPlan(planId) {
        Alpine.store('SelectedPlanStore', {
            plan: planId,
            tarjeta: this.state.tarjeta
        });

        this.$dispatch('show-gateways');
    }
});
