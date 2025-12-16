import "./bootstrap";
import Alpine from "alpinejs";
import { createIcons, icons } from "lucide";

window.Alpine = Alpine;

Alpine.start();

window.lucide = {
    createIcons,
    icons,
};

// 3. Jalankan createIcons untuk icon statis (sidebar/header)
createIcons({ icons });
