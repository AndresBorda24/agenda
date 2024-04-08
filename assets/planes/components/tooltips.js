import 'tippy.js/dist/tippy.css';
import tippy from 'tippy.js';

tippy.setDefaultProps({allowHTML: true, trigger: 'mouseenter click'})

document.addEventListener("DOMContentLoaded", () => {
    tippy(".exclusiones-tooltip", {
        content: document.getElementById("exclusiones-tmp")?.innerHTML
    })
})
