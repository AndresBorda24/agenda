import Alpine from 'alpinejs'
import iziToast from 'izitoast';

import "../css/registro.css";

window.Alpine = Alpine

document.addEventListener('alpine:init', () => {
    Alpine.data("app", () => ({
        state: {},

        send() {
            this.state = {};
            iziToast.success({
                title: 'OK',
                message: 'Usuario Registrado.',
                position: "topRight"
            });

            this.$nextTick(() => {
                document.querySelector('[x-model="state.cedula"]').focus();
            });
        }
    }));
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
});
