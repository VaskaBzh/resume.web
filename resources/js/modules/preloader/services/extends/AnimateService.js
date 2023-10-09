import anime from "animejs";

import { StatesService } from "@/modules/common/services/extends/base/StatesService";
import { AnimateDataService } from "@/modules/preloader/services/extends/base/AnimateDataService";
import { StylesService } from "@/modules/preloader/services/extends/StylesService";

export class AnimateService extends StylesService {
    constructor() {
        super();

        this.lineAnimate = this.createAnimateDataService();
        this.lineResizeAnimate = this.createAnimateDataService();
        this.crossAnimate = this.createAnimateDataService();
        this.lineCloseAnimate = this.createAnimateDataService();

        this.isCrossVisible = this.createStatesService();
        this.isProgressVisible = this.createStatesService();
        this.isLogoCenter = this.createStatesService();

        this.isProgressVisible.setState();
    }

    createStatesService() {
        return new StatesService();
    }

    createAnimateDataService() {
        return new AnimateDataService();
    }

    setCrossDataGetter() {
        this.cross.getData = function () {
            return this.element.querySelectorAll("rect");
        }
    }

    endAnimation() {
        this.lineResizeAnimate.dropAnimate();
        this.lineAnimate.dropAnimate();
        this.closeLine();
    }

    animateLineResize() {
        this.lineResizeAnimate.restartAnimation();

        this.lineResizeAnimate.dropAnimate(this.polygon.element);

        const startDashOffSet = -890;
        const endDashOffSet = -1247;
        const duration = 1600;

        const easing = "easeInOutSine";
        const direction = "alternate";

        const animateConfig = {
            targets: this.polygon.element,
            strokeDashoffset: [startDashOffSet, endDashOffSet],
            duration: duration,
            loop: true,
            easing: easing,
            direction: direction,
        };

        this.lineResizeAnimate.setAnimateData(anime(animateConfig));
    }

    animateLine() {
        this.lineAnimate.restartAnimation();

        this.setPolygonTransform("rotate(0deg)");

        this.lineAnimate.dropAnimate(this.polygon.element);

        const rotate = 720;
        const duration = 2500;
        const easing = "linear";

        const animateConfig = {
            targets: this.polygon.element,
            rotate: rotate,
            duration: duration,
            loop: true,
            easing: easing,
        };

        this.lineAnimate.setAnimateData(anime(animateConfig));

        return this;
    }

    animateCloseLine() {
        this.lineCloseAnimate.dropAnimate(this.polygon.element);

        this.getDashOffSet();

        const hundredPercent = 100;
        const onePercentDashOffSet = 12.47;
        const onePercentDuration = 32;

        const endDashOffSet = -1247;
        const duration =
            (hundredPercent -
                Math.abs(this.dashOffSet / onePercentDashOffSet)) *
            onePercentDuration;

        const easing = "easeInOutSine";

        const beginFunctions = () => {
            this.animateCross();
        };
        const eventListener = {
            begin: beginFunctions,
        };

        const animateConfig = {
            targets: this.polygon.element,
            strokeDashoffset: [this.dashOffSet, endDashOffSet],
            easing: easing,
            duration: duration,
            ...eventListener,
        };

        this.lineCloseAnimate.setAnimateData(anime(animateConfig));
    }

    animateCross() {
        if (this.cross) {
            this.isCrossVisible.setState();

            this.setCrossDataGetter();

            const rects = this.cross.getData();

            const easing = "linear";
            const duration = 300;
            const heightValue = 33.361;
            const staggerDelay = 400;

            const animateConfig = {
                targets: rects,
                easing: easing,
                duration: duration,
                height: heightValue,
                delay: anime.stagger(staggerDelay),
                complete: () => {
                    this.isProgressVisible.setState();
                }
            };

            this.crossAnimate.setAnimateData(anime(animateConfig));
        }
    }

    closeLine() {
        this.lineCloseAnimate.dropAnimate(this.polygon.element);

        this.getRotate();

        const hundredPercent = 100;
        const onePercentFullRotate = 7.2;
        const onePercentHalfRotate = 3.6;
        const tenPercentDuration = 125;
        const fullRotate = 720;
        const halfRotate = 360;

        const rotate = this.rotate <= halfRotate ? halfRotate : fullRotate;
        const delay =
            (hundredPercent - this.rotate / this.rotate <= halfRotate
                ? onePercentHalfRotate
                : onePercentFullRotate) * tenPercentDuration;

        const easing = "linear";

        const completeFunctions = () => {
            this.animateCloseLine();
        };
        const eventListener = {
            complete: completeFunctions,
        };

        const animationConfig = {
            targets: this.polygon.element,
            rotate: rotate,
            duration: delay,
            easing: easing,
            ...eventListener,
        };

        this.lineCloseAnimate.setAnimateData(anime(animationConfig));
    }
}
