import { cancelPreAgenda } from "@/mis-citas/requests"
import Alpine from "alpinejs";

export default (cita) => ({
    data: cita,
    showCancel: false,

    init() {
        this.el = this.$el;
    },

    async cancel() {
        Alpine.store("loader").show();
        const { data, error } = await cancelPreAgenda(this.data.id);
        Alpine.store("loader").hide();
        if (error !== null) return;
        console.log("data", data);
        if (data != true) return;

        this.data.estado = "C";
    },

    confirm() {
        this.showCancel = true;
    },

    get fecha() {
        return this.data.fecha.toJSON().substring(0, 10);
    },

    get canCancel() {
        return this.data.fecha > this.$data.tomorrow;
    }
})
