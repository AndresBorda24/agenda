import Alpine from "alpinejs";

export default () => ({
    files: {
        formula: null,
        auto: null
    },
    init() {
        this.$watch("files.formula", () =>
            Alpine.store("agenda").files.formula = this.files.formula
        );
        this.$watch("files.auto", () =>
            Alpine.store("agenda").files.auto = this.files.auto
        );
    },
    get required() {
        return Alpine.store("agenda").selectedTipo !== "PARTIC";
    }
});
