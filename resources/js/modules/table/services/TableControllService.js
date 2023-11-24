export class TableControllService {
    constructor() {
        this.isWait = false;
        this.isEmpty = false;
        this.isEnd = false;
    }

    waitResponse() {
        this.isEmpty = false;
        this.isEnd = false;
        this.isWait = true;

        return this;
    }

    endResponse() {
        this.isWait = false;
        this.isEnd = true;

        return this;
    }

    emptyResponse() {
        this.isWait = false;
        this.isEnd = true;
        this.isEmpty = true;

        return this;
    }
}
