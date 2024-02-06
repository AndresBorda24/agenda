import axios from 'axios';

export default () => ({
    esps: {},
    baseUri: process.env.APP_URL + "api",
    espUri: '/especialidades/get-available',
    /**
     * Estos son los eventos que 'escucha' este componente
     * con su respectivo callback - handler
    */
    events: {
        ["@cita-agendada.document"]:"getData( $store.selectedEsp )"
    },
    config: {
        headers: {
            'Content-Type': "application/json"
        },
    },
    /** Obtiene las especialidades disponibles */
    async init() {
        try {
            const { data } =  await axios
                .get(`http://192.168.1.16/fox-api/agenda/especialidades`, this.config);
            this.esps = data.data;
        } catch(e) {
            alert("Error al recuperar las especialidades");
            console.error("Error especialidades: ", e);
        }
    },
    /** Obtiene los dias en los que hay agenda */
    async getData( esp ) {
        try {
            Alpine.store('loader').show();
            const { data } = await axios.get(
                `http://192.168.1.16/fox-api/agenda/${esp}/libre`,
                this.config
            );
            Alpine.store('loader').hide();
            Alpine.store("selectedEsp", esp);
            Alpine.store("agenda").data = data.data;
        } catch(e) {
            Alpine.store('loader').hide();
            console.error("Fetch data: ", e);
        }
    }
});
