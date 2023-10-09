import { LoginFormData } from "@/modules/auth/DTO/LoginFormData";
import { MainApi } from "@/api/api";
import { ValidateService } from "@/modules/validate/services/ValidateService";
import store from "@/store";

export class LoginService {
    constructor(router, route) {
        this.form = {};
        this.checkbox = false;

        this.translate = null;

        this.router = router;
        this.route = route;

        this.openedPasswordPopup = false;
        this.closedPasswordPopup = false;
        this.openedTwoFacPopup = false;
        this.closedTwoFacPopup = false;

        this.validate = {};
        this.validateService = new ValidateService();
    }

    setTranslate(translate) {
        this.translate = translate;
    }

    setForm() {
        this.form = {
            ...new LoginFormData("", "", true),
        };
    }

    removeRouteQuery() {
        this.router.push({
            name: "login",
        })
    }

    validateProcess(event) {
        this.validate = this.validateService.validateProcess(
            event,
            this.form,
            this.validate
        );
    }

    async sendPassword(form) {
        try {
            const formData = {
                ...form,
                email: this.route.query.email,
                hash: this.route.query.hash,
            };

            const response = await this.fetchPassword(formData);

            this.closePasswordPopup();
            this.removeRouteQuery();

            store.dispatch("setNotification", {
                status: "success",
                title: "changed",
                text: response.message,
            });
        } catch (err) {
            console.error(err);

            store.dispatch("setNotification", {
                status: "error",
                title: "error",
                text: err.response.data.error ?? err.response.data.message,
            });
        }
    }

    async fetchPassword(form) {
        return (
            await MainApi.put(`/password/restore/${this.route.query.user_id}`, form)
        ).data;
    }

    openPasswordPopup() {
        this.openedPasswordPopup = true;

        setTimeout(() => (this.openedPasswordPopup = false), 300);
    }

    closePasswordPopup() {
        this.closedPasswordPopup = true;

        setTimeout(() => (this.closedPasswordPopup = false), 300);
    }

    openTwoFacPopup() {
        this.openedTwoFacPopup = true;

        setTimeout(() => (this.openedTwoFacPopup = false), 300);
    }

    closeTwoFacPopup() {
        this.closedTwoFacPopup = true;

        setTimeout(() => (this.closedTwoFacPopup = false), 300);
    }

    async login() {
        try {
            const response = await MainApi.post("/login", this.form);

            const user = response.data.user;
            const token = response.data.token;
            store.dispatch("setToken", token);
            store.dispatch("setUser", user);

            this.router.push({
                name: "statistic",
                query: {
                    ...this.route.query?.action === "email" ?
                        {
                            onboarding: true
                        } :
                        {},
                }
            });

            this.closedTwoFacPopup();
        } catch (err) {
            console.error(err);
            if (err.response.status === 400) {
                this.openTwoFacPopup();
            } else {
                if (err.response.status === 403) {
                    this.router.push({
                        name: "confirm",
                        query: {
                            email: this.form.email,
                        },
                    });
                }

                store.dispatch("setFullErrors", {
                    ...err.response.data,
                });
            }
            // store.dispatch("setFullErrors", {
            //     email: err.response.data.message,
            // });
        }
    }
}
