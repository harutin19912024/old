import Alpine from 'alpinejs';
import Tooltip from "@ryangjchandler/alpine-tooltip";

window.Alpine = Alpine;

Alpine.plugin(Tooltip);
Alpine.start();

window.addEventListener('reload', () => {
    window.location.reload();
});
