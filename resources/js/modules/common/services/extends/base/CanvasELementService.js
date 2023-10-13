export class CanvasElementService {
    constructor() {
        this.canvas = null;
    }

    setElement(element) {
        this.canvas = element;
    }

    getContext(context) {
        this.canvas.getContext(context);
    }

    canvasProcess() {
    }
}
