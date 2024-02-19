import Alpine from 'alpinejs'
import Cita from './components/cita';
import Citas from './components/citas';


import "../css/app.css";

if (process.env.APP_ENV === "dev") window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data("Citas", Citas);
    Alpine.data("Cita", Cita);

    Alpine.store("loader", {
        _: document.getElementById('loader'),
        show() {
            this._.classList.remove('d-none');
        },
        hide() {
            this._.classList.add('d-none');
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
});
