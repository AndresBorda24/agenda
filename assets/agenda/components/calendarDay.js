export default (day) => ({
    medicos: [],
    ctrl: new Date(),
    hasDate: false,
    date: "",
    events: {
        ["@date-has-changed.document"]: "setDate"
    },
    init() {
        this.ctrl.setDate(day);
    },
    /**
     * Revisa si la fecha `ctrl` coincide con la agenda de algun
     * medico
    */
    verify() {
        return (
            Object
            .prototype
            .hasOwnProperty
            .call(Alpine.store("agenda"), this.date)
        ) && (
            this.ctrl >= new Date()
        );
    },
    /**
     * Cuando Cambiamos de mes, se debe 'refrescar' la fecha de
     * cada dia. Eso es lo que se hace aqui
    */
    setDate() {
        this.ctrl.setFullYear(
            Alpine.store("ctrlDate").getFullYear()
        );
        this.ctrl.setMonth(
            Alpine.store("ctrlDate").getMonth()
        );
        this.ctrl.setDate( day );

        this.$nextTick(() => {
            this.date = this.getDate();
            this.hasDate = this.verify();
            this.medicos = this.hasDate
                ? Alpine.store("agenda")[ this.getDate() ]
                : [];
        });
    },
    /**
     * Obtiene una fecha con el formato aaaa-mm-dd a partir
     * de `ctrl`
    */
    getDate() {
        return this.ctrl.toISOString().split('T')[0]
    },
    /**
     * Al dar click sobre el dia se deben mostrar las
     * horas que estan disponibles. Esta funcion despacha un
     * evento que notifica cual dia se debe cargar
    */
    showHours() {
        this.$dispatch("load-day-hours", this.date);
    },
    /**
     * Obtiene estilos especificos para cada doctor
    */
    getStyles(med) {
        const _ = Alpine.store('doctores')[ med ];
        if (_) return `bg-${_.color} border-${_.color}`;

        return "";
    }
});
