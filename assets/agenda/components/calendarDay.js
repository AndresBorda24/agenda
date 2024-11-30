import Alpine from "alpinejs";

export default (day) => ({
    date: '',
    _date: null,

    init() {
        const date = new Date(
            Alpine.store('ctrlDate').getFullYear(),
            Alpine.store('ctrlDate').getMonth(),
            day
        )
        this._date = date;
        this.date  = this._date.toJSON().substring(0,10);
    },

    handleSelect() {
        if (! this.hasDate) return;
        Alpine.store("agenda").selectedHour = null;

        if(Alpine.store("agenda").selectedDay === this.date)
            return Alpine.store("agenda").selectedDay = null;

        Alpine.store("agenda").selectedDay = this.date;
    },

    get hasDate() {
        return Alpine.store("agenda").days?.includes(this.date);
    }
});
