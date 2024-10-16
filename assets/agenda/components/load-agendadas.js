import axios from 'axios';

export default () => ({
    show: false,
    citas: [],
    baseUri: import.meta.env.VITE_APP_API,
    events: {
         ["@cita-agendada.document"]:"getCitas()"
    },
    async init() {
        await this.getCitas();
    },
    async getCitas() {
        try {
            const {data} = await axios.get(`${this.baseUri}/agenda/mis-citas`, {
                headers: {
                    'Content-Type': "application/json"
                }
            });

            this.citas = data;
        } catch(e) {
            console.error("Citas Agendadas: ", e);
        }
    }
});
