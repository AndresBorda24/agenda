import "@/css/planes.css";
import Alpine  from "alpinejs";

document.addEventListener('alpine:init', () => {
    Alpine.data("planes", () => ({

    }));
});

window.Alpine = Alpine;

document.addEventListener("DOMContentLoaded", Alpine.start);
