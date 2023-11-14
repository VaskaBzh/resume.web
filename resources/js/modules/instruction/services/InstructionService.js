export class InstructionService {
    constructor() {
        this.step = 1;
        this.steps_count = null;

        this.isVisible = false;
    }

    setStep(stepValue = 1) {
        this.step = stepValue;

        return this;
    }

    setStepsCount(steps_count) {
        this.steps_count = steps_count;

        return this;
    }

    nextStep(step = 1) {
        this.step = this.step + step;

        if (this.step > this.steps_count.length) {
            this.dropVisible();
        }
    }

    prevStep() {
        this.step--;
    }

    setVisible() {
        this.isVisible = true;
        document.querySelector(".page-container").style.overflow = "visible";

        return this;
    }

    dropVisible() {
        this.isVisible = false;
        document.querySelector(".page-container").style.overflowY = "scroll";

        return this;
    }
}
