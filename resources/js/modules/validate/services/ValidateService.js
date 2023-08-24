import { ValidateEnums } from "@/modules/validate/enums/ValidateEnums";

export class ValidateService {
    validateProcess(event, form, validate) {
        form.password = event;
        validate = {};

        if (form.password?.length <= 10 || form.password?.length >= 50)
            validate = { ...validate, length: true };``

        if (!ValidateEnums.strokeLetters.test(form.password))
            validate = { ...validate, lower: true };

        if (!ValidateEnums.highLetters.test(form.password))
            validate = { ...validate, upper: true };

        if (!ValidateEnums.numbers.test(form.password))
            validate = { ...validate, number: true };

        if (!ValidateEnums.symbols.test(form.password))
            validate = { ...validate, symbol: true };

        if (form.password.length === 0) validate = {};

        return validate;
    }
}
