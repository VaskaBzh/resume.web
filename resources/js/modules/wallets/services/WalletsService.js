import { StatesService } from "@/modules/common/services/extends/base/StatesService";
import { WalletFormData } from "@/modules/wallets/DTO/WalletFormData";

export class WalletsService {
    constructor() {
        this.isAddPopupOpened = this.createStatesService();
        this.isAddPopupClosed = this.createStatesService();
        this.isChangePopupOpened = this.createStatesService();
        this.isChangePopupClosed = this.createStatesService();

        this.isAddFormEmail = this.createStatesService();
        this.isChangeFormEmail = this.createStatesService();

        this.form = {};
    }

    createStatesService() {
        return new StatesService();
    }

    setForm(form = {}) {
        this.form = {
            ...new WalletFormData(),
            ...form,
        };

        return this;
    }

    openAddPopup() {
        this.isAddPopupOpened.setTemporaryState(true);

        return this;
    }

    closeAddPopup() {
        this.isAddPopupClosed.setTemporaryState(false);

        return this;
    }

    openChangePopup() {
        this.isChangePopupOpened.setTemporaryState(true);

        return this;
    }

    closeChangePopup() {
        this.isChangePopupClosed.setTemporaryState(false);

        return this;
    }

    openAddEmailForm() {
        this.isAddFormEmail.setState(true);

        return this;
    }

    closeAddEmailForm() {
        this.isAddFormEmail.setState(false);

        return this;
    }

    openChangeEmailForm() {
        this.isChangeFormEmail.setState(true);

        return this;
    }

    closeChangeEmailForm() {
        this.isChangeFormEmail.setState(false);

        return this;
    }
}
