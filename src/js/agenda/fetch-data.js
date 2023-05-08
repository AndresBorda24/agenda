import axios from 'axios';

export default () => ({
    baseUri: process.env.APP_URL + "api",
    docsUri: '/medicos',
    horasUri: '/2WlXxjaW6NGl/data',
    config: {
        headers: {
            'Content-Type': "application/json"
        },
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
