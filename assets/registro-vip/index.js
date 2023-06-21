import Alpine from "alpinejs";
import form from "./components/form";
import "../css/registro-vip.css";

window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {
    Alpine.data("form", form);
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
});
