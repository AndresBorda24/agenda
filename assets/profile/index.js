import Alpine from "alpinejs";
import password from "./components/password";
import basicForm from "./components/basic-form";
import selectAjax from "@/partials/select-eps";
import "../css/root.css";

if (import.meta.env.VITE_APP_ENV === "dev") window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {
    Alpine.data("UpdatePass", password);
    Alpine.data("UpdateUser", basicForm);
    Alpine.data("SelectAjax", selectAjax);
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start()
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
