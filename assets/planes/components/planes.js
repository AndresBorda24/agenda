import Alpine from "alpinejs";

export default () => ({
    state: {
        plan: "",
        tarjeta: false
    },

    init() {
        this.$watch("state.plan", () => {
            const plan = document.querySelector(".planes-item-checked div");
            document.querySelectorAll(".info-plan").forEach(el =>
                el.innerHTML = `
                    <span class="badge">Plan seleccionado:</span>
                    <div class="pb-2"> ${plan.innerHTML} </div>
                `);
        })
    },

    get selectedPlan() {
        return this.state.plan !== '';
    },

    /** Habilita la seleccion de la forma de pago */
    async confirmPlan() {
        Alpine.store('SelectedPlanStore', {
            plan: this.state.plan,
            tarjeta: this.state.tarjeta
        });

        this.$dispatch('show-gateways');
    }
});
