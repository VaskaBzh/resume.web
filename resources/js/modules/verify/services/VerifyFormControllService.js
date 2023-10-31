import {StatesService} from "@/modules/common/services/extends/base/StatesService";

export class VerifyFormControllService {
    constructor() {
        this.isVerifyFormOpened = this.createStatesService();
        this.isVerifyFormClosed = this.createStatesService();
    }

    createStatesService() {
        return new StatesService();
    }

    openVerifyForm() {
        this.isVerifyFormOpened.setState(true);

        return this;
    }

    closeVerifyForm() {
        this.isVerifyFormClosed.setState(false);

        return this;
    }

    verifyFormOpenedState() {
        return this.isVerifyFormOpened.state;
    }

    verifyFormClosedState() {
        return this.isVerifyFormClosed.state;
    }
}
