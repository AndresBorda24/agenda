import "@/css/root.css";
import "@/css/index.css";
import 'tippy.js/dist/tippy.css';

import tippy from 'tippy.js';

tippy.setDefaultProps({allowHTML: true, trigger: 'mouseenter click'})

document.addEventListener("DOMContentLoaded", () => {
    tippy("#beneficios-1", {
        content: document.getElementById("beneficios-1-dt")?.innerHTML
    })
    tippy("#beneficios-2", {
        content: document.getElementById("beneficios-2-dt")?.innerHTML
    })
    tippy("#beneficios-3", {
        content: document.getElementById("beneficios-3-dt")?.innerHTML
    })
    tippy("#beneficios-4", {
        content: document.getElementById("beneficios-4-dt")?.innerHTML
    })
    tippy("#beneficios-5", {
        content: document.getElementById("beneficios-5-dt")?.innerHTML
    })

})
