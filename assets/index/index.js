import "@/css/root.css"
import "@/css/index.css"
import "@/index/comp/tooltips"

import Alpine from "alpinejs"
import videos from "@/index/comp/videos"

window.Alpine = Alpine

document.addEventListener("alpine:init", () => {
    Alpine.data("Videos", videos)
})

Alpine.start()
