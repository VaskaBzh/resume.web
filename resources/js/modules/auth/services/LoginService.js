import {useForm, usePage} from "@inertiajs/vue3";
import { LoginFormData } from "@/modules/auth/DTO/LoginFormData";

export class LoginService {
    constructor() {
        this.form = {};
        this.checkbox = false;
        this.errors = {};
    }

    setForm() {
        const { props } = usePage();

        this.form = useForm({
            ...new LoginFormData("", "", false),
            _token: props.token,
        });
    }

    async login() {
        await this.form.post("/login", {});
    }

    setErrors(errors) {
        this.errors = { ...errors };
        setTimeout(() => {
            this.errors = {};
        }, 1500);
    }
}
