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
        return eval(
            `${this.inputValue} ${ValidationRulesEnum.EQUAL} ${equalValue}`
        );
    }

    isInMaxLimit(maxValue) {
        return eval(
            `${this.getInputLength()} ${ValidationRulesEnum.MIN_LENGTH} ${maxValue}`
        );
    }

    isInMinLimit(minValue) {
        return eval(
            `${this.getInputLength()} ${ValidationRulesEnum.MAX_LENGTH} ${minValue}`
        );
    }

    isInLimit(minValue, maxValue) {
        return eval(
            `${this.getInputLength()} ${ValidationRulesEnum.MAX_LENGTH} ${minValue} &&
            ${this.getInputLength()} ${ValidationRulesEnum.MIN_LENGTH} ${maxValue}`
        );
    }

    isInLimitAndNumbersAndLetters(minValue, maxValue) {
        return eval(
            `
                ${this.getInputLength()} ${ValidationRulesEnum.MAX_LENGTH} ${minValue} &&
                ${this.getInputLength()} ${ValidationRulesEnum.MIN_LENGTH} ${maxValue} &&
                ${ValidationRulesEnum.LETTERS_AND_NUMBERS.test(this.inputValue)}
            `
        );
    }

    isEmpty() {
        const emptyValue = 0;

        return eval(
            `
                ${this.getInputLength()} ${ValidationRulesEnum.EQUAL} ${emptyValue}
            `
        );
    }

    isEmailValid() {
        return ValidationRulesEnum.EMAIL_VALIDATION.test(this.inputValue);
    }
}
