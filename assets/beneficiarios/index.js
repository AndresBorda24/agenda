import Alpine from 'alpinejs'

import "../css/app.css";

window.Alpine = Alpine

document.addEventListener('alpine:init', () => {
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
});
