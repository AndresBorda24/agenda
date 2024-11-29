import axios from "axios";
import iziToast from "izitoast";

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
    baseUri: import.meta.env.VITE_APP_API,
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
    },
    confirmHour(regAgendaId, hora, med) {
        const message = `Realmente desea agendar su cita para el ${this.getFormatDate(this.key)} a las ${hora} con el medico ${Alpine.store("doctores")[med].nombre}?`;

        iziToast.show({
            layout: 2,
            drag: false,
            zindex: 2500,
            class: "light-pattern-bg",
            timeout: false,
            overlay: true,
            maxWidth: "90vw",
            title: 'Confirmar',
            titleSize: "1.5rem",
            progressBar: false,
            titleLineHeight: "35px",
            message: message,
            messageLineHeight: "35px",
            position: 'center',
            progressBarColor: 'rgb(0, 255, 184)',
            buttons: [
                ['<button class="me-4">Si</button>', async (instance, toast) => {
                    await this.saveAgenda(regAgendaId);

                    this.$dispatch("cita-agendada");
                    this.close();

                    instance.success({
                        title: "Exito",
                        message: "Cita Agendada"
                    });
                    instance.hide({}, toast);
                }, true],
                ['<button>Cancelar</button>', (instance, toast) => {
                    instance.hide({}, toast);
                }]
            ]
        });
    },
    /**
     * Realiza la solicitud para insertar los datos en la base de datos.
    */
    async saveAgenda(__id) {
        try {
            Alpine.store("loader").show();
            await axios.post(`${this.baseUri}/agenda/save`, {
                __id: __id,
                user: 1
            }, {
                headers: {
                    'Content-Type': "application/json"
                }
            }).finally( () => Alpine.store('loader').hide());
        } catch(e) {
            iziToast.error({
                title: "Ha ocurrido un error",
                message: "No hemos podido agendar tu cita... Intenta luego."
            });

            console.error("Guardar Agenda: ", e);
        }
    }
});
