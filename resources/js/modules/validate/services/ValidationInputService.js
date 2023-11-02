import { ValidationModel } from "@/modules/validate/model/ValidationModel";
import { ValidationErrorsService } from "@/modules/validate/services/ValidationErrorsService";
import { TranslateService } from "@/modules/common/services/extends/TranslateService";

export class ValidationInputService extends TranslateService {
    constructor() {
        super();

        this.validationModel = this.createValidationModel();
        this.validationErrorsService = this.createValidationErrorsService();
    }

    createValidationModel() {
        return new ValidationModel();
    }

    createValidationErrorsService() {
        return new ValidationErrorsService();
    }

    dropErrors() {
        this.validationErrorsService.dropErrors();

        return this;
    }

    setErrorName(errorName = "name") {
        this.validationErrorsService.setErrorName(errorName);

        return this;
    }

    setValidationInputValue(newInputValue) {
        this.validationModel.setInputValue(newInputValue);

        return this;
    }

    checkEqual(equalValue, name = this.translate("passwords")) {
        if (!this.validationModel.isEqual(equalValue)) {
            this.validationErrorsService.setError("match", { inputsName: name });
        }
    }

    checkEmail() {
        if (!this.validationModel.isEmailValid()) {
            this.validationErrorsService.setError("email");
        }
    }

    checkInLimit(minValue = 3, maxValue = 15) {
        if (!this.validationModel.isInLimit(minValue, maxValue)) {
            this.validationErrorsService.setError(
                "limit_length",
                {
                    min_length: minValue,
                    max_length: maxValue
                }
            );
        }
    }

    checkInMaxLimit(maxValue = 15) {
        if (!this.validationModel.isInMaxLimit(maxValue)) {
            this.validationErrorsService.setError(
                "max_length",
                {
                    max_length: maxValue,
                }
            );
        }
    }

    checkInMinLimit(minValue = 3) {
        if (!this.validationModel.isInMinLimit(minValue)) {
            this.validationErrorsService.setError(
                "min_length",
                {
                    min_length: minValue,
                }
            );
        }
    }

    checkInLimitAndNumbersAndLetters(minValue = 15, maxValue = 3) {
        if (!this.validationModel.isInLimitAndNumbersAndLetters(minValue, maxValue)) {
            this.validationErrorsService.setError(
                "limit_length_and_letters_and_numbers",
                {
                    min_length: minValue,
                    max_length: maxValue
                }
            );
        }
    }

    checkEmpty() {
        if (!this.validationModel.isEmpty()) {
            this.validationErrorsService.setError(
                "limit_length_and_letters_and_numbers",
            );
        }
    }
}
