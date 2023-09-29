import Alpine from 'alpinejs';
import BeneficiarioForm from './components/form';
import BeneficiariosList from './components/list';

import "../css/app.css";

window.Alpine = Alpine

document.addEventListener('alpine:init', () => {
    Alpine.data("BeneficiarioForm", BeneficiarioForm);
    Alpine.data("BeneficiariosList", BeneficiariosList);
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
});
