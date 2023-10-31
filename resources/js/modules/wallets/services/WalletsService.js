import { StatesService } from "@/modules/common/services/extends/base/StatesService";
import { WalletFormData } from "@/modules/wallets/DTO/WalletFormData";
import {PopupControllService} from "@/modules/popup/services/PopupControllService";
import {VerifyFormControllService} from "@/modules/verify/services/VerifyFormControllService";

export class WalletsService {
    constructor() {
        this.addPopup = this.createPopupControllService();
        this.changePopup = this.createPopupControllService();

        this.addVerifyForm = this.createVerifyFormControllService();
        this.changeVerifyForm = this.createVerifyFormControllService();

        this.form = {};
    }

    createPopupControllService() {
        return new PopupControllService();
    }

    createVerifyFormControllService() {
        return new VerifyFormControllService();
    }

    // createStatesService() {
    //     return new StatesService();
    // }

    setForm(form = {}) {
        this.form = {
            ...new WalletFormData(),
            ...form,
        };

        return this;
    }
}
