import Alpine from "alpinejs";

export default (date) => ({
    date: date,

    init() {
        Alpine.store("agenda").days?.includes(this.date)
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
