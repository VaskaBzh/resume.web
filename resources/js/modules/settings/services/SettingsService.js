import { FormData } from "@/modules/settings/DTO/FormData";
import { ValidateService } from "@/modules/validate/services/ValidateService";
import { RowData } from "@/modules/settings/DTO/RowData";
import { ProfileApi } from "@/api/api";
import store from "@/store";
import { SettingsUserData } from "../DTO/SettingsUserData";
import { BlockData } from "../DTO/BlockData";
import { PopupControllService } from "@/modules/popup/services/PopupControllService";
import { Form } from "@/modules/form/models/Form";

export class SettingsService {
    constructor(translate, router) {
        this.translate = translate;
        this.profit = "";
        this.clearProfit = null;

        this.rows = [];
        this.blocks = [];
        this.form = {};

        this.disableFacForm = this.createNewForm();

        this.passwordForm = {};
        this.validate = {};
        this.user = null;

        this.router = router;

        this.userData = "";

        this.qrCode = null;
        this.code = null;

        this.closed = false;
        this.waitAjax = false;

        this.openedFacPopup = false;
        this.closedFacPopup = false;

        this.facDisabledPopup = this.createPopupControllService();

        this.openedPasswordPopup = false;
        this.closedPasswordPopup = false;

        this.validateService = new ValidateService();

        this.waitFacProcess = false;
        this.waitPasswordChange = false;
    }

    createNewForm() {
        return new Form();
    }

    createPopupControllService() {
        return new PopupControllService();
    }

    setCode(code) {
        this.code = code;
    }

    setQrCode(qrCode) {
        this.qrCode = qrCode;
    }

    async sendVerify(form) {
        this.waitFacProcess = true;

        try {
            this.form.code = form.code;
            const response = await this.fetchFac();

            this.closeFacPopup();
            store.dispatch("setNotification", {
                status: "success",
                title: "connected",
                text: response.message,
            });

            store.dispatch("setUser");

            this.waitFacProcess = false;
        } catch (err) {
            this.waitFacProcess = false;

            console.error(err);

            store.dispatch("setNotification", {
                status: "error",
                title: "error",
                text: err.response.data.message || err.response.data.error,
            });
        }
    }

    removeRouteQuery() {
        this.router.push({
            name: "settings",
        });
    }

    setPasswordForm(form = null) {
        const formData = form ?? {
            old_password: "",
            password: "",
            password_confirmation: "",
        };

        this.passwordForm = {
            ...this.passwordForm,
            ...formData,
        };
    }

    async sendPassword() {
        this.waitPasswordChange = true;

        try {
            const response = await this.fetchPassword();

            this.closePasswordPopup();
            this.removeRouteQuery();
            this.setPasswordForm();

            store.dispatch("setNotification", {
                status: "success",
                title: "changed",
                text: response.message,
            });

            this.waitPasswordChange = false;
        } catch (err) {
            this.waitPasswordChange = false;

            console.error(err);

            store.dispatch("setNotification", {
                status: "error",
                title: "error",
                text: err.response.data.message,
            });
            store.dispatch("setFullErrors", err.response.data);
        }
    }

    openPasswordPopup() {
        this.openedPasswordPopup = true;

        setTimeout(() => (this.openedPasswordPopup = false), 300);
    }

    closePasswordPopup() {
        this.closedPasswordPopup = true;

        setTimeout(() => (this.closedPasswordPopup = false), 300);
    }

    async sendFac() {
        try {
            const response = await this.generateFac();

            this.setCode(response.secret);
            this.setQrCode(response.qrCode);

            this.form.secret = response.secret;
            this.openFacPopup();
        } catch (err) {
            console.error(err);
        }
    }

    async sendDisableFac() {
        this.waitFacProcess = true;

        try {
            const response = await this.fetchDisableFac();

            this.facDisabledPopup.closePopup();

            store.dispatch("setNotification", {
                status: "success",
                title: "changed",
                text: response.message,
            });

            this.waitFacProcess = false;
        } catch (err) {
            this.waitFacProcess = false;

            console.error(err);

            store.dispatch("setFullErrors", err.response.data.errors);
        }
    }

