import Alpine from "alpinejs";
import { errorAlert, successAlert } from "@/partials/alerts";
import { cancelPreAgenda } from "@/mis-citas/requests"

export default () => ({
    data: {},
    state: {},
    show: false, 
    events: {
        ["@cancelar-cita.document"]: "handleOpen"
    },

    handleOpen({ detail: data }) {
        this.state = {};
        this.data  = data;
        this.show  = true;
        this.$nextTick(() => {
            document.querySelector("#motivo-cancelacion")?.focus();
        })
    },

    close() {
        this.show = false;
        this.$nextTick(() => {
            this.data = {}
        });
    },

    async cancel() {
        Alpine.store("loader").show();
        const { data, error } = await cancelPreAgenda(this.data.id, this.state);
        Alpine.store("loader").hide();
        if (error !== null) {
            console.log(error);
            errorAlert(error?.response?.data?.message); 
            return
        };
        if (data != true) return;

        successAlert("Cita Cancelada");
        this.$dispatch(`cita-canceled`, this.data.id);
        this.close();
    },
});