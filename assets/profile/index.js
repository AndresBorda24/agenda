import Alpine from "alpinejs";
import basicForm from "./components/basic-form";
import selectAjax from "@/partials/select-eps";
import "../css/root.css";

window.Alpine = Alpine;
document.addEventListener("alpine:init", () => {
    Alpine.data("SelectAjax", selectAjax);
    Alpine.data("UpdateUser", basicForm);
});

document.addEventListener("DOMContentLoaded", Alpine.start);
