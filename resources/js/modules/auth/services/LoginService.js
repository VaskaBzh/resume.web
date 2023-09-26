import { LoginFormData } from "@/modules/auth/DTO/LoginFormData";
import api from "../../../api/api";
import { useRoute } from "vue-router";
import store from "@/store";

export class LoginService {
    constructor(router) {
        this.form = {};
        this.checkbox = false;

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

            // if (this.route?.query?.verify_hash) {
            //     await api.post("/verify", {
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
