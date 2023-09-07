import { LoginFormData } from "@/modules/auth/DTO/LoginFormData";
import api from "../../../api/api";
import { useRoute } from "vue-router";

export class LoginService {
    constructor() {
        this.form = {};
        this.checkbox = false;
        this.errors = {};
        this.errorsExpired = {};

        this.router = useRoute();
    }

    setForm() {
        this.form = {
            ...new LoginFormData("", "", false),
        };
    }

    async login() {
        try {
            await api.post("/login", this.form);

            this.router.push({ name: "statistic" });
        } catch (err) {
            this.router.params.errors = err.response.data.errors;
            this.router.reload();
            // this.setErrors(err.response.data.errors);
        }
    }

    setErrors(errors) {
        this.errors = { ...errors };
        setTimeout(() => {
            this.errors = {};
        }, 1500);
    }
}
