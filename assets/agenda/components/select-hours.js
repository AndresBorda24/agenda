import Alpine from "alpinejs";

export default () => ({
    formatter: new Intl.DateTimeFormat('es-CO', {
        weekday: "long",
        year: "numeric",
        month: "long",
        day: "numeric"
    }),

    handleClick(hour) {
        if (Alpine.store("agenda").selectedHour === hour)
            return Alpine.store("agenda").selectedHour = null;

        Alpine.store("agenda").selectedHour = hour;
    },

    get selectedDay() {
        if (Alpine.store("agenda").selectedDay) {
            return this.formatter.format(
                new Date(Alpine.store("agenda").selectedDay.split("-"))
            );
        }

        return "";
    },

    get horas() {
        if (Alpine.store("agenda").selectedDay) {
            return Alpine.store("agenda").data[
                Alpine.store("agenda").selectedDay
            ];
        }
        return [];
    }
});
