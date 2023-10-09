export class AnimateStatesService {
    constructor() {
        this.animateState = false;
    }

    setAnimateState(newAnimateState = true) {
        this.animateState = newAnimateState;
    }
}
