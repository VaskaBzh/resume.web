import { ValuesService } from "./ValuesService";

export class TimeService {
    constructor() {
        this.dateTime = null;
        this.timestamp = null;

        this.hours = this.createValuesService();
        this.minutes = this.createValuesService();
        this.seconds = this.createValuesService();

        this.hoursTimestamp = this.createValuesService();
        this.minutesTimestamp = this.createValuesService();
        this.secondsTimestamp = this.createValuesService();

        this.minutesCount = 60;
        this.secondsCount = 60;
        this.millisecondsCount = 1000;
    }

    createValuesService() {
        return new ValuesService();
    }

    getDate(timestamp) {
        const date = timestamp;

        const hours = Math.floor(
            date /
                this.minutesCount /
                this.secondsCount /
                this.millisecondsCount
        );

        const minutes = Math.floor(
            date / this.secondsCount / this.millisecondsCount
        );

        const seconds = Math.floor(date / this.millisecondsCount);

        return `${hours}.${minutes - hours * this.minutesCount}.${
            seconds - minutes * this.secondsCount
        }`;
    }

    getActualTime() {
        this.dateTime = new Date();

        return this;
    }

    getActualTimeStamp() {
        this.timestamp = Date.now();

        return this;
    }

    getDayTimestamp(dayTime) {
        const hoursIndex = 0;
        const minutesIndex = 1;
        const secondsIndex = 2;

        let splitTime = dayTime.split(".");

        this.setHours(splitTime[hoursIndex]);
        this.setMinutes(splitTime[minutesIndex]);
        this.setSeconds(splitTime[secondsIndex]);

        this.getHoursTimestamp();
        this.getMinutesTimestamp();
        this.getSecondsTimestamp();

        return (
            this.hoursTimestamp.value +
            this.minutesTimestamp.value +
            this.secondsTimestamp.value
        );
    }

    setHours(hours) {
        this.hours.setValue(hours);

        return this;
    }

    setMinutes(minutes) {
        this.minutes.setValue(minutes);

        return this;
    }

    setSeconds(seconds) {
        this.seconds.setValue(seconds);

        return this;
    }

    getHoursTimestamp() {
        this.hoursTimestamp.setValue(
            this.hours.value *
                this.minutesCount *
                this.secondsCount *
                this.millisecondsCount
        );

        return this;
    }

    getMinutesTimestamp() {
        this.minutesTimestamp.setValue(
            this.minutes.value * this.secondsCount * this.millisecondsCount
        );

        return this;
    }

    getSecondsTimestamp() {
        this.secondsTimestamp.setValue(
            this.seconds.value * this.millisecondsCount
        );

        return this;
    }
}
