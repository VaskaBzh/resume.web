import { ValuesService } from "@/modules/common/services/extends/base/ValuesService";

import store from "@/store";

export class ValidationErrorsService {
    constructor() {
        this.errorName = this.createValuesService();
    }

    createValuesService() {
        return new ValuesService();
    }

    setErrorName(newErrorName) {
        this.errorName.setValue(newErrorName);
    }

    setError(errorMessageKey, errorMessageParams = {}) {
        store.dispatch(
            "setFullErrors",
            {
                [this.errorName.getValue()]: [{ path: errorMessageKey, args: {...errorMessageParams} }] ,
            }
        );
    }

    dropErrors() {
        store.dispatch("dropErrors");
    }
}
