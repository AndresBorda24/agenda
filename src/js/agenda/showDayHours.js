import axios from "axios";

export default () => ({
    /**
     * Corresponde a la fecha seleccionada
     * Ej: '2023-05-08'
    */
    key: "",
    /**
     * Aqui se almacenan todas las horas relacionadas con
     * la especialidad seleccionada y la fecha
    */
    hours: {},
    show: false,
    /**
     * La "ruta" base para hacer las peticiones
    */
    baseUri: process.env.APP_URL + "api",
    events: {
        ["@load-day-hours.document"]: "handler($event)"
    },
    /**
     * Este metodo es el que "organiza" el componente
    */
    async handler($e) {
        this.key = $e.detail;
        await this.setHours();
        this.show = true;
    },
    /**
     * Realiza la peticion para traer todas las
     * horas en base a la especialidad y la fecha
    */
    async setHours() {
        try {
            Alpine.store('loader').show();

            const uri = `/especialidades/${Alpine.store("selectedEsp")}/get-available-hours/${this.key}`;
            const { data } = await axios.get(`${this.baseUri}${uri}`, {
                headers: {
                    'Content-Type': "application/json",
                },
            }).finally(() => Alpine.store('loader').hide());

            this.hours = data;
        } catch (e) {
            console.error("Error al traer las horas: ", e);
            this.hours = {};
        }
    },
    /**
     * Cierra el Div y establece los valores por defecto
    */
    close() {
        this.key = "";
        this.show = false;
        this.hours = {};
    },
    /**
     * Obtiene la fecha en Espanol y formateada
    */
    getFormatDate(d) {
        if (!d) return "";

        return new Date(d).toLocaleDateString("es-CO", {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
            timeZone: "UTC"
        });
    }
});
