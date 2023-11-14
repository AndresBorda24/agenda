import Alpine from "alpinejs";
import form from "./components/form";

import "../css/root.css";
import iziToast from "izitoast";

window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {
    Alpine.data("form", form);
    Alpine.data("app", () => ({
        citas: [],

        async init() {
            const data = await (await fetch(
                "http://agenda.test/api/agenda/mis-citas"
                )).json();

            this.citas = data;
        },

        vencida( i ) {
          const x = new Date(`${this.citas[i].fecha}T${this.citas[i].hora}`);
          const min = new Date();
          min.setDate( min.getDate() + 1 );


          return x < min;
        },

        cancelar( i ) {
            const cancelar = () => this.citas.splice(i, 1);

            iziToast.question({
                timeout: false,
                close: false,
                overlay: true,
                id: 'question',
                zindex: 999,
                title: 'Confirmar cancelar',
                theme: "dark",
                backgroundColor: "var(--bs-primary)",
                message: 'Realmente desea cancelar su cita?',
                position: 'center',
                buttons: [
                    ['<button><b>Si</b></button>', function (instance, toast) {
                        cancelar();
                        iziToast.success({
                            title: "Hecho",
                            message: "Cita Cancelada!",
                            position: "topRight"
                        })
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }, true],
                    ['<button>No</button>', function (instance, toast) {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }],
                ]
            })
        }
    }));
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
});
