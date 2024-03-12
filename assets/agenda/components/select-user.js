import Alpine from "alpinejs";
import { getBeneficiarioInfo, getAuthInfo } from "../requests";

export default () => ({
    user: '',

    init() {
        this.$watch('user', () => {
            const tipo  = document
                .querySelector(`[value="${this.user}"]`)
                .getAttribute("data-tipo");

            this.handler( tipo );
        });
    },

    async handler( tipo ) {
        Alpine.store("agenda").userData = null;
        const { data, error } = (tipo === "B")
            ? await getBeneficiarioInfo(this.user)
            : await getAuthInfo();

        if (error != null) return;
        if (tipo === "B") {
            data.num_histo = data.documento;
        }

        Alpine.store("agenda").userData = data;
    }
});