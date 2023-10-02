import Alpine from "alpinejs";
import img from "@/partials/img";
import form from "./components/form";
import selectAjax from "@/partials/select-eps";
import "@/css/registro-vip.css";

window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {
    Alpine.data("Img", img);
    Alpine.data("Form", form);
    Alpine.data("SelectAjax", selectAjax);
});

document.addEventListener("DOMContentLoaded", () => {
    Alpine.start();
});
