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
    }

    prevStep() {
        this.step--;
    }

    setVisible() {
        this.isVisible = true;

        return this;
    }

    dropVisible() {
        this.isVisible = false;

        return this;
    }
}
