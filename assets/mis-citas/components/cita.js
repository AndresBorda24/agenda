export default (cita) => ({
    data: cita,

    init() {
        const f = this.data.fecha.split('-');
        this.data.fecha = new Date(f[0], f[1] - 1, f[2]);
    },

    get fecha() {
        return this.data.fecha.toJSON().substring(0, 10);
    },

    get canCancel() {
        return this.data.fecha > this.$data.tomorrow;
    }
})
