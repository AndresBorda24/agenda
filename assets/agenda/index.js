import Alpine from 'alpinejs'
import calendar from './components/calendar';
import dateName from './components/dateName';
import fetchData from './components/fetch-data';
import calendarDay from './components/calendarDay';
import selectHours from './components/select-hours';
import showDayHours from './components/show-day-hours';
import loadAgendadas from './components/load-agendadas';

import "./stores/agenda-stores"
import "../css/app.css";

window.Alpine = Alpine

document.addEventListener('alpine:init', () => {
    Alpine.data("dateName", dateName);
    Alpine.data("calendar", calendar);
    Alpine.data("fetchData", fetchData);
    Alpine.data("calendarDay", calendarDay);
    Alpine.data("selectHours", selectHours);
    Alpine.data("showDayHours", showDayHours);
    Alpine.data("loadAgendadas", loadAgendadas);
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

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
});
