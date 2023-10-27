import { InputData } from "../../common/DTO/InputData";

export class CalculatorInputData extends InputData {
    constructor(
        name,
        label,
        value,
        placeholder,
        unit,
        hint,
        disabled,
        currency,
        watchValue
    ) {
        super(
            name,
            label,
            value,
            placeholder,
            unit,
            hint,
            disabled,
            currency
        );

        this.watchValue = watchValue;
    }
}
