import { ValidationRulesEnum } from "@/modules/validate/enums/ValidationRulesEnum";

export class ValidationModel {
    constructor() {
        this.inputValue = "";
    }

    setInputValue(newInputValue) {
        this.inputValue = newInputValue;
    }

    getInputLength() {
        return this.inputValue.length;
    }

    // Validation

    isEqual(equalValue) {
        return this.inputValue === equalValue
    }

    isInMaxLimit(maxValue) {
        return this.getInputLength() <= maxValue
    }

    isInMinLimit(minValue) {
        return this.getInputLength() >= minValue
    }

    isInLimit(minValue, maxValue) {
        return this.getInputLength() >= minValue &&
            this.getInputLength() <= maxValue
    }

    isInLimitAndNumbersAndLetters(minValue, maxValue) {
        return this.getInputLength() >= minValue &&
            this.getInputLength() <= maxValue &&
            ValidationRulesEnum.LETTERS_AND_NUMBERS.test(this.inputValue)
    }

    isEmpty() {
        const emptyValue = 0;

        return this.getInputLength() === emptyValue
    }

    isEmailValid() {
        return ValidationRulesEnum.EMAIL_VALIDATION.test(this.inputValue);
    }
}
