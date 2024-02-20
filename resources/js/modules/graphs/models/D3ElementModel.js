import * as d3 from "d3";

export class D3ElementModel {
    svg = null;

    createSvg(newSvgElement) {
        this.svg = d3
            .select(newSvgElement)
            .append("svg")
            .attr("width", "100%")
            .attr("height", newSvgElement.offsetHeight);

        return this;
    }

    actionSvgElement(action, newSvgData = null) {
        this.svg[action](newSvgData);

        return this.svg;
    }

    dropSvg() {
        if (this.svg) {
            this.svg.selectAll("*").remove();
            this.svg._groups[0][0].remove();
        }
    }

    getData() {}
}
