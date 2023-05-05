export default () => ({
    /** Nombre del mes que se muestra */
    month: "",
    year: "",
    months: [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
    ],
    /** Los eventos que escucha este componente */
    events: {
        ["@date-has-changed.document"]: "evHandler"
    },
    /** @param {Date} data */
    evHandler() {
        this.month = this.months[ Alpine.store('ctrlDate').getMonth() ];
        this.year = Alpine.store('ctrlDate').getFullYear();
    }
});
