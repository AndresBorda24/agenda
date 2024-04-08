import "@/css/planes.css";
import Alpine from "alpinejs";
import mp from "./components/mp";
import tabs from "./components/tabs";
import planes from "./components/planes";
import regalo from "./components/regalo";
import pendiente from "./components/pendiente";

import "./components/tooltips";

document.addEventListener('alpine:init', () => {
    Alpine.data("mp", mp);
    Alpine.data("Tabs", tabs);
    Alpine.data("Planes", planes);
    Alpine.data("Regalo", regalo);
    Alpine.data("PagoPendiente", pendiente);
});

window.Alpine = Alpine;

document.addEventListener("DOMContentLoaded", Alpine.start);
