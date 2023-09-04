import anime from "animejs/lib/anime.es.js";

export class PreloaderService {
    constructor() {
        this.progressPercentage = 0;
        this.interval = null;

        this.animate = null;

        this.lineColor = '#4282EC';
        this.iconContainer = null;

        this.preloaderLine = null;
        this.preloaderCircle = null;
        this.polygon = null;
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
            this.animateCloseLine();
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
        }, intervalMillisecondsTime);
    }

    setContainerElement(containerElem) {
        this.iconContainer = containerElem;
    }

    setLineElement(containerElem) {
        this.preloaderLine = containerElem;
    }

    setCircleElement(containerElem) {
        this.preloaderCircle = containerElem;
    }

    dropElement(element) {
        element.remove();
    }

    setPolygon(element) {
        this.polygon = element;
    }

    getPath(element) {
        return element.getAttribute("d");
    }

    convertPath(element) {
        const length = element.getTotalLength();
        const svgPoint = element.getPointAtLength(0);
        let str = svgPoint.x + " " + svgPoint.y;

        for (let i = 1; i < length; i++) {
            const svgPoint = element.getPointAtLength(i);
            str += " " + svgPoint.x + " " + svgPoint.y;
        }

        return str;
    }

    animateLine() {
        const lastPath = this.convertPath(this.preloaderLine);

        this.polygon.setAttribute('points', lastPath);

        // this.animate = anime({
        //     targets: '#polygon',
        //     points: [
        //         { value: [
        //                 '0 0 0 0 0 0 0 0 0 0 0 0',
        //                 lastPath
        //             ]
        //         },
        //     ],
        //     easing: 'easeOutQuad',
        //     duration: 2000,
        // });
        //
        // this.animate.remove("#polygon");

        this.animate = anime(
            {
                targets: '#polygon',
                rotate: 720,
                duration: 3500,
                loop: true,
                easing: 'easeOutExpo'
            }
        );
    }

    animateCloseLine = () => {
        const firstPath = this.convertPath(this.preloaderLine);
        const lastPath = this.convertPath(this.preloaderCircle);

        anime({
            targets: '#polygon',
            points: [
                { value: [
                        firstPath,
                        lastPath
                    ]
                },
            ],
            easing: 'easeOutQuad',
            duration: 2000,
        });
    }

    animateCross() {

    }
}
