import { FormData } from "@/modules/auth/DTO/FormData";

import { ValidateService } from "@/modules/validate/services/ValidateService";
import api from "@/api/api";
import { useRoute } from "vue-router";

export class RegistrationService {
    constructor() {
        this.form = {};
        this.validate = {};
        this.checkbox = false;
        this.errors = {};
        this.errorsExpired = {};

        this.validateService = new ValidateService();
    }

    setForm() {
        const referral_code = this.getReferralCode(window.location.search);

        this.form = {
            ...new FormData("", "", "", "", referral_code, false),
        };
    }

    getReferralCode(page) {
        const ulrParams = new URLSearchParams(page);

        return ulrParams.get("referral_code");
    }

    async account_create() {
        this.checkbox = false;

        if (this.form.checkbox) {
            if (Object.entries(this.validate).length === 0) {
                try {
                    await api.post("/register", this.form);

                    useRoute().push({ name: "statistic" });
                } catch (err) {
                    console.error("Error with: " + err);

                    this.setErrors(err.response.data.errors);
                }
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

        this.errorsExpired = { ...errors };
        setTimeout(() => {
            this.errorsExpired = {};
        }, 1500);
    }
}
