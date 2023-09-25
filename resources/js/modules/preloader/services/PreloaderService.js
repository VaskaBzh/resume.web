import anime from "animejs/lib/anime.es.js";
import { ref } from "vue";

export class PreloaderService {
    constructor() {
        this.progressPercentage = 0;
        this.interval = null;

        this.endTable = false;
        this.resizeEnd = false;
        this.crossVisible = ref(false);
        this.animationIsEnd = ref(false);

        this.animate = null;

        this.lineColor = "#4282EC";

        this.polygon = null;
        this.cross = null;
    }

    endAnimation() {
        this.endTable = true;
    }

    dropEndAnimation() {
        this.endTable = false;
    }

    killPreloader() {
        this.endProcess();
    }

    killInterval() {
        clearInterval(this.interval);
    }

    dropResizeState() {
        this.resizeEnd = false;
    }

    dropStyles() {
        if (this.polygon && this.cross) {
            this.polygon.removeAttribute("style");
            this.cross.removeAttribute("style");
        }
    }

    startProcess(intervalMillisecondsTime) {
        this.progressPercentage = 0;

        this.dropEndAnimation();
        this.dropResizeState();

        const limit = 80;
        const percentStep = 1;

        this.killInterval();
        this.interval = setInterval(() => {
            if (this.progressPercentage < limit) {
                this.progressPercentage += percentStep;
            } else {
                this.slowProcess();
                this.killInterval();
            }
        }, intervalMillisecondsTime);

        this.dropStyles();

        this.animateLine();
        this.animateLineResize();
    }

    slowProcess() {
        const percentEnd = 98;
        const percentStep = 1;
        const limit = 80;
        const intervalMillisecondsTime = 500;

        if (this.progressPercentage >= limit) {
            this.intervalId = setInterval(() => {
                if (this.progressPercentage < percentEnd) {
                    this.progressPercentage += percentStep;
                }
            }, intervalMillisecondsTime);
        }
    }

    endProcess(endValue) {
        if (endValue) {
            this.killInterval();
            this.killProcess();
            this.endAnimation();
        }
    }

    killProcess() {
        const percentEnd = 100;
        const percentStep = 1;
        const tailNumber = percentEnd - this.progressPercentage;
        const timeOutMilliseconds = 200;
        const intervalMillisecondsTime = timeOutMilliseconds / tailNumber;

        this.interval = setInterval(() => {
            if (this.progressPercentage < percentEnd) {
                this.progressPercentage += percentStep;
            } else {
                this.killInterval();
            }
        }, intervalMillisecondsTime);
    }

    setPolygon(element) {
        this.polygon = element;
    }

    setCross(element) {
        this.cross = element;
    }

    makeCrossVisible() {
        this.crossVisible.value = true;
    }

    animateLineResize() {
        this.animateResize = anime({
            targets: this.polygon,
            strokeDashoffset: [-890, -1247],
            duration: 1600,
            loop: true,
            easing: "easeInOutSine",
            direction: "alternate",
            update: (anim) => {
                if (this.endTable && Math.round(anim.progress) === 0) {
                    this.animateResize.remove(this.polygon);

                    this.resizeEnd = true;
                }
            },
        });
    }

    animateLine = () => {
        this.animate = anime({
            targets: this.polygon,
            rotate: 720,
            duration: 2500,
            loop: true,
            easing: "linear",
            changeComplete: (anim) => {
                if (this.endTable && this.resizeEnd) {
                    this.animate.remove(this.polygon);

                    this.dropResizeState();
                    this.dropEndAnimation();

                    this.animateCloseLine();
                }
            },
        });
    };

    animateCloseLine = () => {
        anime({
            targets: this.polygon,
            strokeDashoffset: [-890, -1247],
            easing: "easeInOutSine",
            duration: 1000,
            begin: (anim) => {
                this.animateCross();
            },
        });
    };

    animateCross = () => {
        if (this.cross) {
            this.makeCrossVisible();

            const rect = this.cross.querySelectorAll("rect");

            anime({
                targets: rect,
                easing: "linear",
                duration: 300,
                height: 33.361,
                delay: anime.stagger(400),
            });
            setTimeout(() => {
                this.animationIsEnd.value = true;
            }, 2500);
        }
    };
}
