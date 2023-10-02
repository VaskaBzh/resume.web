import { LoginFormData } from "@/modules/auth/DTO/LoginFormData";
import { MainApi } from "@/api/api";
import { ValidateService } from "@/modules/validate/services/ValidateService";
import store from "@/store";
import { openNotification } from "@/modules/notifications/services/NotificationServices";

export class LoginService {
    constructor(router) {
        this.form = {};
        this.checkbox = false;

        this.translate = null;

        this.router = router;

        this.openedPasswordPopup = false;
        this.closedPasswordPopup = false;

        this.validate = {};
        this.validateService = new ValidateService();
    }

    setTranslate(translate) {
        this.translate = translate;
    }

    setForm() {
        this.form = {
            ...new LoginFormData("", "", false),
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
            const response = await this.fetchPassword(form);

            this.closePasswordPopup();
            this.removeRouteQuery();

            openNotification(true, this.translate("validate_messages.connected"), response.data.message);
        } catch (err) {
            console.error(err);

            openNotification(
                false,
                this.translate("validate_messages.error"),
                err.response.data.error ?? err.response.data.message
            );
            store.dispatch("setFullErrors", err.response.data);
        }
    }

    async fetchPassword(form) {
        return (
            await MainApi.put("/password/change", form)
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

    async login() {
        try {
            const response = await MainApi.post("/login", this.form);

            const user = response.data.user;
            const token = response.data.token;
            store.dispatch("setToken", token);
            store.dispatch("setUser", user);

            // if (this.route?.query?.verify_hash) {
            //     await ProfileApi.post("/verify", {
            //         user: user,
            //     });
            // }

            this.router.push({
                name: "statistic",
            });
        } catch (err) {
            store.dispatch("setFullErrors", {
                ...err.response.data,
            });
            // store.dispatch("setFullErrors", {
            //     email: err.response.data.message,
            // });
        }
    }
}
