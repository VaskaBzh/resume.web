import { TimeService } from "@/modules/common/services/extends/base/TimeService";
import { ValuesService } from "@/modules/common/services/extends/base/ValuesService";
import { StatesService } from "@/modules/common/services/extends/base/StatesService";

export class TimerService {
    constructor() {
        this.interval = null;

        this.timerState = this.createStatesService();

        this.timeService = this.createTimeService();

        this.overTimeTimestamp = this.createValuesService();
        this.overTime = this.createValuesService();
        this.endTimeTimestamp = this.createValuesService();

        this.secondInMilliseconds = 1000;
    }

    createStatesService() {
        return new StatesService();
    }

    createValuesService() {
        return new ValuesService();
    }

    createTimeService() {
        return new TimeService();
    }

    getOverTime(time) {
        if (!time) {
            return this;
        }

        this.overTimeTimestamp.setValue(this.timeService.getDayTimestamp(time));

        return this;
    }

    setTimer() {
        this.timeService.getActualTimeStamp();

        this.endTimeTimestamp.setValue(
            this.timeService.timestamp + this.overTimeTimestamp.value
        );

        this.overTime.setValue(
            this.timeService.getDate(this.overTimeTimestamp.value)
        );

        this.dropInterval();
        this.interval = setInterval(() => {
            this.timeService.getActualTimeStamp();

            if (this.endTimeTimestamp.value >= this.timeService.timestamp) {
                this.overTimeTimestamp.setValue(
                    this.overTimeTimestamp.value - this.secondInMilliseconds
                );

                this.overTime.setValue(
                    this.timeService.getDate(this.overTimeTimestamp.value)
                );
            } else {
                this.endTimer();
            }
        }, this.secondInMilliseconds);

        return this;
    }

    setConfirmState(state) {
        this.timerState.setState(state);

        return this;
    }

    endTimer() {
        this.dropInterval();

        this.overTime.setValue("0.0.0");

        this.setConfirmState(true);
    }

    dropInterval() {
        clearInterval(this.interval);

        return this;
    }
}
