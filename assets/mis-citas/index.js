import Alpine from 'alpinejs'
import Cita from './components/cita';
import Citas from './components/citas';
import modalCancelar from './components/modal-cancelar';

import "../css/app.css";

if (import.meta.env.VITE_APP_ENV === "dev") window.Alpine = Alpine;

document.addEventListener('alpine:init', () => {
    Alpine.data("Citas", Citas);
    Alpine.data("Cita", Cita);
    Alpine.data("ModalCancelar", modalCancelar);

    Alpine.store("loader", {
        _: document.getElementById('loader'),
        show() {
            this._.classList.remove('hidden');
        },
        hide() {
            this._.classList.add('hidden');
        }
    });
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
});
