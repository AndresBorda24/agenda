import Alpine from "alpinejs";
import { getAuthInfo, agendar } from "@/agenda/requests"

export default () => ({
    fechaAgenda: "",
    selectedTipo: "",
    selectedClase: "",
    errorMessage: null,
    misCitasLink: process.env.APP_PATH + "/mis-citas",
    init() {
        this.$watch("$store.agenda.selectedDay", () =>{
            this.fechaAgenda = document
                .querySelector("[x-text='selectedDay']")?.innerText || "";
        });

        this.$watch("$store.agenda.selectedTipo", (val) =>{
            this.selectedTipo = document
                .querySelector(`[value="${val}"]`)?.dataset.name || "";
        });

        this.$watch("$store.agenda.selectedClase", (val) =>{
            this.selectedClase = document
                .querySelector(`[value="${val}"]`)?.dataset.name || "";
        });
    },

    /** Arma el cuerpo de la solicitud */
    async getBody() {
        const { data } = await getAuthInfo();

        return {
            hora: Alpine.store("agenda").selectedHour,
            tipo: Alpine.store("agenda").selectedTipo,
            email: data.email,
            fecha: Alpine.store("agenda").selectedDay,
            lugar: Alpine.store("agenda").lugar,
            ciudad: data.ciudad,
            medico: Alpine.store("agenda").selectedMed,
            nombre1: data.nom1,
            nombre2: data.nom2,
            cod_enti: (Alpine.store("agenda").selectedTipo == 'PARTIC')
                ? "PARTIC" : data.eps,
            telefono: data.telefono,
            claseCon: Alpine.store("agenda").selectedClase,
            num_histo: data.num_histo,
            apellido1: data.ape1,
            apellido2: data.ape2,
            direccion: data.direccion
        };
    },

    async handleClick() {
        const { data: aData, error } = await agendar( await this.getBody() );

        if (error) {
            if (aData.cod == 2442) {
                this.errorMessage = `
                    <p class="fs-4 text-danger fw-bold">Error en Agendamiento</p>
                    <p class="text-muted border-top border-bottom py-3">Parece que la fecha y hora que seleccionaste ya han sido agendadas por otra persona. Por favor intenta con fechas diferentes.</p>
                    <button @click="() => { errorMessage = ''; $dispatch('re-fetch-agenda'); window.scrollTo({ top: 0, behavior: 'smooth' }); }" class="btn btn-sm btn-dark">Continuar</button>
                `;
            }
            return;
        }

        const x = document.getElementById("resumen-list")?.outerHTML;
        this.errorMessage = `
            <p class="fs-4 text-success fw-bold">Cita Agendada</p>
            ${x ? '<div class="small">'+x+'</div>' : '<hr />'}
            <p class="text-muted">Tu Cita ha sido (pre)agendada. Te notificarémos cuando el proceso esté completo con la fecha y hora definitivas.♥</p>
            <a href="${this.misCitasLink}" class="btn btn-sm btn-dark">Continuar</a>
        `;
    },

    get canConfirmar() {
        let x = [
            Alpine.store("agenda").selectedDay,
            Alpine.store("agenda").selectedMed,
            Alpine.store("agenda").selectedEsp,
            Alpine.store("agenda").selectedClase,
            Alpine.store("agenda").selectedHour
        ].some(x => x === null);

        if (x) return false;
        if (Alpine.store("agenda").selectedTipo === "PARTIC") return true;

        return Alpine.store("agenda").files.formula instanceof File
            && Alpine.store("agenda").files.auto  instanceof File;
    }
});
