export default (day) => ({
    ctrl: new Date(),
    hasDate: false,
    events: {
        ["@date-has-changed.document"]: "setDate($event)"
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
            .call(Alpine.store("sampleData"), this.getDate())
        ) && (
            this.ctrl >= new Date()
        );
    },
    /**
     * Cuando Cambiamos de mes, se debe 'refrescar' la fecha de
     * cada dia. Eso es lo que se hace aqui
    */
    setDate({ detail: data }) {
        this.ctrl.setFullYear( data.getFullYear() );
        this.ctrl.setMonth( data.getMonth() );
        this.ctrl.setDate( day );

        this.hasDate = this.verify();
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
        this.$dispatch("load-day-hours", this.getDate());
    }
});
