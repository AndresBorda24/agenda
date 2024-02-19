import { getAuthCitas } from "@/mis-citas/requests"
import Alpine from "alpinejs";

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
        this.citas = data;
    }
});
