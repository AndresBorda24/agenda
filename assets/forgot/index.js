import "@/css/root.css";
import "@/css/planes.css";
import Alpine from "alpinejs";
import form from "./components/form";

if (import.meta.env.VITE_APP_ENV === "dev") window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {
    Alpine.data("PasswdReset", form);
});

Alpine.start();
