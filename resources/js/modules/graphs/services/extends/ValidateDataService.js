import * as d3 from "d3";

export class ValidateDataService {
    maxValue = 120;
    percentPadding = 0.2;

    static setMaxValue(newMaxValue = 120) {
        this.maxValue = newMaxValue;
    }

    static setPercentPadding(newPercentPadding = 0.2) {
        this.percentPadding = newPercentPadding;
    }

    static valueValidationRules(values) {
        const emptyValue = 0;

        return d3.max(values) !== emptyValue
            ? d3.max(values) +
            d3.max(values) * this.percentPadding
            : this.maxValue;
    }
}
