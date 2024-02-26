import * as d3 from "d3";

export class GraphDataTrait {
    static maxValue = 120000000000000;
    static percentPadding = 0.2;

    static setMaxValue(newMaxValue = 120000000000000) {
        this.maxValue = newMaxValue;
        
        return this;
    }

    static setPercentPadding(newPercentPadding = 0.2) {
        this.percentPadding = newPercentPadding;
        
        return this;
    }

    static domainValueValidation(values) {
        const emptyValue = 0;

        return d3.max(values) !== emptyValue
            ? d3.max(values) + d3.max(values) * this.percentPadding
            : this.maxValue;
    }
}
