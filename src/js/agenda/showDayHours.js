export default () => ({
    key: "",
    show: false,
    hours: {},
    events: {
        ["@load-day-hours.document"]: "handler($event)"
    },
    /**
     * Se encarga de buscar las horas en el objeto de las
     * fechas
    */
    handler({ detail: key }) {
        this.key = key;
        this.setHours();
        this.show = true;
    },
    /** Establece las horas */
    setHours() {
        if (
            Object
            .prototype
            .hasOwnProperty
            .call(
                Alpine.store("sampleData"), this.key
            )
        ){
            this.hours = Alpine.store("sampleData")[ this.key ];
        } else {
            this.hours = {};
        }
    },
    /** Cierra el Div y establece los valores por defecto */
    close() {
        this.key = "";
        this.show = false;
        this.hours = {};
    }
});
