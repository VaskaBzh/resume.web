import { useForm } from "@inertiajs/vue3";
import { ValidateEnums } from "@/modules/auth/enums/ValidateEnums";
import { FormData } from "@/modules/auth/FormData";

export class RegistrationService {
    constructor() {
        this.form = {};
        this.validate = {};
        this.checkbox = false;
        this.errors = {};
    }

    setForm() {
        this.form = new FormData("", "", "", "", "", false);
    }

    async account_create() {
        this.checkbox = false;

        this.form = useForm(this.form);

        if (this.form.checkbox) {
            if (Object.entries(this.validate).length === 0) {
                this.form.post("/register", {});
            }
        } else {
            this.checkbox = true;
        }
    }

    validateProcess(event) {
        this.form.password = event;
        this.validate = {};

        if (
            this.form.password?.length <= 10 ||
            this.form.password?.length >= 50
        )
            this.validate = { ...this.validate, length: true };

        if (!ValidateEnums.strokeLetters.test(this.form.password))
            this.validate = { ...this.validate, lower: true };

        if (!ValidateEnums.highLetters.test(this.form.password))
            this.validate = { ...this.validate, upper: true };

        if (!ValidateEnums.numbers.test(this.form.password))
            this.validate = { ...this.validate, number: true };

        if (!ValidateEnums.symbols.test(this.form.password))
            this.validate = { ...this.validate, symbol: true };

        if (this.form.password.length === 0) this.validate = {};
    }

    setErrors(errors) {
        this.errors = { ...errors };
        setTimeout(() => {
            this.errors = {};
        }, 1500);
    }
}
