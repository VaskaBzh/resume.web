import { ProfileApi } from "@/api/api";
import { openNotification } from "@/modules/notifications/services/NotificationServices";

export class VerifyService {
    constructor() {
        this.translate = null;
        this.overTime = 0;
        this.verifyText = "";
        this.text = "";
        this.interval = null;
    }

    setTranslate(translate) {
        this.translate = translate;
    }

    async sendEmailVerification(verifyUrl) {
        try {
            const response = await this.fetchVerify(verifyUrl);

            openNotification(true, this.translate("validate_messages.success"), response.data.message);
        } catch (err) {
            console.error("Error with: " + err);

            openNotification(false, this.translate("validate_messages.error"), err.response.data.message);
        }
    }

    async fetchVerify(verifyUrl) {
        return await ProfileApi.post(verifyUrl);
    }

    setText(text = null) {
        this.text = text ?? this.verifyText;
    }

    setVerifyText(text) {
        console.log(text)
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
