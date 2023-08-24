import { useForm } from "@inertiajs/vue3";
import { FormData } from "@/modules/settings/DTO/FormData";

import { ValidateService } from "@/modules/validate/services/ValidateService";
import { RowData } from "@/modules/settings/DTO/RowData";
import api from "@/api/api";

export class SettingsService {
    constructor(translate, user) {
        this.translate = translate;
        this.profit = "";
        this.clearProfit = null;

        this.rows = [];
        this.form = {};
        this.validate = {};
        this.user = user;

        this.login = "";
        this.email = "";
        this.password = "";
        this.phone = "";

        this.closed = false;
        this.waitAjax = false;

        this.validateService = new ValidateService();
    }

    validateProcess(event) {
        this.validate = this.validateService.validateProcess(
            event,
            this.form,
            this.validate
        );
    }

    setUserData(user) {
        this.login = user.name;
        this.email = user.email;
        this.password = "*********";
        this.phone = user.phone ?? this.translate("inputs.phone");
    }

    setRows() {
        this.rows = [
            new RowData(
                this.translate("settings.block.settings_block.labels.login"),
                "name",
                this.login,
                "name"
            ),
            new RowData(
                this.translate("settings.block.settings_block.labels.email"),
                "email",
                this.email,
                "email"
            ),
            new RowData(
                this.translate("settings.block.settings_block.labels.password"),
                "password",
                this.password,
                "password"
            ),
            new RowData(
                this.translate("settings.block.settings_block.labels.phone"),
                "phone",
                this.phone,
                "phone"
            ),
        ];
    }

    setProfit(newProfit) {
        this.profit = newProfit;
    }

    setForm() {
        this.form = new FormData("", "", "", "", "");
    }

    async ajax() {
        this.wait = true;

        let sendForm = useForm({
            [this.form.key]: this.form.item,
        });

        await sendForm.post(route("change", this.user), {
            onFinish: () => {
                this.wait = false;

                this.setRows();
                // this.closed = false;
            },
        });
    }

    async setReferral(code) {
        let result = await api.post(`/referrals/attach/${this.user.id}`, {
            code: code,
        });

        console.log(result);
    }

    setValue(value) {
        this.form.item = value;
    }

    ajaxChange = (data) => {
        this.setValue(data.value);

        if (data.bool) {
            if (Object.entries(this.validate).length === 0) {
                this.form.old_password = this.form.item;
                this.ajax();
            }
        } else {
            this.ajax();
        }
    };

    async send2Fac() {
        let form = useForm({
            "2fac": true,
        });

        await form.post("/2fac/enable", {});
    }

    setProfits() {
        this.profit = localStorage.getItem("clearProfit") || "";
        this.clearProfit = this.profit;
    }

    setClearProfit(newProfit) {
        localStorage.setItem("clearProfit", newProfit);
        this.clearProfit = newProfit;
    }

    getHtml(data) {
        // item: data.name === "пароль" ? "" : data.val,
        this.form = {
            ...this.form,
            item: data.name === this.translate('inputs.password') ? this.translate('inputs.old_password') : data.val,
            type: data.name,
            key: data.key,
        };
    }
}
