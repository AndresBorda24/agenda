import Alpine from "alpinejs";
import { agendar } from "@/agenda/requests"

export default () => ({
    fechaAgenda: "",
    selectedEps: "",
    selectedTipo: "",
    selectedClase: "",
    errorMessage: null,
    misCitasLink: import.meta.env.VITE_APP_URL + "/mis-citas",
    init() {
        this.$watch("$store.agenda.selectedDay", () =>{
            this.fechaAgenda = document
                .querySelector("[x-text='selectedDay']")?.innerText || " -- ";
        });

        this.$watch("$store.agenda.selectedTipo", (val) =>{
            this.selectedTipo = document
                .querySelector(`[value="${val}"]`)?.textContent || " -- ";
        });

        this.$watch("$store.agenda.selectedClase", (val) =>{
            this.selectedClase = document
                .querySelector(`[value="${val}"]`)?.textContent || " -- ";
        });

        this.$watch("$store.agenda.selectedEps", (val) =>{
            this.selectedEps = document
                .querySelector(`[value="${val}"]`)?.textContent || " -- ";
        });
    },

    /** Arma el cuerpo de la solicitud */
    getBody() {
        const fields = {
            hora: Alpine.store("agenda").selectedHour,
            tipo: Alpine.store("agenda").selectedTipo,
            email: Alpine.store("agenda").userData.email,
            fecha: Alpine.store("agenda").selectedDay,
            lugar: Alpine.store("agenda").lugar,
            ciudad: Alpine.store("agenda").userData.ciudad,
            medico: Alpine.store("agenda").selectedMed,
            nombre1: Alpine.store("agenda").userData.nom1,
            nombre2: Alpine.store("agenda").userData.nom2,
            cod_enti: (Alpine.store("agenda").selectedTipo == 'PARTIC')
                ? "PARTIC"
                : Alpine.store("agenda").selectedEps || Alpine.store("agenda").userData.eps,
            telefono: Alpine.store("agenda").userData.telefono,
            claseCon: Alpine.store("agenda").selectedClase,
            num_histo: Alpine.store("agenda").userData.num_histo,
            apellido1: Alpine.store("agenda").userData.ape1,
            apellido2: Alpine.store("agenda").userData.ape2,
            direccion: Alpine.store("agenda").userData.direccion,
            observacion: Boolean(Alpine.store("agenda").observacion)
                ? Alpine.store("agenda").observacion
                : '',
            // Archivos
            formula: Alpine.store('agenda').files.formula,
            autorizacion: Alpine.store('agenda').files.auto
        };

        console.log(fields);
        const body = new FormData;

        Object.keys(fields).forEach(k => body.append(k, fields[k]));

        return body;
    },

    async handleClick() {
        const body = this.getBody();
        Alpine.store('loader').show();
        const { data: aData, error } = await agendar( body );
        Alpine.store('loader').hide();


        if (error) {
            if (aData.cod == 2442) {
                this.errorMessage = `
                    <p class="fs-4 text-danger fw-bold">Error en Solicitud</p>
                    <p class="text-muted border-top border-bottom py-3 text-sm mb-3">Parece que la fecha y hora que seleccionaste ya han sido tomadas por otra persona. Por favor intenta con fechas diferentes.</p>
                    <button @click="() => { errorMessage = ''; $dispatch('re-fetch-agenda'); window.scrollTo({ top: 0, behavior: 'smooth' }); }" class="btn btn-sm btn-dark">Continuar</button>
                `;
            }
            return;
        }

        const x = document.getElementById("resumen-list")?.outerHTML;
        this.errorMessage = `
            <p class="fs-4 text-success fw-bold">Solicitud Realizada</p>
            ${x ? '<div class="text-sm">'+x+'</div>' : '<hr />'}
            <p class="text-sm mb-4">Tu Cita ha sido solicitada. Te notificarémos cuando el proceso esté completo con la fecha y hora definitivas.♥</p>
            <a href="${this.misCitasLink}" class="btn btn-sm btn-dark">Continuar</a>
        `;
    },

    get canConfirmar() {
        let x = [
            Alpine.store("agenda").userData,
            Alpine.store("agenda").selectedDay,
            Alpine.store("agenda").selectedMed,
            Alpine.store("agenda").selectedEsp,
            Alpine.store("agenda").selectedClase,
            Alpine.store("agenda").selectedHour
        ].some(x => x === null);

        if (x) return false;
        if (Alpine.store("agenda").selectedTipo === "PARTIC") return true;
        if (Alpine.store("agenda").selectedEps === null) return false;
        if (Alpine.store("agenda").selectedTipo === "MED_PREP") return true;

        return Alpine.store("agenda").files.formula instanceof File
            && Alpine.store("agenda").files.auto  instanceof File;
    }
});
