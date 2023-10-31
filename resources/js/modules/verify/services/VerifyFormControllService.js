import {StatesService} from "@/modules/common/services/extends/base/StatesService";

export class VerifyFormControllService {
    constructor() {
        this.isVerifyFormOpened = this.createStatesService();
        this.isVerifyFormClosed = this.createStatesService();
    }

    createStatesService() {
        return new StatesService();
    }


}
