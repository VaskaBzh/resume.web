export class InputData {
    constructor(
        name,
        label,
        value,
        placeholder,
        unit,
        hint,
        disabled,
        currency
    ) {
        this.inputName = name;
        this.inputLabel = label;
        this.inputValue = value;
        this.inputPlaceholder = placeholder;
        this.inputUnit = unit;
        this.inputHint = hint;
        this.disabled = disabled;
        this.currency = currency;
    }
}
