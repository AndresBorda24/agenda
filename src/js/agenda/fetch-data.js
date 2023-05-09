import axios from 'axios';

export default () => ({
    esps: [],
    baseUri: process.env.APP_URL + "api",
    espUri: '/especialidades/get-available',
    config: {
        headers: {
            'Content-Type': "application/json"
        },
    },
    /** Obtiene las especialidades disponibles */
    async init() {
        try {
            const { data } =  await axios
                .get(`${this.baseUri}${this.espUri}`, this.config);
            this.esps = data;
        } catch(e) {
            alert("Error al recuperar las especialidades");
            console.error("Error especialidades: ", e);
        }
    },
    /** Obtiene los dias en los que hay agenda */
    async getData( esp ) {
        try {
            Alpine.store('loader').show();
            const [{data: agenda}, {data: docs}] = await Promise.all([
                axios.get(`${this.baseUri}/especialidades/${esp}/get-agenda`, this.config),
                axios.get(`${this.baseUri}/medicos/${esp}/get-available`, this.config),
            ]);
            Alpine.store('loader').hide();

            Alpine.store("doctores", docs);
            Alpine.store("agenda", agenda);
            Alpine.store("selectedEsp", esp);

            this.$dispatch("date-has-changed");
        } catch(e) {
            Alpine.store('loader').hide()
            console.error("Fetch data: ", e);
        }
    }
});
