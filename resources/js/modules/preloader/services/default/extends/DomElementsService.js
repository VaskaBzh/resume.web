export class DomElementsService {
    constructor() {
        this.element = null;
    }

    setElement(element) {
        this.element = element;
    }

    getRect() {
        return this.element.querySelectorAll("rect");
    }
}
