import { ProgressService } from "@/modules/preloader/services/extends/ProgressService";
import { StatesService } from "@/modules/common/services/extends/base/StatesService";
import { AnimateService } from "@/modules/preloader/services/extends/AnimateService";

export class PreloaderService extends ProgressService {
    constructor() {
        super();

        this.endTable = this.createStatesService();
        this.waitTable = this.createStatesService();
        this.emptyTable = this.createStatesService();

        this.animateService = this.createAnimateService();
    }

    createAnimateService() {
        return new AnimateService();
    }

    createStatesService() {
        return new StatesService();
    }

    setPolygon(polygon) {
        this.animateService.polygon.setElement(polygon);
    }

    setCross(cross) {
        this.animateService.cross.setElement(cross);
    }

    setEmptyState(newEmptyState) {
        this.emptyTable.setState(newEmptyState);

        return this;
    }

    setWaitState(newWaitState) {
        this.waitTable.setState(newWaitState);

        return this;
    }

    setEndState(newEndState) {
        this.endTable.setState(newEndState);

        return this;
    }

    setProgressVisible(newProgressVisibleState) {
        this.animateService.isProgressVisible.setState(
            newProgressVisibleState
        );

        return this;
    }

    setLogoCenter(newLogoCenterState) {
        this.animateService.isLogoCenter.setState(newLogoCenterState);

        return this;
    }

    setCrossVisible(newCrossVisibleState) {
        this.animateService.isCrossVisible.setState(
            newCrossVisibleState
        );

        return this;
    }

    startProcess(intervalMillisecondsTime) {
        this.nullProgressPercentage()
            .killInterval()
            .setInterval(intervalMillisecondsTime);

        this.animateService.animateLine().animateLineResize();
    }

    slowProcess() {
        this.killInterval().setSlowInterval();
    }

    endProcess(endValue) {
        if (endValue) {
            this.killInterval().endProgress();
            this.animateService.endAnimation();
        }
    }
}
