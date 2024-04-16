import Alpine from "alpinejs";
import password from "./components/password";
import basicForm from "./components/basic-form";
import selectAjax from "@/partials/select-eps";
import "../css/root.css";

import 'tippy.js/dist/tippy.css';
import 'tippy.js/themes/light.css';
import tippy from 'tippy.js';

if (process.env.APP_ENV === "dev") window.Alpine = Alpine;

tippy.setDefaultProps({allowHTML: true, trigger: 'mouseenter click'});

document.addEventListener("alpine:init", () => {
    Alpine.data("UpdatePass", password);
    Alpine.data("UpdateUser", basicForm);
    Alpine.data("SelectAjax", selectAjax);
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start()
    tippy(".exclusiones-tooltip", {
        content: document.getElementById("exclusiones-tmp")?.innerHTML
    });
});
