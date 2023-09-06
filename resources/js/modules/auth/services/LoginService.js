import { LoginFormData } from "@/modules/auth/DTO/LoginFormData";
import api from "../../../api/api";
import { useRoute } from "vue-router";

export class LoginService {
    constructor() {
        this.form = {};
        this.checkbox = false;
        this.errors = {};

        this.router = useRoute();
    }

    setForm() {
        this.form = {
            ...new LoginFormData("", "", false),
        };
    }

    async login() {
        try {
            await api.post("/login", this.form)

            this.router.push({ name: 'statistic' })
        } catch(err) {
            this.router.forward({
                params: {
                    errors: err.response.data.errors
                }
            })
        }
    }

    setErrors(errors) {
        this.errors = { ...errors };
        setTimeout(() => {
            this.errors = {};
        }, 1500);
    }
}
