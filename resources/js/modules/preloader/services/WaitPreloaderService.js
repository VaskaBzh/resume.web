import { PreloaderService } from "@/modules/preloader/services/PreloaderService";
import anime from "animejs";

export class WaitPreloaderService extends PreloaderService {
    constructor() {
        super();
    }

    animateLineResize() {
        this.animateResize = anime({
            targets: this.polygon,
            strokeDashoffset: [-890, -1247],
            duration: 1600,
            loop: true,
            easing: "easeInOutSine",
            direction: "alternate",
        });
    }

    animateLine() {
        this.animate = anime({
            targets: this.polygon,
            rotate: 720,
            duration: 2500,
            loop: true,
            easing: "linear",
        });
    }
}
