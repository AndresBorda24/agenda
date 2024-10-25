import Alpine from 'alpinejs';
import ItemsList from './components/items-list.js';
import "../css/app.css";

// @ts-ignore
window.Alpine = import.meta.env.DEV ? Alpine : undefined;

document.addEventListener('alpine:init', () => {
    Alpine.data('ItemsList', ItemsList);
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
});
