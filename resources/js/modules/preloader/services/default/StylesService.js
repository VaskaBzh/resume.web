import { DomElementsService } from "@/modules/preloader/services/default/extends/DomElementsService";

export class StylesService {
    constructor() {
        this.polygon = this.createDomElementService();
        this.cross = this.createDomElementService();

        this.rotate = null;
        this.dashOffSet = null;
    }

    createDomElementService() {
        return new DomElementsService();
    }

    getRotate() {
        this.rotate = this.polygon.element.style.webkitTransform.substr(7, 3);
    }

    getDashOffSet() {
        this.dashOffSet =
            this.polygon.element.style.strokeDashoffset.split("px")[0];
    }

    setPolygonTransform(transformData) {
        this.polygon.element.style.transform = transformData;
    }
}
