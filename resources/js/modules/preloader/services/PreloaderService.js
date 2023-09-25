import anime from "animejs/lib/anime.es.js";
import { ref } from "vue";

export class PreloaderService {
    constructor(translate) {
        this.progressPercentage = 0;
        this.interval = null;

        this.translate = translate;

        this.endTable = false;
        this.resizeEnd = false;
        this.endLineClose = false;
        this.crossVisible = ref(false);
        this.animationIsEnd = ref(false);

        this.animateLineConst = null;
        this.animateLineResizeConst = null;
        this.animateCrossConst = null;
        this.animateLineCloseConst = null;

        this.polygon = null;
        this.cross = null;
    }

    endAnimation() {
        this.endTable = true;
    }

    dropEndAnimation() {
        this.endTable = false;
        this.animationIsEnd = false;
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

    startProcess(intervalMillisecondsTime) {
        this.crossVisible = ref(false);
        this.progressPercentage = 0;

        const limit = 80;
        const percentStep = 1;

        this.killInterval();
        this.interval = setInterval(() => {
            if (this.progressPercentage < limit) {
                this.progressPercentage += percentStep;
            } else {
                this.slowProcess();
            }
        }, intervalMillisecondsTime);

        this.animateLine();
        this.animateLineResize();
    }

    slowProcess() {
        this.killInterval();

        const percentEnd = 98;
        const percentStep = 1;
        const limit = 80;
        const intervalMillisecondsTime = 500;

        if (this.progressPercentage >= limit) {
            this.interval = setInterval(() => {
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

    setProgressEnd() {
        this.progressPercentage = this.translate("preloader.text");
    }

    killProcess() {
        this.killInterval();

        const percentEnd = 100;
        const percentStep = 1;
        const tailNumber = percentEnd - this.progressPercentage;
        const timeOutMilliseconds = 200;
        const intervalMillisecondsTime = timeOutMilliseconds / tailNumber;

        this.interval = setInterval(() => {
            if (this.progressPercentage < percentEnd) {
                this.progressPercentage += percentStep;
            } else {
                this.setProgressEnd();
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
        if (this.animateLineResizeConst?.remove && !this.endLineClose) {
            this.animateLineResizeConst.restart();
        } else {
            if (this.animateLineResizeConst?.remove) {
                this.animateLineResizeConst.remove(this.polygon);
            }
            this.animateLineResizeConst = anime({
                targets: this.polygon,
                strokeDashoffset: [-890, -1247],
                duration: 1600,
                loop: true,
                easing: "easeInOutSine",
                direction: "alternate",
                update: (anim) => {
                    if (this.endTable && Math.round(anim.progress) === 0) {
                        this.animateLineResizeConst.pause(this.polygon);
                        this.animateLineResizeConst.remove(this.polygon);

                        this.resizeEnd = true;
                    }
                },
            });
        }
    }

    animateLine() {
        if (this.animateLineConst?.remove && !this.endLineClose) {
            this.animateLineConst.restart();
        } else {
            this.polygon.style.transform = "rotate(0deg)";
            if (this.animateLineConst?.remove) {
                this.animateLineConst.remove(this.polygon);
            }

            this.animateLineConst = anime({
                targets: this.polygon,
                rotate: 720,
                duration: 2500,
                loop: true,
                easing: "linear",
                changeComplete: (anim) => {
                    if (this.endTable && this.resizeEnd) {
                        this.animateLineConst.pause(this.polygon);
                        this.animateLineConst.remove(this.polygon);

                        this.dropResizeState();
                        this.dropEndAnimation();

                        this.animateCloseLine();
                    }
                },
            });
        }
    }

    animateCloseLine = () => {
        this.endLineClose = false;

        if (this.animateLineCloseConst?.remove) {
            this.animateLineCloseConst.restart();
        } else {
            this.animateLineCloseConst = anime({
                targets: this.polygon,
                strokeDashoffset: [-890, -1247],
                easing: "easeInOutSine",
                duration: 1000,
                begin: (anim) => {
                    this.animateCross();

                    this.endLineClose = true;
                },
            });
        }
    };

    animateCross = () => {
        if (this.cross) {
            this.makeCrossVisible();

            const rect = this.cross.querySelectorAll("rect");

            if (this.animateCrossConst?.remove) {
                this.animateCrossConst.restart();
            } else {
                this.animateCrossConst = anime({
                    targets: rect,
                    easing: "linear",
                    duration: 300,
                    height: 33.361,
                    delay: anime.stagger(400),
                });
            }

            setTimeout(() => {
                this.animationIsEnd.value = true;
            }, 2500);
        }
    };
}
