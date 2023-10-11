import { DomElementService } from "@/modules/common/services/extends/base/DomElementService";
import { CanvasElementService } from "@/modules/common/services/extends/base/CanvasELementService";

export class BackgroundService {
    constructor() {
        this.canvas = this.createDomElementService();
        this.webGl = this.createCanvasElementService();
    }

    createDomElementService() {
        return new DomElementService();
    }

    createCanvasElementService() {
        return new CanvasElementService();
    }

    createProgram() {
        this.webGl.canvasProcess = function () {
            return this.canvas.createProgram();
        }

        this.webGl.canvasProcess();
    }

    createShader(type) {
        this.webGl.canvasProcess = function () {
            return this.canvas.createShader(type);
        }

        this.webGl.canvasProcess();
    }

    startProcess() {

    }
}
