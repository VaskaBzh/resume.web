import {StatesService} from "@/modules/common/services/extends/base/StatesService";

export class PopupControllService {
    constructor() {
        this.isPopupOpened = this.createStatesService();
        this.isPopupClosed = this.createStatesService();
    }

    createStatesService() {
        return new StatesService();
    }
}
