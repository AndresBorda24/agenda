import axios from 'axios';

export default () => ({
    baseUri: 'https://api.json-generator.com/templates',
    docsUri: '/7LtWoFYBiZ-k/data',
    horasUri: '/2WlXxjaW6NGl/data',
    agendaUri: '/pmb1ldCR00zJ/data',
    config: {
        headers: {
            'Content-Type': "application/json",
            "Authorization": "Bearer 7hbyk5c29l96fyh27h82zf1lnol74gwxxgvl0val"
        },
    },
    /** Obtiene los dias en los que hay agenda */
    async getData() {
        try {
            Alpine.store('loader').show();
            const [{data: agenda}, {data: docs}] = await Promise.all([
                axios.get(this.baseUri + this.agendaUri, this.config),
                axios.get(this.baseUri + this.docsUri, this.config),
            ]);
            Alpine.store('loader').hide();

            Alpine.store("doctores", docs);
            Alpine.store("agenda", agenda);

            this.$dispatch("date-has-changed");
        } catch(e) {
            Alpine.store('loader').hide()
            console.error("Fetch data: ", e);
        }
    }
});
