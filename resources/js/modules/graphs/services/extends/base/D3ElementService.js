import * as d3 from "d3";

export class D3ElementService {
    constructor() {
        this.svg = null;
    }

    d3ActionSvgElement(action, newSvgElement) {
        this.svg = d3[action](newSvgElement);

        return this;
    }

    actionSvgElement(action, newSvgData = null) {
        this.svg[action](newSvgData);

        return this.svg;
    }

    dropGraph() {
        if (this.svg) {
            this.svg.selectAll("*").remove();
            this.svg._groups[0][0].remove();
        }
    }

    getData() {}
}
