import Alpine from 'alpinejs'
import calendar from './agenda/calendar';
import dateName from './agenda/dateName';
import calendarDay from './agenda/calendarDay';
import showDayHours from './agenda/showDayHours';
import sampleData from './agenda/data.json' assert { type: 'json' }
import "../css/app.css";

window.Alpine = Alpine

document.addEventListener('alpine:init', () => {
    Alpine.store("sampleData", sampleData);

    Alpine.data("dateName", dateName);
    Alpine.data("calendar", calendar);
    Alpine.data("calendarDay", calendarDay);
    Alpine.data("showDayHours", showDayHours);
    Alpine.data("changeCalendarMonth", (back = false) => ({
        ch() {
            if(back) {
                this.$dispatch("previous-month");
                return;
            }
            this.$dispatch("next-month");
        }
    }));
});

Alpine.start()
