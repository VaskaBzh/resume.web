import { ProfileApi } from "@/api/api";
import { openNotification } from "@/modules/notifications/services/NotificationServices";

export class VerifyService {
    constructor(verifyText) {
        this.translate = null;
        this.overTime = 0;
        this.verifyText = verifyText;
        this.text = "";
        this.interval = null;
    }

    setTranslate(translate) {
        this.translate = translate;
    }

    async sendEmailVerification() {
        try {
            const response = await this.fetchVerify();

            openNotification(true, this.translate("validate_messages.success"), response.data.message);
        } catch (err) {
            console.error("Error with: " + err);

            openNotification(false, this.translate("validate_messages.error"), err.response.data.message);
        }
    }

    async fetchVerify() {
        return await ProfileApi.post("/email/reverify");
    }

    setText(text = null) {
        this.text = text ?? this.verifyText;
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
