export class AnimateDataService {
    constructor() {
        this.animateData = null;
    }

    setAnimateData(animateData) {
        this.animateData = animateData;
    }

    restartAnimation() {
        if (this.animateData?.remove) {
            this.animateData.restart();

            return;
        }
    }

    dropAnimate(domElement) {
        if (this.animateData?.remove) {
            this.animateData.pause(domElement);
            this.animateData.remove(domElement);
        }
    }
}
