import { useForm } from "@inertiajs/vue3";
import { FormData } from "@/modules/auth/DTO/FormData";

import { ValidateSevice } from "@/modules/common/services/ValidateSevice";

export class RegistrationService {
    constructor() {
        this.form = {};
        this.validate = {};
        this.checkbox = false;
        this.errors = {};

        this.validateService = new ValidateSevice();
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
        this.validate = this.validateService.validateProcess(
            event,
            this.form,
            this.validate
        );
    }

    setErrors(errors) {
        this.errors = { ...errors };
        setTimeout(() => {
            this.errors = {};
        }, 1500);
    }
}
