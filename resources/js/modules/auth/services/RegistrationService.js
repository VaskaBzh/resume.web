import { FormData } from "@/modules/auth/DTO/FormData";

import { ValidateService } from "@/modules/validate/services/ValidateService";
import api from "@/api/api";
import store from "@/store";

export class RegistrationService {
    constructor(router, route) {
        this.form = {};
        this.validate = {};
        this.checkbox = false;
        this.checkboxState = false;

        this.router = router;
        this.route = route;

        this.validateService = new ValidateService();
    }

    setForm() {
        const referral_code = this.route?.query?.referral_code;

        this.form = {
            ...new FormData("", "", "", "", referral_code),
        };
    }

    async account_create() {
        if (this.checkbox) {
            if (Object.entries(this.validate).length === 0) {
                try {
                    const response = await api.post("/register", this.form);

                    const user = response.data.user;
                    const token = response.data.token;
                    store.dispatch("setUser", user);
                    store.dispatch("setToken", token);

                    this.router.push({
                        name: "confirm",
                        query: {
                            email: user.email,
                        },
                    });
                } catch (err) {
                    console.error("Error with: " + err);

                    store.dispatch("setFullErrors", err.response.data.errors);
                }
            }
        } else {
            this.checkboxState = true;

            setTimeout(() => this.checkboxState = false, 1500)
        }
    }

    validateProcess(event) {
        this.validate = this.validateService.validateProcess(
            event,
            this.form,
            this.validate
        );
    }
}
