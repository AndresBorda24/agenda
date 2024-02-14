import Alpine from "alpinejs";

export default () => ({
    fechaAgenda: "",
    selectedTipo: "",
    init() {
        this.$watch("$store.agenda.selectedDay", () =>{
            this.fechaAgenda = document
                .querySelector("[x-text='selectedDay']")?.innerText || "";
        });

        this.$watch("$store.agenda.selectedTipo", (val) =>{
            this.selectedTipo = document
                .querySelector(`[value="${val}"]`)?.dataset.name || "";
        });
    },

    handleClick() {
        console.log(
            Alpine.store("agenda")
        );
    },

    get canConfirmar() {
        let x = [
            Alpine.store("agenda").selectedDay,
            Alpine.store("agenda").selectedMed,
            Alpine.store("agenda").selectedEsp,
            Alpine.store("agenda").selectedHour
        ].some(x => x === null);

        if (x) return false;
        if (Alpine.store("agenda").selectedTipo === "PARTIC") return true;

        return Alpine.store("agenda").files.formula instanceof File
            && Alpine.store("agenda").files.auto  instanceof File;
    }
});
