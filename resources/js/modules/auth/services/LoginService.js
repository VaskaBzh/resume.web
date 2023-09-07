import { LoginFormData } from "@/modules/auth/DTO/LoginFormData";
import api from "../../../api/api";
import { useRoute } from "vue-router";
import store from "@/store";

export class LoginService {
    constructor(router) {
        this.form = {};
        this.checkbox = false;
        this.errors = {};
        this.errorsExpired = {};

        this.route = useRoute();
        this.router = router;
    }

    setForm() {
        this.form = {
            ...new LoginFormData("", "", false),
        };
    }

    async login() {
        try {
            const response = await api.post("/login", this.form);

            const user = response.data.user;
            const token = response.data.token;
            store.dispatch("setUser", user);
            store.dispatch("setToken", token);

            // this.router.push({
            //     name: "login",
            // });
        } catch (err) {
            this.router.push({
                name: "login",
                state: { errors: err.response?.data?.errors },
            });
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
