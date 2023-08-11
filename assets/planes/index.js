import "@/css/planes.css";
import Alpine from "alpinejs";
import planes from "./components/planes"

document.addEventListener('alpine:init', () => {
    Alpine.data("Planes", planes);
});

window.Alpine = Alpine;

document.addEventListener("DOMContentLoaded", Alpine.start);
