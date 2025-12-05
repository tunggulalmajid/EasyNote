import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();
import "preline/preline";

import { createIcons, icons } from "lucide";

document.addEventListener("DOMContentLoaded", () => {
    createIcons({ icons });
});
