'use strict';
import anime from "animejs/lib/anime.es.js";
import { ref } from "vue";

export class PreloaderService {
    constructor() {
        this.progressPercentage = 0;
        this.interval = null;

        this.endTable = false;
        this.resizeEnd = false;
        this.crossVisible = ref(false);

        this.animate = null;

        this.lineColor = '#4282EC';

        this.polygon = null;
        this.cross = null;
    }

    killInterval() {
        clearInterval(this.interval);
    }

    startProcess(intervalMillisecondsTime) {
        const limit = 80;
        const percentStep = 1;

        this.interval = setInterval(() => {
            if (this.progressPercentage < limit) {
                this.progressPercentage += percentStep;
            } else {
                this.killInterval();
            }
        }, intervalMillisecondsTime);

        this.animateLine();
        this.animateLineResize()
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
            this.endAnimation();
            this.killInterval();
        }
    }

    killProcess() {
        const percentEnd = 100;
        const percentStep = 1;
        const tailNumber = percentEnd - this.progressPercentage;
        const timeOutMilliseconds = 200;
        const intervalMillisecondsTime = timeOutMilliseconds / (tailNumber);

        this.interval = setInterval(() => {
            if (this.progressPercentage < percentEnd) {
                this.progressPercentage += percentStep;
            } else {
                this.killInterval();
                this.animateCross();
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
        this.animateResize = anime(
            {
                targets: this.polygon,
                strokeDashoffset: [-890, -1247],
                duration: 1600,
                loop: true,
                easing: 'easeInOutSine',
                direction: 'alternate',
                update: (anim) => {
                    if (this.endTable && Math.round(anim.progress) === 0) {
                        this.animateResize.remove(this.polygon);

                        this.resizeEnd = true;
                    }
                }
            }
        );
    }

    animateLine() {
        this.animate = anime(
            {
                targets: this.polygon,
                rotate: 720,
                duration: 2500,
                loop: true,
                easing: 'linear',
                changeComplete: (anim) => {
                    if (this.endTable && this.resizeEnd) {
                        this.animateCloseLine();

                        this.animate.remove(this.polygon);
                    }
                }
            }
        );
    }

    animateCloseLine = () => {
        anime({
            targets: this.polygon,
            strokeDashoffset: [-890, -1247],
            easing: 'easeInOutSine',
            duration: 1000,
            begin: (anim) => {
                this.killProcess();
            }
        });
    }

    endAnimation() {
        this.endTable = true;
    }

    animateCross = () => {
        this.makeCrossVisible();

        // anime({
        //     targets: this.cross.left,
        //     strokeDashoffset: [-128, 0],
        //     easing: 'easeInOutSine',
        //     duration: 800,
        // });
        anime({
            targets: this.cross.querySelectorAll('rect'),
            easing: 'linear',
            duration: 300,
            height: 33.361,
            delay: anime.stagger(400)
        });
    }
}
