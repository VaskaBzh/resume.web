export class CanvasElementService {
    constructor() {
        this.canvas = null;
    }

    getContext(context) {
        this.canvas.getContext(context);
    }

    canvasProcess() {}
}
