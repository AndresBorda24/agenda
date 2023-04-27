export default (day) => ({
    ctrl: new Date(),
    hasDate: false,
    events: {
        ["@date-has-changed.document"]: "setDate($event)"
    },
    init() {
        this.ctrl.setDate(day);
    },
    verify() {
        return (Object.prototype
            .hasOwnProperty
            .call(Alpine.store("sampleData"), this.getDate())
        );
    },
    setDate({ detail: data }) {
        this.ctrl.setFullYear( data.getFullYear() );
        this.ctrl.setMonth( data.getMonth() );
        this.ctrl.setDate( day );

        this.hasDate = this.verify();
    },
    getDate() {
        return this.ctrl.toISOString().split('T')[0]
    }
});
