import { ProfileApi } from "@/api/api";
import { openNotification } from "@/modules/notifications/services/NotificationServices";
import store from "@/store";
import { CodeFormData } from "@/modules/verify/DTO/CodeFormData";

export class VerifyService {
    constructor() {
        this.translate = null;
        this.overTime = 0;
        this.verifyText = "";
        this.text = "";
        this.interval = null;

        this.form = {};
    }

    setForm(form = {}) {
        this.form = {
            ...new CodeFormData(form),
        };
    }

    setTranslate(translate) {
        this.translate = translate;
    }

    async sendEmailVerification(verifyUrl, data = null) {
        const secondsEnd = 0;

        if (this.overTime === secondsEnd) {
            try {
                const response = await this.fetchVerify(verifyUrl, data);

                openNotification(true, this.translate("validate_messages.success"), response.data.message);

                return false;
            } catch (err) {
                console.error("Error with: " + err);

                this.dropInterval();
                this.setOverTime(secondsEnd);
                this.setText();

                openNotification(false, this.translate("validate_messages.error"), err.response.data.message);

                store.dispatch("setFullErrors", err.response.data.errors)

                return true;
            }
        }
    }

    async fetchVerify(verifyUrl, data) {
        return await ProfileApi.post(verifyUrl, data);
    }

    setText(text = null) {
        this.text = text ?? this.verifyText;
    }

    setVerifyText(text) {
        this.verifyText = text;
    }

    setOverTime(overTime) {
        this.overTime = overTime;
    }

    setTimer(intervalEndTime) {
        const second = 1000;
        const secondsEnd = 0;

        if (this.overTime === secondsEnd) {
            this.setOverTime(intervalEndTime);

            this.interval = setInterval(() => {
                if (this.overTime > secondsEnd) {
                    this.setOverTime(this.overTime - second);

                    let overTime = this.overTime;
                    this.setText(`${overTime / second} сек`);
                } else {
                    this.dropInterval();

                    this.setOverTime(secondsEnd);

                    this.setText();
                }
            }, second)
        }
    }

    dropInterval() {
        clearInterval(this.interval);
    }
}
