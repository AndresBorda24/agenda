import "@/css/root.css";
import "@/css/activar.css";
import Alpine from "alpinejs";

if (process.env.APP_ENV === "dev") window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {

});

Alpine.start();
