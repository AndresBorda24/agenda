import Alpine from "alpinejs";

export default () => ({
    init() {
        this.$watch("$store.agenda.selectedTipo", () => {
            Alpine.store("agenda").selectedEps = null;
        });
    }
});
