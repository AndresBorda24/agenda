import axios from "axios";

export default () => ({
    key: "",
    show: false,
    hours: {},
    events: {
        ["@load-day-hours.document"]: "handler($event)"
    },
    $elemtn: document.getElementById('show-day-hours'),
    formatter: new Intl.DateTimeFormat("es-Co", {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric",
        timeZone: "UTC"
    }),
    /**
     * Se encarga de buscar las horas en el objeto de las
     * fechas
    */
    async handler( $e ) {
        this.key = $e.detail;
        await this.setHours();
        this.show = true;
        this.$elemtn.animate([
            { transform: 'scale(.5)', opacity: '0%' },
            { bottom: '-200px' },
            { transform: 'scale(1)' },
            { bottom: '0' },
            { opacity: '100%'}
        ], { duration: 280 });
    },
    /** Establece las horas */
    async setHours() {
        try {
            Alpine.store('loader').show();
            const {data} = await axios.get(
                "https://api.json-generator.com/templates/2WlXxjaW6NGl/data",  {
                headers: {
                    'Content-Type': "application/json",
                    "Authorization": "Bearer 7hbyk5c29l96fyh27h82zf1lnol74gwxxgvl0val"
                },
            }).finally( () =>  Alpine.store('loader').hide() );

            this.hours = data;
        } catch (e) {
            console.error("Error al traer las horas: ", e);
            this.hours = {};
        }
    },
    /** Cierra el Div y establece los valores por defecto */
    close() {
        this.key = "";
        this.show = false;
        this.hours = {};
    },
    /** Obtiene la fecha en Espanol y formateada */
    getFormatDate( d ) {
        if (!d) {
            return ""
        }

        return this.formatter.format(
            new Date(d)
        );
    }
});
