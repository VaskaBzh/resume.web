import { StatesService } from "@/modules/common/services/extends/base/StatesService";

export class PopupControllService {
    constructor() {
        this.isPopupOpened = this.createStatesService();
        this.isPopupClosed = this.createStatesService();
    }

    createStatesService() {
        return new StatesService();
    }

    openPopup() {
        this.isPopupOpened.setTemporaryState(true);

        return this;
    }

    closePopup() {
        this.isPopupClosed.setTemporaryState(true);

        return this;
    }

    getOpenedState() {
        return this.isPopupOpened.state;
    }

    getClosedState() {
        return this.isPopupClosed.state;
    }
}
