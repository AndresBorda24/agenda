import { getEspecialidades, getAgenda } from "@/agenda/requests";

export default () => ({
    esps: {},
    /**
     * Estos son los eventos que 'escucha' este componente
     * con su respectivo callback - handler
    */
    events: {
        ["@cita-agendada.document"]:"getData( $store.selectedEsp )"
    },

    /** Obtiene las especialidades disponibles */
    async init() {
        const {data, error} = await getEspecialidades();
        if (error === null) this.esps = data.data;
    },

    /** Obtiene los dias en los que hay agenda */
    async getData(esp, medico) {
        Alpine.store('loader').show();
        const {data, error} = await getAgenda( medico );
        Alpine.store('loader').hide();
        if (error !== null) return;

        Alpine.store("agenda").data = data.data;
        Alpine.store("agenda").selectedEsp = esp;
        Alpine.store("agenda").selectedMed = medico;
        Alpine.store("agenda").selectedDay = null;
        Alpine.store("agenda").selectedHour = null;
    },

    get espsLoaded() {
        return Object.keys(this.esps).length > 0;
    }
});
