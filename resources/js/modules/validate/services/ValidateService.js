import { ValidateEnum } from "@/modules/validate/enums/ValidateEnum";

export class ValidateService {
    validateProcess(password, form, validate) {
        form.password = password;
        validate = {};

        if (form.password?.length < 10 || form.password?.length > 50)
            validate = { ...validate, length: true };

        if (!ValidateEnum.strokeLetters.test(form.password))
            validate = { ...validate, lower: true };

        if (!ValidateEnum.highLetters.test(form.password))
            validate = { ...validate, upper: true };

        if (!ValidateEnum.numbers.test(form.password))
            validate = { ...validate, number: true };

        if (!ValidateEnum.symbols.test(form.password))
            validate = { ...validate, symbol: true };

        if (form.password.length === 0) validate = {};

        return validate;
    }
}
