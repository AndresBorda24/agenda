import Alpine from "alpinejs";
import "../css/root.css";

window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
});
