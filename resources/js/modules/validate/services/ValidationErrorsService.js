import store from "@/store";

export class ValidationErrorsService {
    constructor() {
        this.errorName = null;
    }

    setErrorName(newErrorName) {
        this.errorName = newErrorName;
    }

    setError(errorMessageKey, errorMessageParams = {}) {
        store.dispatch(
            "setFullErrors",
            {
                [this.errorName]: [{ path: errorMessageKey, args: {...errorMessageParams} }] ,
            }
        );
    }

    dropErrors() {
        store.dispatch("dropErrors");
    }
}
