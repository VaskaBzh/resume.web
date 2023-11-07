import { WalletFormData } from "@/modules/wallets/DTO/WalletFormData";
import { PopupControllService } from "@/modules/popup/services/PopupControllService";
import { VerifyFormControllService } from "@/modules/verify/services/VerifyFormControllService";

export class WalletsService {
    constructor() {
        this.addPopup = new PopupControllService();
        this.changePopup = new PopupControllService();

        this.addVerifyForm = new VerifyFormControllService();
        this.changeVerifyForm = new VerifyFormControllService();

        this.form = {};
    }

    setForm(form = {}) {
        this.form = {
            ...new WalletFormData(),
            ...form,
        };

        return this;
    }
}
