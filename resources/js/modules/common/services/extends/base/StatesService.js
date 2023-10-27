export class StatesService {
    constructor() {
        this.state = false;
    }

    setState(newState = true) {
        this.state = newState;
    }
}
