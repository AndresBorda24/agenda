import 'tippy.js/dist/tippy.css';
import 'tippy.js/themes/light.css';
import tippy from 'tippy.js';

tippy.setDefaultProps({allowHTML: true, trigger: 'mouseenter click'})

document.addEventListener("DOMContentLoaded", () => {
    tippy(".exclusiones-tooltip", {
        content: document.getElementById("exclusiones-tmp")?.innerHTML
    });

    document.querySelectorAll(".beneficios-tooltip").forEach(el => {
        const _id = el.getAttribute("data-plan");
        if (! _id) return;

        tippy(el, {
            content: document.querySelector(`#lista-beneficios-${_id}`)?.innerHTML,
            theme: "light"
        });
    });
})
