import Alpine from "alpinejs";
import { getAuthCitas } from "@/mis-citas/requests"

export default (documento) => ({
    documento,
    citas: [],
    tomorrow: new Date(),

    async init() {
        this.tomorrow.setDate( this.tomorrow.getDate() + 1 );
        this.tomorrow.setHours(11, 59, 59);

        Alpine.store("loader").show();
        const { data, error } = await getAuthCitas(this.documento);
        Alpine.store("loader").hide();

        if (error !== null) return;

        this.citas = data.map(c => {
            const f = c.fecha.split('-');
            c.fecha = new Date(f[0], f[1] - 1, f[2]);
            return c;
        });
    },

    /** Listado de citas cuya fecha aun no se ha vencido */
    get citasActivas() {
        return this.citas.filter(c => c.fecha >= new Date() && c.estado != 'C');
    }
});
