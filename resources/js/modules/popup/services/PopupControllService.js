import {StatesService} from "@/modules/common/services/extends/base/StatesService";

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
        this.isPopupClosed.setTemporaryState(false);

        return this;
    }

    popupOpenedState() {
        return this.isPopupOpened.state;
    }

    popupClosedState() {
        return this.isPopupClosed.state;
    }
}
