import Alpine from "alpinejs";
import { getAuthInfo, agendar } from "@/agenda/requests"

export default () => ({
    fechaAgenda: "",
    selectedTipo: "",
    selectedClase: "",
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

    async handleClick() {
        const { data } = await getAuthInfo();

        let body = {
            hora: Alpine.store("agenda").selectedHour,
            tipo: Alpine.store("agenda").selectedTipo,
            email: data.email,
            fecha: Alpine.store("agenda").selectedDay,
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
        const { data: aData, error } = await agendar( body );
        if (!error) alert("Cita agendada");
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
