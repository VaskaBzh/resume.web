export class ValuesService {
    constructor() {
        this.value = null;
    }

    setValue(value = null) {
        this.value = value;
    }

    getValue() {
        return this.value;
    }
}
