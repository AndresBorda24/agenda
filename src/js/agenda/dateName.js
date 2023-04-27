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
        ["@date-has-changed.document"]: "evHandler($event)"
    },
    /** @param {Date} data */
    evHandler({ detail: data }) {
        this.month = this.months[ data.getMonth() ];
        this.year = data.getFullYear();
    }
});
