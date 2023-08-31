import { router, useForm } from "@inertiajs/vue3";
import { FormData } from "@/modules/settings/DTO/FormData";

import { ValidateService } from "@/modules/validate/services/ValidateService";
import { RowData } from "@/modules/settings/DTO/RowData";
import api from "@/api/api";
import store from "@/store";
import { SettingsUserData } from "../DTO/SettingsUserData";

export class SettingsService {
    constructor(translate, user, referral_code) {
        this.translate = translate;
        this.profit = "";
        this.clearProfit = null;

        this.rows = [];
        this.form = {};
        this.validate = {};
        this.user = user;
        this.referral_code = referral_code;

        this.userData = "";

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

    setUser(user) {
        this.user = user;
    }

    setCode(referral_code) {
        this.referral_code = referral_code;
    }

    setUserData() {
        this.userData = new SettingsUserData(
            this.user.name,
            this.user.email,
            "*********",
            this.user.phone ?? this.translate("inputs.phone"),
            this.referral_code
        );
    }

    setRows() {
        this.rows = [
            new RowData(
                this.translate("settings.block.settings_block.labels.login"),
                "name",
                this.userData.login,
                "name"
            ),
            new RowData(
                this.translate("settings.block.settings_block.labels.email"),
                "email",
                this.userData.email,
                "email"
            ),
            new RowData(
                this.translate("settings.block.settings_block.labels.password"),
                "password",
                this.userData.password,
                "password"
            ),
            new RowData(
                this.translate("settings.block.settings_block.labels.phone"),
                "phone",
                this.userData.phone,
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

    sendMessage(message) {
        store.dispatch("getMessage", message);
    }

    async setReferral(code) {
        let result = {};

        try {
            result = await api.post(`/referrals/attach/${this.user.id}`, {
                code: code,
            });

            this.sendMessage(result.data.message);

            router.reload();
        } catch (err) {
            this.sendMessage(err.response.data.message);
        }
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
            item:
                data.name === this.translate("inputs.password")
                    ? this.translate("inputs.old_password")
                    : data.val,
            type: data.name,
            key: data.key,
        };
    }
}
