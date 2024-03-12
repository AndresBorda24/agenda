export default (cita) => ({
    data: cita,

    init() {
        this.el = this.$el;
    },

    confirm() {
        this.$dispatch("cancelar-cita", JSON.parse(JSON.stringify(this.data)));
    },

    get fecha() {
        return this.data.fecha.toJSON().substring(0, 10);
    },

    get canCancel() {
        return  this.data.fecha > this.$data.tomorrow
                && this.data.estado   != 'C'
                && this.data.tipo.cod == 1;
    },

    get isPast() {
        const hoy =  new Date();
        hoy.setHours(0, 0, 0, 0);

        return this.data.fecha < hoy;
    }
})
