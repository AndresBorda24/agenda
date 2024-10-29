import Alpine from 'alpinejs';
import "../css/app.css";

// @ts-ignore
window.Alpine = import.meta.env.DEV ? Alpine : undefined;

document.addEventListener('alpine:init', () => {
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
});
