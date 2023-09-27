import Alpine from 'alpinejs';
import BeneficiarioForm from './components/form';

import "../css/app.css";

window.Alpine = Alpine

document.addEventListener('alpine:init', () => {
    Alpine.data("BeneficiarioForm", BeneficiarioForm);
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
});
