import { gsap } from "gsap";

export class PreloaderService {
    constructor() {
        this.progressPercentage = 0;
        this.interval = null;
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
            }
        },  intervalMillisecondsTime);
    }

    animateLine() {
        const lineTimeline = gsap.timeline(
            {
                repeat: -1,
                repeatDelay: .1,
                duration: 1
            }
        );
        // gsap.to(
        //     "#id",
        //     {
        //         cssRule:
        //     }
        // );
    }

    animateCloseLine() {

    }

    animateCross() {

    }
}
