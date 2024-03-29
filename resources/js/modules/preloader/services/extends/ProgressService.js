export class ProgressService {
    constructor() {
        this.progressPercentage = 0;
        this.interval = null;
    }

    nullProgressPercentage() {
        this.progressPercentage = 0;

        return this;
    }

    setInterval(intervalMillisecondsTime) {
        const limit = 80;
        const percentStep = 1;

        this.interval = setInterval(() => {
            if (this.progressPercentage < limit) {
                this.progressPercentage += percentStep;
            } else {
                this.setSlowInterval();
            }
        }, intervalMillisecondsTime);

        return this;
    }

    setSlowInterval() {
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

        return this;
    }

    endProgress() {
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

    killInterval() {
        clearInterval(this.interval);

        return this;
    }

    setProgressEnd() {
        this.progressPercentage = "preloader.text";
    }
}
