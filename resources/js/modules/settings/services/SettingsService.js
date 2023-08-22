import { useForm } from "@inertiajs/vue3";
import { FormData } from "@/modules/settings/DTO/FormData";

import { ValidateSevice } from "@/modules/common/services/ValidateSevice";
import { RowData } from "@/modules/settings/DTO/RowData";

export class SettingsService {
    constructor(translate, user) {
        this.translate = translate;
        this.profit = "";
        this.clearProfit = null;

        this.rows = [];
        this.form = {};
        this.validate = {};
        this.user = user;

        this.login = user.name;
        this.email = user.email;
        this.password = "*********";
        this.phone = user.phone ?? "Добавьте номер";

        this.closed = false;
        this.waitAjax = false;

        this.validateService = new ValidateSevice();
    }

    validateProcess(event) {
        this.validateService.validateProcess(event, this.form, this.validate);
    }

    setRows() {
        this.rows = [
            new RowData(
                this.translate("settings.block.settings_block.labels.login"),
                "name",
                this.login,
                0
            ),
            new RowData(
                this.translate("settings.block.settings_block.labels.email"),
                "email",
                this.email,
                1
            ),
            new RowData(
                this.translate("settings.block.settings_block.labels.password"),
                "password",
                this.password,
                2
            ),
            new RowData(
                this.translate("settings.block.settings_block.labels.phone"),
                "phone",
                this.phone,
                3
            ),
        ];
    }

    setProfit(newProfit) {
        this.profit = newProfit;
    }

    setForm() {
        this.form = new FormData("", "", "", "", "");
    }

    ajax() {
        this.wait = true;

        let sendForm = useForm({
            [this.form.key]: this.form.item,
        });

        sendForm.post(route("change", this.user), {
            onFinish: () => {
                this.wait = false;
            },
        });
    }

    setReferral() {
        console.log("ref");
    }

    ajaxChange = (bool) => {
        if (bool) {
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
        this.form = {
            ...this.form,
            item: data.name === "пароль" ? "" : data.val,
            type: data.name,
            key: data.key,
        };
    }
}
