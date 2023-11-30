import { WalletFormData } from "@/modules/wallets/DTO/WalletFormData";
import { PopupControllService } from "@/modules/popup/services/PopupControllService";
import { VerifyFormControllService } from "@/modules/verify/services/VerifyFormControllService";
import { Form } from "@/modules/form/models/Form";
import { ProfileApi } from "@/api/api";

export class WalletsService {
    constructor() {
        this.addPopup = this.createPopupControllService();
        this.changePopup = this.createPopupControllService();

        this.addVerifyForm = this.createVerifyFormControllService();
        this.changeVerifyForm = this.createVerifyFormControllService();

        this.form = this.createFormModel();
    }

    createFormModel() {
        return new Form();
    }

    createPopupControllService() {
        return new PopupControllService();
    }

    createVerifyFormControllService() {
        return new VerifyFormControllService();
    }

    setFormData(formData = WalletFormData) {
        this.form.setFormData(formData).setClearForm();

        return this;
    }

    index() {

    }

    async fetchWallets() {
        await ProfileApi.get(`/wallets/${this.group_id}`);
    }
}
