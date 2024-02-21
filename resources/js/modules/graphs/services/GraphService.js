import { Graph } from "@/modules/graphs/models/Graph";
import { Tooltip } from "@/modules/graphs/models/Tooltip";
import * as d3 from "d3";
import { GraphDataTrait } from "@/traits/GraphDataTrait";

export class GraphService {
    svg = null;

    constructor() {
        this.graph = this.createGraphModel();
        this.tooltip = this.createTooltipModel();
    }

    /* creators start */

    createGraphModel() {
        return new Graph();
    }

    createTooltipModel() {
        return new Tooltip();
    }

    /* creators end
     *
     * getters start */

    get graphElem() {
        return this.svg._groups[0][0];
    }

    get graphData() {
        return this.graph.data;
    }

    get x() {
        return this.graph.x;
    }

    get y() {
        return this.graph.y;
    }

    // get elements() {
    //     return this.graph.y;
    // }

    get generators() {
        return this.graph.generators;
    }

    /* getters end
     *
     * setters start */

    setGraphData(newGraphData) {
        this.graph.data = newGraphData;

        return this;
    }

    setGraphElements(newElements) {
        this.graph.elements = newElements;

        return this;
    }

    setGraphX() {
        this.graph.x = d3.scaleTime(
            [
                this.graphData.dates[0],
                this.graphData.dates[this.graphData.dates.length - 1],
            ],
            [0, this.graphElem.clientWidth]
        );

        return this;
    }

    setGraphY() {
        this.graph.y = d3.scaleLinear(
            [0, GraphDataTrait.lineValueValidation(this.graphData.values)],
            [this.graphElem.clientHeight, 0]
        );

        return this;
    }

    fillGenerators() {
        this.graph.generators = {
            ...this.graph.generators,
            ...this.getGenerators(),
        };

        return this;
    }

    /* setters end
     *
     * abstract methods start */

    buildElements() {}

    getGenerators() {}

    /* abstract methods end
     *
     * life circle start */

    createGraph(element) {
        this.svg = d3
            .select(element)
            .append("svg")
            .attr("width", "100%")
            .attr("height", element.offsetHeight);

        return this;
    }

    dropGraph() {
        if (this.svg) {
            this.svg.selectAll("*").remove();
            this.svg._groups[0][0].remove();
        }
    }

    /* life circle end */
}
