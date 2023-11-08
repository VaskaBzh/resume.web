import { Validator } from "@/modules/validate/models/Validator";

export class Form {
    constructor() {
        this.validator = new Validator();
        this.formData = {};

        this.form = {};
    }

    setFormData(newFormData) {
        this.formData = newFormData;

        return this;
    }

    initForm() {
        this.form = this.formData();
    }

    setForm(newForm) {
        this.form = newForm;
    }

    validate(validationConfig) {
        for (const formKey in validationConfig) {
            this.validator.validate(this.form[formKey], formKey, validationConfig[formKey])
        }
    }
}
