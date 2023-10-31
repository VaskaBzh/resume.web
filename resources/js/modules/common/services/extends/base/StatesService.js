export class StatesService {
    constructor() {
        this.state = false;
    }

    setState(newState = true) {
        this.state = newState;
    }

    setTemporaryState(newState = true, timeout = 1000) {
        const oldValue = this.state;

        this.state = newState;

        setTimeout(() => (this.state = oldValue), timeout);
    }
}
