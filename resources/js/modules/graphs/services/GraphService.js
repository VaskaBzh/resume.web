import { Graph } from "@/modules/graphs/models/Graph";
import { GraphDataTrait } from "@/traits/GraphDataTrait";
import { TooltipService } from "@/modules/graphs/services/TooltipService";
import { GraphListenersService } from "@/modules/graphs/services/GraphListenersService";
import * as d3 from "d3";

export class GraphService {
    svg = null;

    constructor() {
        this.graph = this.createGraphModel();
        this.tooltipService = this.createTooltipService();
        this.graphListenersService = this.createGraphListenersService();
    }

    /* creators start */

    createGraphListenersService() {
        return new GraphListenersService();
    }

    createGraphModel() {
        return new Graph();
    }

    createTooltipService() {
        return new TooltipService();
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

    get tooltipContent() {
        return this.tooltipService.tooltip.content;
    }

    get tooltipOpacity() {
        return this.tooltipService.tooltip.opacity;
    }

    get tooltipPosition() {
        return this.tooltipService.tooltip.position;
    }

    get tooltip() {
        return this.tooltipService.tooltip.html;
    }

    get isTooltipLeft() {
        return this.tooltipService.tooltip.isLeft;
    }

    /* getters end
     *
     * setters start */

    setTooltipHtml(graphElement) {
        const tooltipHtml = graphElement.querySelector(".tooltip");

        if (!tooltipHtml) {
            setTimeout(() => this.setTooltipHtml(graphElement), 300);

            return this;
        }

        this.tooltipService.setTooltipHtml(tooltipHtml);

        return this;
    }

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

    abstractMoveAction() {}

    abstractLeaveAction() {}

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

        return this;
    }

    /* life circle end
     *
     * listeners start */

    createListeners() {
        this.graphListenersService.setSvgMouseEvents(
            this.graphElem,
            this.mouseMoveAction.bind(this),
            this.mouseLeaveAction.bind(this)
        );

        return this;
    }

    dropListeners() {
        this.graphListenersService.dropSvgMouseEvents();

        return this;
    }

    getTickPosition(mouseX) {
        const position =
            mouseX /
            (this.graphElem.clientWidth / this.graphData.values.length);

        return Number(position.toFixed()) - 1;
    }

    mouseMoveAction(event, mouseX) {
        const tickPosition = this.getTickPosition(mouseX);

        if (tickPosition > -1 && tickPosition < this.graphData.values.length) {
            this.tooltipService
                .getTargetValue(this.graphData, tickPosition)
                .showTooltip();

            this.abstractMoveAction(mouseX);
        }
    }

    mouseLeaveAction() {
        this.tooltipService.hideTooltip();

        this.abstractLeaveAction();
    }

    /* listeners end */
}
