import Alpine from "alpinejs";
import form from "../partials/form";
import selectAjax from "../partials/select-ajax";


import "../css/root.css";

window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {
    Alpine.data("Form", form);
    Alpine.data("SelectAjax", selectAjax);
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
});
