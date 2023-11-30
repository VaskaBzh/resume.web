import { ValidationFunctionsEnum } from "@/modules/validate/enums/ValidationFunctionsEnum";
import { ValidationErrorKeysEnum } from "@/modules/validate/enums/ValidationErrorKeysEnum";

const RULE_NAME_INDEX = 0;
const RULE_DATA_INDEX = 1;

export class Validator {
    constructor() {
        this.errorName = null;
        this.errorEvent = null;
        this.errorList = [];
    }

    setErrorName(newErrorName) {
        this.errorName = newErrorName;

        return this;
    }

    increaseErrorList(errorKey, translateArgs = {}) {
        this.errorList.push({
            path: ValidationErrorKeysEnum[errorKey],
            args: translateArgs,
        });
    }

    dropErrorList() {
        this.errorList.length = 0;
    }

    setErrorEvent() {
        this.errorEvent = new CustomEvent("validationError", {
            detail: { [this.errorName]: this.errorList },
        });

        document.dispatchEvent(this.errorEvent);

        if (Object.entries(this.errorList).length > 0) {
            throw new Error("Has validation error");
        }
    }

    getValidationFunction(validationRuleName) {
        return ValidationFunctionsEnum[validationRuleName];
    }

    // THIS.VALUE, "VALUE", "required|string|number|upper|lower|string_number"email|max:15|min:3"

    validate(inputValue, errorName, validationRules) {
        this.setErrorName(errorName).dropErrorList();

        const validationRulesList = validationRules.split("|");

        validationRulesList.forEach((validationRule, i) => {
            const splitValidationRule = validationRule.split(":");

            const validationRuleName = splitValidationRule[RULE_NAME_INDEX];
            const validationRuleData = splitValidationRule[RULE_DATA_INDEX];

            if (
                this.getValidationFunction(validationRuleName)
                    ? this.getValidationFunction(validationRuleName)(
                          inputValue,
                          validationRuleData
                      )
                    : this.getValidationFunction(
                          this.getValidationFunction(validationRuleName)
                              ? validationRuleName
                              : "isValid"
                      )(inputValue, validationRuleName)
            ) {
                this.increaseErrorList(validationRuleName, {
                    [validationRuleName]: validationRuleData,
                });
            }

            if (i === validationRulesList.length - 1) {
                this.setErrorEvent();
            }
        });
    }
}
