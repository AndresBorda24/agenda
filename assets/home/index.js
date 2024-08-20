import Alpine from "alpinejs";
import "@/css/root.css";
import carousel from "@/home/comp/carousel";
import "@/index/comp/tooltips";

window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {
    Alpine.data("ImgCarousel", carousel);
});

document.addEventListener("DOMContentLoaded", Alpine.start);
