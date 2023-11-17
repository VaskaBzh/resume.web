import { ValidationRulesEnum } from "@/modules/validate/enums/ValidationRulesEnum";

export const ValidationFunctionsEnum = {
    required: (inputValue) => inputValue.length === 0,
    equal: (inputValue, equalValue) => inputValue.length === equalValue,
    max: (inputValue, maxValue = 15) => inputValue.length > maxValue,
    min: (inputValue, minValue = 3) =>
        inputValue.length < minValue && inputValue.length !== 0,

    isValid: (inputValue, ruleKey) =>
        !ValidationRulesEnum[ruleKey].test(inputValue) &&
        inputValue.length !== 0,
};
