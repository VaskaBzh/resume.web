import { FormData } from "@/modules/auth/DTO/FormData";

import { ValidateService } from "@/modules/validate/services/ValidateService";
import api from "@/api/api";
import { useRouter } from "vue-router";

export class RegistrationService {
    constructor() {
        this.form = {};
        this.validate = {};
        this.checkbox = false;
        this.errors = {};
        this.errorsExpired = {};

        this.router = useRouter();

        this.validateService = new ValidateService();
    }

    setForm() {
        const referral_code = this.getReferralCode(window.location.search);

        this.form = {
            ...new FormData("", "", "", "", referral_code),
        };
    }

    getReferralCode(page) {
        const ulrParams = new URLSearchParams(page);

        return ulrParams.get("referral_code");
    }

    async account_create() {
        if (this.checkbox) {
            if (Object.entries(this.validate).length === 0) {
                try {
                    await api.post("/register", this.form);

                    this.router.push({ name: "statistic" });
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
