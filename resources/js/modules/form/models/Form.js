import { Validator } from "@/modules/validate/models/Validator";

export class Form {
    constructor() {
        this.validator = this.createValidatorModel();
        this.formData = {};

        this.form = {};
    }

    createValidatorModel() {
        return new Validator();
    }

    setFormData(newFormData) {
        this.formData = newFormData;

        return this;
    }

    setClearForm() {
        this.form = new this.formData();
    }

    setForm(newForm) {
        this.form = { ...this.form, ...newForm };
    }

    validate(validationConfig) {
        for (const formKey in validationConfig) {
            this.validator.validate(
                this.form[formKey],
                formKey,
                validationConfig[formKey]
            );
        }
    }
}