    openFacPopup() {
        this.openedFacPopup = true;

        setTimeout(() => (this.openedFacPopup = false), 300);
    }

    closeFacPopup() {
        this.closedFacPopup = true;

        setTimeout(() => (this.closedFacPopup = false), 300);
    }

    async fetchPassword() {
        return (
            await ProfileApi.put(
                `/password/change/${this.user.id}`,
                this.passwordForm
            )
        ).data;
    }

    async fetchDisableFac() {
        return (
            await ProfileApi.put(
                `/2fac/disable/${this.user.id}`,
                this.disableFacForm.form
            )
        ).data;
    }

    async generateFac() {
        return (await ProfileApi.get(`/2fac/qrcode/${this.user.id}`)).data;
    }

    async fetchFac() {
        return (
            await ProfileApi.put(`/2fac/enable/${this.user.id}`, this.form, {
                headers: {
                    Authorization: `Bearer ${store.getters.token}`,
                },
            })
        ).data;
    }

    validateProcess(event) {
        this.validate = this.validateService.validateProcess(
            event,
            this.form,
            this.validate
        );
    }

    async sendEmailVerification() {
        try {
            const response = await ProfileApi.post("/email/reverify");

            store.dispatch("setNotification", {
                status: "success",
                title: "success",
                text: response.data.message,
            });
        } catch (err) {
            console.error("Error with: " + err);

            store.dispatch("setNotification", {
                status: "error",
                title: "error",
                text: err.response.data.message,
            });
        }
    }

    setUser(user) {
        this.user = user;
    }

    setUserData() {
        this.userData = new SettingsUserData(
            this.user.name,
            this.user.email,
            this.user.phone ?? this.translate("inputs.phone")
        );
    }

    setRows() {
        this.rows = [
            new RowData(
                this.translate("settings.block.settings_block.labels.email"),
                "email",
                this.userData.email,
                "email"
            ),
            // new RowData(
            //     this.translate("settings.block.settings_block.labels.phone"),
            //     "phone",
            //     this.userData.phone,
            //     "phone"
            // ),
        ];
    }

    setBlocks() {
        this.blocks = [
            new BlockData(
                this.translate("safety.title[0]"),
                this.translate("safety.text[0]"),
                "2fac",
                "two-factor-icon.png",
                this.translate(
                    this.user["2fa"] ? "safety.button[2]" : "safety.button[0]"
                ),
                this.user["2fa"] ? "dropFac" : "openFacForm"
            ),
            new BlockData(
                this.translate("safety.title[2]"),
                this.translate("safety.text[2]"),
                "verify_password",
                "change-password-icon.png",
                this.translate("safety.button[1]"),
                "openPasswordForm"
            ),
        ];
    }

    setProfit(newProfit) {
        this.profit = newProfit;
    }

    setDefaultForm() {
        this.form = new FormData("", "", "", "", "");
    }

    async ajax() {
        this.wait = true;

        let sendForm = {
            [this.form.key]: this.form.item,
        };

        try {
            const response = await ProfileApi.put(
                `/change/${this.user.id}`,
                sendForm,
                {
                    headers: {
                        Authorization: `Bearer ${store.getters.token}`,
                    },
                }
            );

            this.wait = false;

            store.dispatch("setNotification", {
                status: "success",
                title: "changed",
                text: response.data.message,
            });

            this.setRows();
        } catch (err) {
            console.error("Error with: " + err);

            store.dispatch("setNotification", {
                status: "error",
                title: "error",
                text: err.response.data.message,
            });
        }
    }

    sendMessage(message) {
        store.dispatch("getMessage", message);
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

    setProfits() {
        this.profit = localStorage.getItem("clearProfit") || "";
        this.clearProfit = this.profit;
    }

    setClearProfit(newProfit) {
        localStorage.setItem("clearProfit", newProfit);
        this.clearProfit = newProfit;
    }

    async getHtml(data) {
        if (data.verify) {
            this.form = {
                ...this.form,
                item: data.val,
                type: data.name,
                key: data.key,
            };
        } else {
            await this.sendEmailVerification();
        }
    }
}
