import {useForm, usePage} from "@inertiajs/vue3";
import { FormData } from "@/modules/auth/DTO/FormData";

import { ValidateService } from "@/modules/validate/services/ValidateService";

export class RegistrationService {
    constructor() {
        this.form = {};
        this.validate = {};
        this.checkbox = false;
        this.errors = {};

        this.validateService = new ValidateService();
    }

    setForm() {
        const { props } = usePage();

        this.form = useForm({
            ...new FormData("", "", "", "", "", false),
            _token: props.token,

        });
    }

    async account_create() {
        this.checkbox = false;

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
