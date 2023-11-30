import * as d3 from "d3";

export class ValidateDataService {
    constructor() {
        this.maxValue = null;
        this.percentPanding = null;
    }

    setMaxValue(newMaxValue = 120) {
        this.maxValue = newMaxValue;
    }

    setPercentPadding(newPercentPadding = 0.2) {
        this.percentPanding = newPercentPadding;
    }

    valueValidationRules(values) {
        const emptyValue = 0;

        return d3.max(values) !== emptyValue
            ? d3.max(values) +
            d3.max(values) * this.percentPanding
            : this.maxValue;
    }
}
