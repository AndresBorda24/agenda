import "@/css/planes.css";
import Alpine from "alpinejs";
import tabs from "./components/tabs";
import planes from "./components/planes";
import regalo from "./components/regalo";
import pendiente from "./components/pendiente";
import gouWebCheckout from "./components/gou-web-checkout";

import "./components/tooltips";

document.addEventListener('alpine:init', () => {
    Alpine.store('SelectedPlanStore', {
        plan: "",
        tarjeta: false
    });

    Alpine.data("Tabs", tabs);
    Alpine.data("Planes", planes);
    Alpine.data("Regalo", regalo);
    Alpine.data("PagoPendiente", pendiente);
    Alpine.data("GouWebCheckout", gouWebCheckout);
});

window.Alpine = Alpine;

document.addEventListener("DOMContentLoaded", Alpine.start);
