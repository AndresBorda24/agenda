import "@/css/root.css";
import "@/css/activar.css";
import Alpine from "alpinejs";
import tabs from "./componentes/tabs";
import activarQr from "./componentes/activar-qr";
import activarSerial from "./componentes/activar-serial";

if (import.meta.env.VITE_APP_ENV === "dev") window.Alpine = Alpine;

document.addEventListener("alpine:init", () => {
    Alpine.data("ActivarTabs", tabs);
    Alpine.data("ActivarQr", activarQr);
    Alpine.data("ActivarSerial", activarSerial);
});

Alpine.start();
