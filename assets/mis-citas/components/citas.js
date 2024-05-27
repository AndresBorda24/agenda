import Alpine from "alpinejs";
import { getAuthCitas } from "@/mis-citas/requests"

export default () => ({
    user: '',
    citas: [],
    previous: true,
    canceled: false,
    tomorrow: new Date(),

    init() {
        this.tomorrow.setDate( this.tomorrow.getDate() + 1 );
        this.tomorrow.setHours(11, 59, 59);

        this.$watch("user", async () => await this.getCitas());
        const titular = document.querySelector(
            'option[data-tipo="T"]'
        )?.getAttribute('value');
        if (titular) this.user = titular;
    },

    async getCitas() {
        Alpine.store("loader").show();
        const { data, error } = await getAuthCitas(this.user);
        Alpine.store("loader").hide();

        if (error !== null) return;

        this.citas = data.map(c => {
            const f = c.fecha.split('-');
            c.fecha = new Date(f[0], f[1] - 1, f[2]);
            return c;
        });
    },

    citaCanceled({ detail: id }) {
        let cita = this.citas.find(c => c.id == id);
        if (cita) {
            cita.estado = "C";
        }
    },

    /** Listado de citas cuya fecha aun no se ha vencido */
    get citasActivas() {
        const hoy =  new Date();
        hoy.setHours(0, 0, 0, 0);

        return this.citas.filter(c => {
            return (c.fecha >= hoy || this.previous) && (c.estado != 'C' || this.canceled)
        }).sort((c1, c2) => c2.fecha - c1.fecha);
    },

    get totalCitas() {
        return this.citas.length;
    }
});
