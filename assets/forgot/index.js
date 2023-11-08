import "@/css/root.css";
import "@/css/activar.css";
import Alpine from "alpinejs";
import form from "./components/form";

if (process.env.APP_ENV === "dev") window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {
    Alpine.data("PasswdReset", form);
});

Alpine.start();
